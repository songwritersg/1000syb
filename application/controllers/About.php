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
     * A02 회사 소개 페이지
     *********************************************************/
    function index()
    {
        $this->layout = $this->site->get_layout();
        $this->view = "about/index";
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
}
