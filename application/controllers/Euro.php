<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Products
 *
 * 상품 페이지 컨트롤러
 */
class Euro extends SYB_Controller
{
    protected $intereuro_key = "5798a2bacfa313df9c3a3612a28f9220";

    function __construct()
    {
        parent::__construct();

        $this->load->model('product_model');
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
    function lists($sca_parent, $category="weuro")
    {
        $areacode = strtoupper(str_replace("uro","",$category));

        $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        if(! $this->data['lists'] = $this->cache->get('intereuro_list_'.$areacode) )
        {
            // InterEuro CURL GET
            $url = "http://papi.intereuro.co.kr/01_B2B/Product/Package/ProductList.aspx?key={$this->intereuro_key}&txtAreaCode={$areacode}&txtPageSize=50";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
            $output=curl_exec($ch);
            if(curl_errno($ch))
            {
                alert('해당페이지의 정보를 불러오는데 실패하였습니다.\\n관리자에게 문의하세요');
            }
            curl_close($ch);
            $output = json_decode($output, TRUE);

            if(! $output OR !$output['RESULT'][0]['Result']) {

                if(! $this->data['lists'] = $this->cache->get('intereuro_saved_list_'.$areacode))
                {
                    alert('해당페이지의 정보를 불러오는데 실패하였습니다.\\n관리자에게 문의하세요');
                    exit;
                }
            }
            else
            {
                $list = $output['PRODUCT_LIST_INFO'];

                $this->data['lists'] = array();

                foreach($list as $row)
                {
                    $tmp = explode("(",$row['ProductName']);

                    $this->data['lists'][] = array(
                        'prd_idx' => $row['ProductIdx'],
                        'prd_thumb' => $row['ImageUrl'],
                        'prd_title' => $tmp[0],
                        'cty_name' => $row['ProductCountryName'],
                        'ppr_price' => $row['LowProductPrice']
                    );

                }
                $this->cache->save('intereuro_list_'.$areacode, $this->data['lists'], 60);  // 60초동안 저장
                $this->cache->save('intereuro_saved_list_'.$areacode, $this->data['lists'], 60*60*24*7);  // 7일동안 저장
            }
        }

        $this->data['category'] = $this->product_model->get_category($sca_parent);
        $this->data['selected'] = $category;

        $this->site->meta_title = "";
        $this->site->meta_descrption = "";
        $this->site->meta_keywords = "";
        $this->active = $sca_parent;
        $this->layout = $this->site->get_layout();
        $this->view = "products/lists";
    }
}