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

    /*******************************************************************************************************
     * 이메일 보내기 파일첨부
     *******************************************************************************************************/
    function attach_post()
    {
        $this->load->library("upload");

        $upload_url = "files/attach/".date('Y')."/".date('m')."/";
        make_dir($upload_url);
        $upload_path = "./".$upload_url;

        if (isset($_FILES)
            && isset($_FILES['userfile'])
            && isset($_FILES['userfile']['name'])) {

            $uploadconfig = array( 'upload_path' => $upload_path, 'allowed_types' => '*', 'max_size' => 15 * 1024, 'encrypt_name' => true);
            $this->upload->initialize($uploadconfig);

            if ($this->upload->do_upload('userfile')) {
                $filedata = $this->upload->data();
                $this->response(["status"=>TRUE, "result"=>$filedata],SELF::HTTP_OK );

            } else {
                $this->response(["status"=>FALSE, "result"=>$this->upload->display_errors(' ',' ')],SELF::HTTP_OK );
            }

        }
    }

    /*******************************************************************************************************
     * 이메일 보내기 파일첨부 삭제
     *******************************************************************************************************/
    function attach_delete()
    {
        $path = $this->delete('path', TRUE);
        if($path && file_exists($path))
        {
            if( @unlink($path) ) {
                echo "SUCCESS";
            }
            else {
                echo "REMOVE FAILED";
            }
        }
        else
        {
            echo "FILE NOT FOUND";
        }
    }

    function sybqna_post()
    {
        $this->load->model('board_model');

        $data['brd_key'] = "sybqna";
        $data['post_category'] = $this->post('post_category', TRUE);
        $data['post_title'] = $this->post("post_title", TRUE);
        $data['post_depth'] = 0;
        $data['post_num'] = $this->board_model->get_max_post_num("sybqna");
        $data['post_regtime'] = date('Y-m-d H:i:s');
        $data['post_content'] = $this->post("post_content", FALSE);
        $data['post_mobile'] = $this->site->viewmode() == DEVICE_MOBILE ? 'Y':'N';
        $data['post_notice'] = "N";
        $data['post_secret'] = "Y";
        $data['usr_id'] = "";
        $data['usr_name'] = $this->post("usr_name", TRUE);
        $data['usr_pass'] = hash('md5', $this->config->item('encryption_key').$this->post('usr_pass', TRUE));
        $data['usr_email'] = $this->post("usr_email", TRUE);
        $data['usr_phone'] = $this->post("usr_phone", TRUE);
        $data['post_modtime'] = date('Y-m-d H:i:s');
        $data['post_comment_cnt'] = 0;
        $data['post_hit'] = 0;
        $data['post_ip'] = ip2long($this->input->ip_address());
        $data['post_tag'] = "";
        $data['post_status'] = "Y";
        for($i=1; $i<=10; $i++)
        {
            $data['post_ext'.$i] = $this->post("post_ext".$i,TRUE);
        }
        $data['post_ext4'] = $this->post("usr_gender", TRUE);

        if( $this->board_model->insert_post($data) )
        {
            $this->return['status'] = TRUE;
        }

        $this->response($this->return, SELF::HTTP_OK);
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

