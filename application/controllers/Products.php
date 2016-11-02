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
    function view( $sca_parent, $sca_key, $prd_idx = "" )
    {
        $this->load->model('product_model');

        if(empty($prd_idx))
        {
            alert('잘못된 접근입니다.');
            exit;
        }

        $this->data['product'] = $this->product_model->get_product($prd_idx);

        if( empty($this->data['product']) )
        {
            alert('잘못된 접근입니다.');
            exit;
        }

        $this->site->meta_title = $this->data['product']['prd_title'];
        $this->site->meta_descrption = $this->data['product']['prd_subtitle'];
        $this->site->meta_keywords = "{$this->data['product']['ctr_name_kr']},{$this->data['product']['cty_name_kr']}";
        $this->active = $sca_parent;
        $this->layout = $this->site->get_layout();
        $this->view = "products/view";
    }

    function lists($sca_parent, $sca_key="")
    {
        $this->output->enable_profiler(TRUE);
        if(empty($sca_parent))
        {
            alert('잘못된 접근입니다.');
            exit;
        }
        $this->load->model('product_model');
        $this->data['category'] = $this->product_model->get_category($sca_parent);

        if(!$this->data['category'] OR $this->data['category']['sca_depth'] != 0 )
        {
            alert('존재하지 않는 지역입니다.');
            exit;
        }

        // 두번째 카테고리가 없는경우 첫번재 카테고리의 가장 첫번째 세부 카테고리를 가져온다.
        if( empty($sca_key) OR ! $sca_key )
        {
            $sca_key = $this->data['category']['children'][0]['sca_key'];
        }

        $this->data['selected'] = $sca_key;
        // 등록된 리스트를 가져온다.
        $this->data['lists'] = $this->product_model->get_list($sca_key);

        $this->active = $sca_parent;
        $this->layout = $this->site->get_layout();
        $this->view = "products/lists";
    }
}
