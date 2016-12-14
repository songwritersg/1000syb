<?php
class Intereuro {

    const INTEREURO_KEY = "5798a2bacfa313df9c3a3612a28f9220";
    const INTEREURO_LIST_URL = "http://papi.intereuro.co.kr/01_B2B/Product/Package/ProductList.aspx";
    const INTEREURO_PROGRAM_LIST_URL = "http://papi.intereuro.co.kr/01_B2B/Product/Package/Product_PriceList.aspx";
    const INTEREURO_PRODUCT_DETAIL_URL = "http://papi.intereuro.co.kr/01_B2B/Product/Package/ProductView.aspx";
    protected $CI;

    function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
    }

    /**
     * Curl GET 처리
     * @param string $url
     * @return bool|mixed|null
     */
    function curl_response($url="")
    {
        if(empty($url)) return NULL;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, TRUE);
        $output=curl_exec($ch);
        if(curl_errno($ch)) return FALSE;
        curl_close($ch);
        $output = json_decode($output, TRUE);
        return $output;
    }

    /**
     * 상품 하나의 정보를 가져온다.
     * @param string $txtAreaCode
     * @param string $prd_idx
     * @return mixed|null
     */
    function get_product($txtAreaCode="", $prd_idx="")
    {
        if(empty($txtAreaCode) OR (int)$prd_idx <= 0) return NULL;

        if(! $product = $this->CI->cache->get('intereuro_product_'.$prd_idx))
        {
            if( ! $list = $this->get_product_list($txtAreaCode)) {
                return NULL;
            }

            foreach($list as $row)
            {
                if( $row['prd_idx'] == $prd_idx ){
                    $product = $row;
                    break;
                }
            }
        }

        return $product;
    }

    function get_product_detail($prd_idx="", $prg_idx="")
    {
        if((int)$prd_idx <= 0 OR (int)$prg_idx <= 0) return NULL;

        if(! $view = $this->CI->cache->get('intereuro_product_detail_'.$prd_idx.'_'.$prg_idx) )
        {
            $param['Key'] = self::INTEREURO_KEY;
            $param['txtProductIdx'] = $prd_idx;
            $param['txtProductPriceIdx'] = $prg_idx;
            $url = self::INTEREURO_PRODUCT_DETAIL_URL. "?".http_build_query($param);
            $output = $this->curl_response($url);

            if(! $output OR !$output['RESULT'][0]['Result'] ) {
                return NULL;
            }

            unset($output['RESULT']);

            $view = $output;

            // 일정표 정리
            $program_detail = array();
            foreach($view['SCHEDULE_INFO'] as $row)
            {
                $program_detail[ $row['DayCount'] - 1][] = $row;
            }
            $view['schedule'] = $program_detail;
            unset($view['SCHEDULE_INFO']);

            $this->CI->cache->save('intereuro_product_detail_'.$prd_idx.'_'.$prg_idx, $view, 60);
        }

        return $view;
    }

    /**
     * 상품의 출발일자,항공별 목록 가져오기
     * @param string $prd_idx
     * @return array|null
     */
    function get_product_program_list($prd_idx="")
    {
        if((int)$prd_idx <= 0) return NULL;

        if(! $list = $this->CI->cache->get('intereuro_program_list_'.$prd_idx))
        {
            $param['Key'] = self::INTEREURO_KEY;
            $param['txtProductIdx'] = $prd_idx;
            $param['txtSearchCnt'] = 0;
            $url = self::INTEREURO_PROGRAM_LIST_URL."?".http_build_query($param);

            if(! $output = $this->curl_response($url) OR ! $output['RESULT'][0]['Result'] ) {
                $list = $this->CI->cache->get('intereuro_program_list_saved_'.$prd_idx);
            }
            else {
                $list = array();
                foreach($output['PRODUCT_PRICE_LIST_INFO'] as $row)
                {
                    $list[] = array(
                        "airline_key" => $row["OutBoundCarrierCode"],
                        "airline_name" => $row["OutBoundCarrierName"],
                        "prg_idx" => $row['ProductPriceIdx'],
                        "price" => $row['ProductPrice'],
                        "start_date" => $row['OutBoundSeasonsStartDate'],
                        "end_date" => $row['OutBoundSeasonsEndDate'],
                        "flight_type" => $row['FlightType']
                    );
                }

                $this->CI->cache->save('intereuro_program_list_'.$prd_idx, $list, 60);  // 60초동안 저장
                $this->CI->cache->save('intereuro_program_list_saved_'.$prd_idx, $list, 60*60*24*7);  // 7일동안 저장
            }
        }
        return $list;
    }

    /**
     * 상품 기본정보 리스트
     * @param string $txtAreaCode
     * @param int $page_rows
     * @return array|bool|null
     */
    function get_product_list($txtAreaCode="", $page_rows = 50)
    {
        if(empty($txtAreaCode)) return NULL;

        if(! $list = $this->CI->cache->get('intereuro_list_'.$txtAreaCode) )
        {
            // InterEuro CURL GET
            $param['Key'] = self::INTEREURO_KEY;
            $param['txtAreaCode'] = $txtAreaCode;
            $param['txtPageSize'] = $page_rows;
            
            $url = self::INTEREURO_LIST_URL . "?". http_build_query($param);
            if(!$output = $this->curl_response($url) ) return FALSE;

            // 결과가 false일경우
            if(! $output OR !$output['RESULT'][0]['Result']) {
                // 7일짜리 캐시에 저장된 데이타가 있으면 가져온다.
                if(! $output = $this->CI->cache->get('intereuro_saved_list_'.$txtAreaCode)){
                    return FALSE;
                }
            }

            $lists = $output['PRODUCT_LIST_INFO'];

            $list = array();
            foreach($lists as $row)
            {
                $tmp = explode("_",$row['ProductName']);
                $prd_title = $tmp[0];
                $array = array(
                    'prd_idx' => $row['ProductIdx'],
                    'prd_thumb' => $row['ImageUrl'],
                    'prd_title' => $prd_title,
                    'cty_name' => $row['ProductCountryName'],
                    'ppr_price' => $row['LowProductPrice']
                );
                $list[] = $array;
                $this->CI->cache->save('intereuro_product_'.$row['ProductIdx'], $array, 60);
            }

            $this->CI->cache->save('intereuro_list_'.$txtAreaCode, $list, 60);  // 60초동안 저장
            $this->CI->cache->save('intereuro_saved_list_'.$txtAreaCode, $list, 60*60*24*7);  // 7일동안 저장
        }

        return $list;
    }
}