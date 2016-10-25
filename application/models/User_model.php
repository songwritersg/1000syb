<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*************************************************************
 *
 * Class User_model
 *
 * 회원 관련 모델
 *
 ***********************************************************/
class User_model extends SYB_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*************************************************************
     *
     * 회원 아이디를 기준으로 한 행을 가져와 반환합니다.
     * @param $usr_id
     *
     ************************************************************/
    function get_by_id( $usr_id )
    {
        $this->db->select("U.*, A.`ath_name`, A.`ath_value`, A.`ath_level`");
        $this->db->where("usr_id", $usr_id);
        $this->db->from("tbl_user AS U");
        $this->db->join("tbl_user_auth AS A", "A.`ath_idx`=U.`ath_idx`", "left");
        $this->db->limit(1);
        $result = $this->db->get();

        if( $result )
        {
            return $result->row_array();
        }
        else
        {
            return FALSE;
        }
    }
}