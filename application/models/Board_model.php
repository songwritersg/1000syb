<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*************************************************************
 *
 * Class Board_model
 *
 * 게시판 설정 관련 모델
 *
 ***********************************************************/
class Board_model extends SYB_Model {

    function __construct()
    {
        parent::__construct();
    }

    /***********************************************************
     * 게시판 정보를 가져옵니다.
     * @param $brd_key
     * @return boar
     **********************************************************/
    function get_board( $brd_key )
    {
        if(empty($brd_key)) return NULL;

        $this->db->where("brd_key", $brd_key);
        $result = $this->db->get("tbl_board");
        $board = $result->row_array();

        return $board;
    }

    /**********************************************************
     * 게시판 목록을 가져옵니다.
     *********************************************************/
    function get_list( $param=array() )
    {
        $param['page']      = element('page', $param, 1);
        $param['page_rows'] = element('page_rows', $param, 10);
        $param['brd_key']   = element('brd_key', $param);
        $param['stxt']      = element('stxt', $param);
        $param['scol']      = element('scol', $param);
        $param['start']     = ($param['page'] -1) * $param['page_rows'];

        $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
        $this->db->where('brd_key', $param['brd_key']);
        $this->db->limit( $param['page_rows'] , $param['start'] );
        $this->db->order_by("post_num DESC, post_depth ASC");
        $result = $this->db->get("tbl_board_post");
        $return['list'] = $result->result_array();

        $result = $this->db->query("SELECT FOUND_ROWS() AS `cnt`");
        $return['total_count'] = (int)$result->row(0)->cnt;

        // 게시번호 달아주기
        $num = 0;
        foreach($return['list'] as &$row)
        {
            $row['nums'] = $return['total_count'] - $num - $param['start']; // 게시글 번호
            $row['post_link'] = base_url("board/{$row['brd_key']}/{$row['post_idx']}");
            $num++;
        }

        return $return;
    }

}