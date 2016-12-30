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

        $this->site->meta_title = "본사 소개";
        $this->site->meta_description = "대한민국 모든 예비 신혼부부에게 설레임과 추억을 선물해드립니다. 허니문 여행사의 기준, 천생연분닷컴";

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

        $this->site->meta_title = "지사 안내 - " . $row['bnc_name'];
        $this->site->meta_description = "천생연분 닷컴 {$row['bnc_name']} 지사 안내 입니다. 대표전화:".$this->data['view']['bnc_tel'] . " FAX:".$this->data['view']['bnc_fax']. " 주소:".$this->data['view']['bnc_address'];

        $this->layout = $this->site->get_layout();
        $this->view = "about/branch";
    }

    /**********************************************************
     * A03L 이용약관
     *********************************************************/
    function agreement()
    {
        $this->site->meta_title = "이용약관";
        $this->site->meta_description = "본 약관은 ㈜네이버네트워크가 운영하는 천생연분닷컴(이하 '몰'이라 한다)에서 제공하는 인터넷 관련 서비스를 이용함에 있어서 '몰'과 이용자의 권리, 의무 및 책임사항을 규정함을 목적으로 합니다.";

        $this->layout = $this->site->get_layout();
        $this->view = "about/agreement";
    }

    /**********************************************************
     * A04L 개인정보 취급방침
     *********************************************************/
    function privacy()
    {
        
        $this->site->meta_title = "개인정보 취급방침";
        $this->site->meta_description = "(주)네이버네트워크는 (이하 '회사'는) 고객님의 개인정보를 중요시하며, '정보통신망 이용촉진 및 정보보호'에 관한 법률을 준수하고 있습니다.";

        $this->layout = $this->site->get_layout();
        $this->view = "about/privacy";
    }

    /**********************************************************
     * A05L 여행약관
     *********************************************************/
    function travel()
    {
        $this->site->meta_title = "여행약관";
        $this->site->meta_description = "천생연분닷컴의 여행약관입니다. 이 약관은 여행사와 여행자가 체결한 국외여행계약의 세부 이행 및 준수사항을 정함을 목적으로 합니다.";
        
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

        $result = $this->db->order_by('sed_sort ASC')->get('tbl_site_events_detail');
        $this->data['event_banner_list'] = $result->result_array();

        $this->site->meta_title = "지역별 박람회";
        $this->site->meta_description = "천생연분닷컴 허니문 전문여행사의 전국의 지사들과 박람회를 한눈에!";

        $this->layout = $this->site->get_layout();
        $this->view = "about/events";
    }
}
