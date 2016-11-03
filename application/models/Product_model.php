<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*************************************************************
 *
 * Class Product_model
 *
 * 사이트 상품 관련 모델
 *
 ***********************************************************/
class Product_model extends SYB_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /*************************************************************
     * 카테고리 정보를 가져옵니다.
     * 부모 카테고리일 경우 하위카테고리 정보도 같이 가져옵니다.
     * @param $sca_key
     * @return null
     ************************************************************/
    function get_category( $sca_key )
    {
        if(empty($sca_key)) return NULL;

        $this->db->where("sca_key", $sca_key);
        $this->db->limit(1);
        $result = $this->db->get('tbl_site_category');
        $product = $result->row_array();

        if(! $product) return NULL;

        if( $product['sca_depth'] == 0 )
        {
            // 하위 카테고리를 불러온다.
            $this->db->where("sca_parent", $product['sca_idx']);
            $this->db->order_by("sca_sort ASC");
            $result = $this->db->get("tbl_site_category");
            $product['children'] = $result->result_array();

            // TOP 1,TOP 2, TOP 3데이타를 가져온다.
            for($i=1; $i<=3; $i++)
            {
                $product["sca_top_{$i}"] =  ($product["sca_top_{$i}"]) ? $this->get_top_product($product["sca_top_{$i}"], $sca_key) : array();
                $product["sca_top_{$i}"]['prd_detail'] = $product["sca_top_{$i}_desc"];
            }
        }

        return $product;
    }

    /**************************************************************
     * 지역별 BEST 상품 정보를 가져오는데 사용합니다.
     * @param $prd_idx
     * @param $sca_key
     * @return mixed
     ************************************************************/
    function get_top_product($prd_idx, $sca_key)
    {
        $this->db->select("P.prd_title,P.prd_thumb,P.prd_idx,SP.sca_parent,SP.sca_key");
        $this->db->from("tbl_product AS P");
        $this->db->join("tbl_site_product AS SP","SP.prd_idx=P.prd_idx AND SP.sca_parent='{$sca_key}'","INNER");
        $this->db->where("P.prd_idx", $prd_idx);
        $this->db->limit(1);
        $ret = $this->db->get();
        $prod = $ret->row_array();

        return $prod;
    }


    /************************************************************
     * 상품 상세정보를 가져옵니다.
     * @param $prd_idx
     ***********************************************************/
    function get_product( $prd_idx )
    {
        $this->db->select("P.*,BEN.*");
        $this->db->from("tbl_product AS P");
        $this->db->join("tbl_product_benefit AS BEN", "BEN.ben_idx=P.ben_idx","left");
        $this->db->where("P.prd_idx", $prd_idx);
        $result = $this->db->get();
        $product = $result->row_array();

        if(! $product ) return NULL;

        // 입력된 상품특전이 있으면 정리한ㄷ.
        if( isset($product['ben_content']) && $product['ben_content'] )
        {
            $product['ben_content'] = json_decode($product['ben_content'], TRUE);
        }

        // 연결된 일정표 목록을 가져온다.
        $this->db->select("PP.*,PR.*, AR.ail_icon, ARF.alf_adjustment");
        $this->db->where("PP.prd_idx", $prd_idx);
        $this->db->join("tbl_program AS PR", "PR.prg_idx=PP.prg_idx","inner");
        $this->db->join("tbl_airline AS AR", "AR.ail_key=PR.prg_ail_key_1","inner");
        $this->db->join("tbl_airline_flight AS ARF", "ARF.alf_name=PR.prg_alf_name_1","left");
        $this->db->order_by("PP.ppm_sort ASC");
        $result = $this->db->get("tbl_product_program AS PP");
        $product['program_list'] = $result->result_array();

        // 연결된 일정표와 연결된 룸타입을 가져온다 (가격정보포함)
        foreach($product['program_list'] as &$program)
        {
            $this->db->from("tbl_product_program_price AS PPP");
            $this->db->join("tbl_product_rooms AS R", "R.room_idx=PPP.room_idx","INNER");
            $this->db->where("PPP.prd_idx", $prd_idx);
            $this->db->where("PPP.ppm_idx", $program['ppm_idx']);
            $this->db->order_by("R.room_sort ASC");
            $ret = $this->db->get();
            $program['price_list'] = $ret->result_array();
        }

        // 이 상품과 연동된 이미지를 가져옵니다.
        $this->db->where("prd_idx", $prd_idx);
        $this->db->order_by("gll_sort ASC");
        $result = $this->db->get("tbl_product_gallery");
        $product['gallery_list'] = $result->result_array();

        return $product;
    }

    /**************************************************************************************
     * 일정표 정보를 가져온다.
     * @param $prg_idx
     ************************************************************************************/
    function get_program($prg_idx)
    {
        $this->db->where("prg_idx", $prg_idx);
        $this->db->limit(1);
        $result = $this->db->get("tbl_program");
        $program = $result->row_array();
        if( ! $program ) return NULL;
        $program['schedule'] = json_decode( $program['prg_schedule'], TRUE );
        return $program;
    }

    /*******************************************************
     * 해당 카테고리에 등록된 리스트를 가져온다.
     * @param $sca_key
     *****************************************************/
    function get_list($sca_key)
    {
        $this->db->select("P.*,C.cty_name, `PPP`.`ppr_price`");
        $this->db->from("tbl_site_product AS PP");
        $this->db->join("tbl_product AS P","PP.prd_idx=P.prd_idx AND P.prd_status='Y'","inner");
        $this->db->join("tbl_country_city AS C","C.cty_key=P.cty_key","inner");
        $this->db->join("(SELECT prd_idx, min(ppr_price) AS ppr_price FROM tbl_product_program_price GROUP BY prd_idx) AS PPP","PPP.prd_idx=PP.prd_idx","left");
        $this->db->where("PP.sca_key", $sca_key);
        $this->db->order_by("PP.prd_sort ASC");
        $result = $this->db->get();
        return $result->result_array();
    }

    /******************************************************
     * 룸타입 정보를 가져온다.
     * @param $room_idx
     ******************************************************/
    function get_room($room_idx)
    {
        $this->db->select("R.room_idx, R.room_title, P.prd_title");
        $this->db->from("tbl_product_rooms AS R");
        $this->db->join("tbl_product AS P","P.prd_idx=R.prd_idx");
        $this->db->where("room_idx", $room_idx);
        $this->db->limit(1);
        $result = $this->db->get();

        return $result->row_array();
    }

    /*******************************************************
     * 해당 룸타입의 갤러리를 가져온다.
     * @param $room_idx
     *******************************************************/
    function get_gallery($room_idx)
    {
        $this->db->where("room_idx", $room_idx);
        $this->db->order_by("gll_sort ASC");
        $result = $this->db->get("tbl_product_gallery");
        return $result->result_array();
    }
}