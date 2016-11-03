<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
/**************************************************************
 * 상품 정보용 REST API
 *
 * @author Jang seongeun <jang@tjsrms.me>
 * @date 2016.11.03
 **************************************************************/
class Products extends REST_Controller {

    protected $return;

    function __construct()
    {
        parent::__construct();

        $this->return['status'] = FALSE;
        $this->return['result'] = NULL;
        $this->return['message'] = NULL;
    }

    function info_get()
    {
        // AJAX 요청이 아닌경우, HTTP NOT ALLOWED
        if (! $this->input->is_ajax_request()) {
            $this->response($this->return, SELF::HTTP_METHOD_NOT_ALLOWED);
        }

        $sca_key = $this->get("sca_key", TRUE);
        $prd_idx = $this->get('prd_idx', TRUE);

        $this->load->model('product_model');

        // 리스트 보내기
        if(empty($prd_idx))
        {
            $this->return['result'] = $this->product_model->get_list($sca_key);
            if( $this->return['result'] )
            {
                $this->return['status'] = TRUE;
                $this->return['message'] = "SUCCESS";
            }
            else
            {
                $this->response($this->return, SELF::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
        else
        {
            
        }

        $this->response($this->return, SELF::HTTP_OK);
    }

}

