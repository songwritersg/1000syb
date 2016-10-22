<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class About
 *
 * 소개페이지 컨트롤러
 */
class About extends SYB_Controller {

    /**********************************************************
     *
     * A02 회사 소개 페이지
     *
     * Author : 장선근 <jang@tjsrms.me>
     * Design : 최건우
     * Date : 20161014
     *********************************************************/
    function index()
    {
        $this->layout = $this->site->get_layout();
        $this->view = "about/index";
    }
}
