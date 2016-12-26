<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Products
 *
 * 상품 페이지 컨트롤러
 */
class Euro extends SYB_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('product_model');
        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        $this->load->library('intereuro');
    }

    /***********************************************************
     * 인터유로 API를 통해 자료를 받아온다.
     *
     * 받아온 정보는 임시캐시와 보관캐시로 나누어
     * 임시캐시 60초, 보관캐시 7일 동안 저장한다.
     *
     * 임시캐시가 존재하지않으면 API를 통해 정보를 얻어와 임시캐시와 보관캐시에 저장하고
     * 정보를 얻어오는과정에서 인터유로측 API에 접속할수 없는경우 보관캐시를 사용한다.
     *
     * @param $sca_parent
     * @param string $category
     *********************************************************/
    function lists($sca_parent, $sca_key="weuro")
    {
        $areacode = strtoupper(str_replace("uro","",$sca_key));
        if(strtolower($sca_key) == 'duba') $areacode = 'WA';

        // 상품목록을 불러와 저장한다.
        if(! $this->data['lists'] = $this->intereuro->get_product_list($areacode))
        {
           alert('해당페이지의 정보를 불러오는데 실패하였습니다.\\n관리자에게 문의하세요');
           exit;
        }
        $this->data['category'] = $this->product_model->get_category($sca_parent);
        $this->data['selected'] = $sca_key;

        $this->site->meta_title =  $this->data['category']['sca_info_title'] . " - " .$this->data['category']['sca_info_subtitle'] ;
        $this->site->meta_descrption = $this->data['category']['sca_info_description'];
        $this->site->meta_keywords = $this->data['category']['sca_info_title'];
        $this->active = $sca_parent;
        $this->layout = $this->site->get_layout();
        $this->view = "products/lists";
    }

    /****************************************************************
     * 유로 상품보기
     * @param $sca_parent
     * @param $sca_key
     * @param string $prd_idx
     * @param string $prg_idx
     ****************************************************************/
    function view( $sca_parent, $sca_key, $prd_idx = "", $prg_idx="" )
    {
        $this->data['sca_parent'] = $sca_parent;
        $this->data['sca_key'] = $sca_key;

        $areacode = strtoupper(str_replace("uro","",$sca_key));
        if(strtolower($sca_key) == 'duba') $areacode = 'WA';

        if(empty($prd_idx))
        {
            alert('잘못된 접근입니다.'.$prd_idx);
            exit;
        }

        // 상품에 대한 정보 가져오기
        if(! $this->data['product_list'] = $this->intereuro->get_product_list($areacode))
        {
            alert('해당페이지의 정보를 불러오는데 실패하였습니다.\\n관리자에게 문의하세요');
            exit;
        }

        if(! $this->data['product'] = $this->intereuro->get_product($areacode, $prd_idx))
        {
            alert('해당하는 상품정보가 없습니다.');
            exit;
        }

        if(! $this->data['program_list'] = $this->intereuro->get_product_program_list($prd_idx))
        {
            alert('해당하는 상품에 현재 예약가능한 상품이 없습니다.');
            exit;
        }

        // 상품상세 데이타 불러오기
        // 넘어온 상품상세 IDX가 없다면 리스트중 가장 첫번째걸 선택
        $prg_idx = (empty($prg_idx)) ? $this->data['program_list'][0]['prg_idx'] : $prg_idx;

        if(! $this->data['view'] = $this->intereuro->get_product_detail($prd_idx, $prg_idx))
        {
            alert('해당 상품정보를 불러올 수 없습니다.');
            return false;
        }

        $this->data['product']['gallery_list'] = array();
        foreach($this->data['view']['TOUR_LOCATION_INFO'] as $tour_info)
        {
            $this->data['product']['gallery_list'] = array_merge($this->data['product']['gallery_list'], explode("|",$tour_info['Images']) );
        }

        // 관광지 정보를 국가별로 묶는다.
        $this->data['view']['tours'] = array();
        foreach($this->data['view']['TOUR_LOCATION_INFO'] as $tour) {
            $this->data['view']['tours'][ $tour['NationName'] ][] = $tour;
        }



        $this->data['prd_idx'] = $prd_idx;
        $this->data['prg_idx'] = $prg_idx;

        $this->data['category'] = $this->product_model->get_category($sca_parent);

        $this->site->meta_title = "";
        $this->site->meta_descrption = "";
        $this->site->meta_keywords = "";
        $this->active = $sca_parent;
        $this->layout = $this->site->get_layout();
        $this->view = "products/euro_view";
    }

}