<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*************************************************************
 *
 * Class Site_events_model
 *
 * 사이트 이벤트 페이지 관련 모델
 *
 ***********************************************************/
class Site_events_model extends SYB_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_event_list()
    {
        $this->db->order_by('sev_sort ASC');
        $result = $this->db->get("tbl_site_events");
        $list = $result->result_array();
        foreach($list as &$row)
        {
            $row['sev_dates'] = "";
            $row['sev_dates'] .= date('Y.m.d', strtotime($row['sev_startdate']));
            $row['sev_dates'] .= "(" . get_yoil($row['sev_startdate']) . ")";
            $row['sev_dates'] .=  " ~ ";
            if( date('Y', strtotime($row['sev_startdate'])) != date('Y', strtotime($row['sev_enddate'])))
            {
                $row['sev_dates'] .= date('Y.', strtotime($row['sev_enddate']));
            }
            if( date('m', strtotime($row['sev_startdate'])) != date('m', strtotime($row['sev_enddate'])) )
            {
                $row['sev_dates'] .= date('m.', strtotime($row['sev_enddate']));
            }
            $row['sev_dates'] .= date('d', strtotime($row['sev_enddate']));
            $row['sev_dates'] .= "(" . get_yoil($row['sev_enddate']) . ")";
            $row['sev_on'] = ( strtotime(date('Y-m-d')) <= strtotime($row['sev_enddate']) ) ? TRUE : FALSE;

        }

        return $list;
    }
}