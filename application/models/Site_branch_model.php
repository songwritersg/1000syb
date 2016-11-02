<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*************************************************************
 *
 * Class Site_branch_model
 *
 * 사이트 지점안내 페이지 관련 모델
 *
 ***********************************************************/
class Site_branch_model extends SYB_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_branch_list()
    {
        $this->db->order_by('bnc_sort ASC');
        $result = $this->db->get("tbl_site_branch");
        $list = $result->result_array();

        return $list;
    }
}