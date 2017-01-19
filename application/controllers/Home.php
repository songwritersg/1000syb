<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class Home
 * 
 * 메인페이지 컨트롤러
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2016.10.01
 *************************************************************************************/
class Home extends SYB_Controller {

	public function index()
	{
	    $this->data['main_slide_banners'] = $this->banner->lists("MAIN_SLIDE");
        $this->data['main_middle_banners'] = $this->banner->lists("MAIN_MIDDLE");
        $this->data['main_best_banners'] = $this->banner->lists("MAIN_BEST");
        $this->data['mobile_slide_banners'] = $this->banner->lists("MOBILE_MAIN_SLIDE");

        // BEST 상품목록을 가져온다.
        $this->db->select("B.*,P.prd_title, P.prd_thumb, C.cty_name, C.cty_name_kr");
        $this->db->from("tbl_site_product_best AS B");
        $this->db->join("tbl_product AS P","P.prd_idx=B.prd_idx","inner");
        $this->db->join("tbl_country_city AS C","C.cty_key=P.cty_key","inner");
        $this->db->order_by("B.spb_sort ASC");
        $result = $this->db->get();

        $this->data['best_products'] = $result->result_array();

	    $this->view = "home/index";
        $this->layout =  $this->site->get_layout();
	}
}
