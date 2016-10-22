<?php
/**
 * Class Product
 *
 * 상품관련 라이브러리
 */
class Product {

    protected $CI;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    /****************************************************************
     *
     * 상품정보 고유번호를 이용하여 상품정보 한 행을 가져온다.
     * @param $prd_idx
     * @return null
     *
     **************************************************************/
    function get_product( $prd_idx )
    {
        if(empty($prd_idx)) return NULL;

        $result =
            $this->CI->db
                 ->where('prd_idx', $prd_idx)
                 ->get("tbl_product");

        $product = $result->row_array();

        return $product;
    }
}