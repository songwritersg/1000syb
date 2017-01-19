<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class Customer
 *
 * 고객지원 컨트롤러
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2017.01.03
 *************************************************************************************/
class Customer extends SYB_Controller
{

    /**********************************************************
     * A02 본사 안내
     *********************************************************/
    function sitemap()
    {
        $this->load->model('product_model');
        $this->load->model('site_branch_model');


        $this->data['site_category'] = $this->product_model->get_schema();
        $this->data['branch_list'] = $this->site_branch_model->get_branch_list();

        $this->site->meta_title = "사이트맵";
        $this->site->meta_description = "천생연분닷컴 전체 사이트맵을 제공합니다.";

        $this->layout = $this->site->get_layout();
        $this->view = "customer/sitemap";
    }
}