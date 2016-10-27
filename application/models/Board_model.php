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

    private $board;

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

        // 캐시 드라이버 로드
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        if( ! $board = $this->cache->get('board_info_'.$brd_key) )
        {
            $this->db->where("brd_key", $brd_key);
            $result = $this->db->get("tbl_board");
            $board = $result->row_array();

            // 해당 게시판의 카테고리를 가져온다.
            $this->db->where("brd_key", $brd_key);
            $this->db->order_by("bca_sort ASC");
            $result = $this->db->get("tbl_board_category");
            if( $result->num_rows() > 0 )
            {
                $board['brd_category'] = $result->result_array();
            }

            $this->cache->save("board_info_".$brd_key, $board, 60*5);
        }

        return $board;
    }


    /**********************************************************
     * 게시글 내용을 가져옵니다.
     * @param $post_idx
     * @return array
     *********************************************************/
    function get_post($post_idx)
    {
        if(empty($post_idx)) return NULL;

        $this->db->where("post_idx", $post_idx);
        $this->db->limit(1);
        $result = $this->db->get("tbl_board_post");
        $post = $result->row_array();

        preg_match_all( "/(<([^>]+)>)/", $post['post_content'], $matches );
        $is_html = (empty($matches[0])) ? FALSE : TRUE;
        $post['contents'] =  $is_html ?  display_html_content($post['post_content'], TRUE) : nl2br($post['post_content']);
        return $post;
    }

    /**********************************************************
     * 게시글의 조회수를 증가시킵니다.
     * @param $post_idx
     *********************************************************/
    function update_post_hit( $post_idx )
    {
        if(empty($post_idx)) return NULL;

        $CI =& get_instance();

        if(! $CI->session->userdata('board_post_hit_'.$post_idx) )
        {
            $CI->session->set_userdata('board_post_hit_'.$post_idx, time());

            $this->db->where("post_idx", $post_idx);
            $this->db->set("post_hit", "post_hit+1", FALSE);
            $this->db->update("tbl_board_post");
        }
    }

    /**********************************************************
     * 게시판 목록을 가져옵니다.
     * @param array $param
     * @return mixed
     *********************************************************/
    function get_list( $param=array() )
    {
        $permit_stxt = array("title","titlecontent","nickname");

        $param['page']      = element('page', $param, 1);
        $param['page_rows'] = element('page_rows', $param, 10);
        $param['brd_key']   = element('brd_key', $param);
        $param['stxt']      = element('stxt', $param);
        $param['scol']      = element('scol', $param);
        $param['start']     = ($param['page'] -1) * $param['page_rows'];

        // 공지글이 아닌 글 가져오기
        $this->db->select("SQL_CALC_FOUND_ROWS *", FALSE);
        $this->db->where('brd_key', $param['brd_key']);
        $this->db->where("post_notice","N");
        $this->db->limit( $param['page_rows'] , $param['start'] );
        $this->db->order_by("post_num DESC, post_depth ASC");

        // 검색어 처리
        if( $param['stxt'] && $param['scol'] && in_array($param['scol'], $permit_stxt) )
        {
            // 검색어를 띄어쓰기 기준으로 나눈다.
            $s = explode(" ",$param['stxt']);

            switch ( $param['scol'])
            {
                case "title" :
                    $this->db->group_start();
                        foreach($s as $kwd)
                        {
                            $this->db->or_like("post_title", $kwd);
                        }
                    $this->db->group_end();
                    break;
                case "titlecontent":
                    $this->db->group_start();
                    foreach($s as $kwd)
                    {
                        $this->db->or_like("post_title", $kwd);
                        $this->db->or_like("post_content", $kwd);
                    }
                    $this->db->group_end();
                    break;
                case "nickname":
                    $this->db->group_start();
                    foreach($s as $kwd)
                    {
                        $this->db->or_like("usr_name", $kwd);
                    }
                    $this->db->group_end();
                    break;
                default :
                    break;
            }
        }

        $result = $this->db->get("tbl_board_post");
        $return['list'] = $result->result_array();

        $result = $this->db->query("SELECT FOUND_ROWS() AS `cnt`");
        $return['total_count'] = (int)$result->row(0)->cnt;

        // 게시번호 달아주기
        $num = 0;
        foreach($return['list'] as &$row)
        {
            $this->adjust_row($row, $return['total_count'] - $num - $param['start'], $param['scol'], $param['stxt']);
            $num++;
        }

        // 공지글 전체 가져오기
        $this->db->where("brd_key", $param['brd_key']);
        $this->db->where("post_notice","Y");
        $this->db->order_by("post_num DESC, post_depth ASC");
        $result = $this->db->get("tbl_board_post");
        $return['notice'] = $result->result_array();

        foreach($return['notice'] as &$row)
        {
            $this->adjust_row($row, NULL, NULL, NULL);
        }

        return $return;
    }

    function adjust_row(&$row, $nums, $scol="", $stxt="")
    {
        $row['nums'] = $nums; // 게시글 번호
        $row['post_link'] = base_url("board/{$row['brd_key']}/{$row['post_idx']}");
        $row['is_new']  = (strtotime($row['post_regtime']) + (60*60*24) > time());
        $row['is_reply'] = ($row['post_depth'] > 0);
        $row['is_secret'] = ($row['post_secret']=='Y');

        // 검색어가 있는경우 하이라이팅
        if($scol && $stxt)
        {
            $s = explode(" ",$stxt);
            if($scol == 'title' OR $scol == 'titlecontent')
            {
                foreach($s as $kwd) {
                    $row['post_title'] = str_replace($kwd,"<span class='highlight'>{$kwd}</span>", $row['post_title'] );
                }
            }
            else if ( $scol == 'nickname' )
            {
                foreach($s as $kwd) {
                    $row['usr_name'] = str_replace($kwd,"<span class='highlight'>{$kwd}</span>", $row['usr_name'] );
                }
            }
        }

        return $row;
    }

    /*************************************************************
     * 이전글과 다음글 가져오기
     * @param $brd_key
     * @param $post_idx
     ************************************************************/
    function get_np($brd_key, $post_idx, $post_num, $post_depth)
    {
        // 이전글 가져오기
        $this->db->select("post_idx, post_title, post_category, post_depth, post_secret");
        $this->db->where("post_status", "Y");
        $this->db->where("brd_key", $brd_key);

        $this->db->group_start();
            $this->db->group_start();
                $this->db->where("post_num", (int)$post_num);
                $this->db->where("post_depth <", (int)$post_depth);
            $this->db->group_end();
            $this->db->or_group_start();
                $this->db->where("post_num <", (int)$post_num);
            $this->db->group_end();
        $this->db->group_end();

        $this->db->limit(1);
        $this->db->order_by("post_num DESC, post_depth DESC");
        $result = $this->db->get("tbl_board_post");
        $return['prev'] = $result->row_array();

        // 다음글 가져오기
        $this->db->select("post_idx, post_title, post_category, post_depth, post_secret");
        $this->db->where("post_status", "Y");
        $this->db->where("brd_key", $brd_key);

        $this->db->group_start();
        $this->db->group_start();
        $this->db->where("post_num", (int)$post_num);
        $this->db->where("post_depth >", (int)$post_depth);
        $this->db->group_end();
        $this->db->or_group_start();
        $this->db->where("post_num >", (int)$post_num);
        $this->db->group_end();
        $this->db->group_end();
        $this->db->limit(1);

        $this->db->order_by("post_num ASC, post_depth ASC");
        $result = $this->db->get("tbl_board_post");
        $return['next'] = $result->row_array();

        return $return;
    }

    /*************************************************************
     *
     * 해당 게시판과 관련된 권한여부를 갖고 옵니다.
     * @param $brd_key
     ************************************************************/
    function get_auth($brd_key)
    {
        $return =   array(
            "is_admin"  => FALSE,
            "is_subadmin"  => FALSE,
            "list"      => FALSE,
            "view"      => FALSE,
            "write"     => FALSE,
            "comment"   => FALSE,
            "reply"     => FALSE
        );

        if(! $board = $this->get_board($brd_key) ) {
            return $return;
        }

        $CI =& get_instance();

        // 게시판 설정에서 관리자 여부를 가져온다.
        $return['list'] = ((int)$board['brd_lv_list'] <= $CI->member->level());
        $return['view'] = ((int)$board['brd_lv_view'] <= $CI->member->level());
        $return['write'] = ((int)$board['brd_lv_write'] <= $CI->member->level());
        $return['comment'] = ((int)$board['brd_lv_comment'] <= $CI->member->level());
        $return['reply'] = ((int)$board['brd_lv_reply'] <= $CI->member->level());

        // 게시판에 관리 권한이 있는지 여부를 가져온다.
        if( $CI->member->level() >= 8 )
        {
            // 천생연분직원이면 관리자
            $return['is_admin'] = TRUE;
            $return['is_subadmin'] = TRUE;
        }
        else if( $CI->member->level() >= 7 )
        {
            // 지사일경우
            $return['is_subadmin'] = TRUE;
        }

        return $return;
    }
}