<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class About
 *
 * 소개페이지 컨트롤러
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2016.10.14
 *************************************************************************************/
class About extends SYB_Controller {

    /**********************************************************
     * A02 본사 안내
     *********************************************************/
    function index()
    {
        $this->layout = $this->site->get_layout();
        $this->view = "about/index";
    }

    /**********************************************************
     * A02 지사 안내
     *********************************************************/
    function branch( $bnc_name = "" )
    {
        $bnc_name = urldecode($bnc_name);
        $this->load->model('site_branch_model');
        $this->data['branch_list'] = $this->site_branch_model->get_branch_list();
        if(empty($bnc_name)) {
            $bnc_name = $this->data['branch_list'][0]['bnc_name'];
        }
        $this->data['view'] = array();
        foreach($this->data['branch_list'] as $row)
        {
            if( $row['bnc_name'] == $bnc_name ) {
                $this->data['view'] = $row;
                break;
            }
        }
        if( ! $this->data['view'] )
        {
            //redirect('404');
            exit;
        }
        $this->layout = $this->site->get_layout();
        $this->view = "about/branch";
    }

    /**********************************************************
     * A03L 이용약관
     *********************************************************/
    function agreement()
    {
        $this->layout = $this->site->get_layout();
        $this->view = "about/agreement";
    }

    /**********************************************************
     * A04L 개인정보 취급방침
     *********************************************************/
    function privacy()
    {
        $this->layout = $this->site->get_layout();
        $this->view = "about/privacy";
    }

    /**********************************************************
     * A05L 여행약관
     *********************************************************/
    function travel()
    {
        $this->layout = $this->site->get_layout();
        $this->view = "about/travel";
    }

    /**********************************************************
     * A06L 천생연분닷컴 이벤트
     *********************************************************/
    function events()
    {
        $this->load->model('site_events_model');

        // 하단이벤트 목록
        $this->data['event_list'] =$this->site_events_model->get_event_list();


        $this->layout = $this->site->get_layout();
        $this->view = "about/events";
    }
}
