<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Products
 *
 * 상품 페이지 컨트롤러
 */
class Products extends SYB_Controller {

    /**********************************************************
     *
     * A02 회사 소개 페이지
     *
     * Author : 장선근 <jang@tjsrms.me>
     * Design : 최건우
     * Date : 20161014
     *********************************************************/
    function view( $prd_idx = "" )
    {
        if(empty($prd_idx))
        {
            alert('잘못된 접근입니다.');
            exit;
        }

        $this->load->library("product");

        $this->data['product'] = $this->product->get_product($prd_idx);

        if( empty($this->data['product']) )
        {
            alert('잘못된 접근입니다.');
            exit;
        }

        $this->layout = $this->site->get_layout();
        $this->view = "products/view";
    }
}
