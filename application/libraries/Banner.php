<?php

class Banner {

    protected $CI;
    protected $banners;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    function lists( $ban_type )
    {
        if( empty($ban_type) ) return false;

        if( empty($banners) OR count($banners) <= 0 )
        {
            $this->CI->db->where("ban_use_timer", "N");
            $this->CI->db->or_group_start();
            $this->CI->db->where("ban_use_timer","Y");
            $this->CI->db->where("ban_startdate <=", date('Y-m-d H:i:s'));
            $this->CI->db->where("ban_enddate >=", date('Y-m-d H:i:s'));
            $this->CI->db->group_end();
            $result = $this->CI->db->get("tbl_banners");
            $this->banners = $result->result_array();
        }

        $return = array();
        foreach($this->banners as &$banner)
        {
            if($banner['ban_type'] == $ban_type)
            {
                $banner['tag'] = "";
                $banner['tag'] .= ( $banner['ban_use_href'] ) ? " href=\"{$banner['ban_url']}\"" : '';
                $banner['tag'] .= ( $banner['ban_use_href'] && $banner['ban_newwin'] == 'Y' ) ? ' target="_blank"' :'';
                $return[] = $banner;
            }
        }

        return $return;
    }

}