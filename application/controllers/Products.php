<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Products
 *
 * 상품 페이지 컨트롤러
 */
class Products extends SYB_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model('product_model');
        $this->load->model('board_model');
    }

    /**********************************************************
     *
     * 상품 상세보기 페이지
     *
     * Author : 장선근 <jang@tjsrms.me>
     * Design : 최건우
     * Date : 20161014
     *********************************************************/
    function view( $sca_parent, $sca_key, $prd_idx = "", $prg_idx="" )
    {
        $this->data['sca_parent'] = $sca_parent;
        $this->data['sca_key'] = $sca_key;

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

        // 일정표 정보를 가져온다.
        $this->data['prg_idx'] = $prg_idx;
        if(empty($this->data['prg_idx']))
        {
            // 선택된 일정표가 없다면 해당 상품의 첫번째 일정표를 가져온다.
            foreach($this->data['product']['program_list'] as $program_sub)
            {
                if($program_sub['ppm_default'] == 'Y')
                {
                    $this->data['prg_idx'] = $program_sub['prg_idx'];
                    break;
                }
            }
        }

        $this->data['program_info'] = $this->product_model->get_program($this->data['prg_idx']);
        if(! $this->data['program_info'] )
        {
            alert('잘못된 접근입니다.');
            exit;
        }

        // 같은 지역의 카테고리 목록
        $this->data['category'] = $this->product_model->get_category($sca_parent);
        // 같은 카테고리의 상품들
        $this->data['product_list'] = $this->product_model->get_list($sca_key);

        // 상품문의하기 게시판 카테고리를 가져온다.
        $this->data['qna_category'] = $this->board_model->get_category("sybqna");

        $this->site->meta_title = $this->data['product']['prd_title'];
        $this->site->meta_descrption = $this->data['product']['prd_subtitle'];
        $this->site->meta_keywords = "{$this->data['product']['ctr_name_kr']},{$this->data['product']['cty_name_kr']}";
        $this->active = $sca_parent;
        $this->layout = $this->site->get_layout();
        $this->view = "products/view";
    }
    
    /***********************************************************
     * 상품 리스트
     * @param $sca_parent
     * @param string $sca_key
     **********************************************************/
    function lists($sca_parent, $sca_key="")
    {
        if(empty($sca_parent))
        {
            alert('잘못된 접근입니다.');
            exit;
        }
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

    /**************************************************************
     * 상품 이미지 갤러리
     * @param $room_idx
     **************************************************************/
    function gallery($room_idx)
    {
        if(empty($room_idx))
        {
            alert_close("잘못된 접근입니다.");
            exit;
        }

        // 룸정보를 가져온다.
        if(!$this->data['room'] = $this->product_model->get_room($room_idx))
        {
            alert_close("잘못된 접근입니다.");
            exit;
        }

        // 해당 룸의 갤러리 목록을 가져옵니다.
        $this->data['gallery_list'] = $this->product_model->get_gallery($room_idx);

        $this->layout = "popup";
        $this->view = "products/gallery";
    }

    /*******************************************************************************************
     *
     * 월별 허니문 추천 지역
     *
     *******************************************************************************************/
    function recommend()
    {
        $this->layout = $this->site->get_layout();
        $this->view = "products/recommend";
    }
}
