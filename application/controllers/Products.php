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
            alert('현재 상품에 등록된 일정표가 없습니다.');
            exit;
        }

        // 같은 지역의 카테고리 목록
        $this->data['category'] = $this->product_model->get_category($sca_parent);
        // 같은 카테고리의 상품들
        $this->data['product_list'] = $this->product_model->get_list($sca_key);

        // 상품문의하기 게시판 카테고리를 가져온다.
        $this->data['qna_category'] = $this->board_model->get_category("sybqna");

        $this->site->meta_title = $this->data['product']['prd_title'];
        $this->site->meta_description = $this->data['product']['prd_info_desc'];
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


        $this->site->meta_title = $this->data['category']['sca_info_subtitle'];
        $this->site->meta_description = $this->data['category']['sca_info_description'];
        $this->site->meta_keywords = $this->data['category']['sca_name'] . ",";

        foreach($this->data['category']['children'] as $child)
        {
            $this->site->meta_keywords .= $child['sca_name'] . ",";
        }

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

    function gallery_all($sca_parent="", $sca_key="", $prd_idx="")
    {
        if(empty($prd_idx))
        {
            alert_close("잘못된 접근입니다.");
            exit;
        }

        // 상품정보를 가져온다.
        $this->data['product'] = $this->product_model->get_product($prd_idx);

        // 갤러리 목록을 가져옵니다.
        $this->data['gallery_list'] = $this->product_model->get_gallery_all($prd_idx);

        $this->site->meta_title = $this->data['product']['prd_title'] . " 갤러리";
        $this->layout = "popup";
        $this->view = "products/gallery";
    }

    function print_program($sca_parent, $sca_key, $prd_idx = "", $prg_idx="")
    {
        $this->data['sca_parent'] = $sca_parent;
        $this->data['sca_key'] = $sca_key;

        if(empty($prd_idx))
        {
            alert_close('잘못된 접근입니다.');
            exit;
        }

        $this->data['product'] = $this->product_model->get_product($prd_idx);

        if( empty($this->data['product']) )
        {
            alert_close('잘못된 접근입니다.');
            exit;
        }

        // 일정표 정보를 가져온다.
        $this->data['prg_idx'] = $prg_idx;
        if(empty($this->data['prg_idx']))
        {
            alert_close('잘못된 접근입니다.');
            exit;
        }

        $this->data['program_info'] = $this->product_model->get_program($this->data['prg_idx']);
        if(! $this->data['program_info'] )
        {
            alert('현재 상품에 등록된 일정표가 없습니다.');
            exit;
        }

        // 같은 지역의 카테고리 목록
        $this->data['category'] = $this->product_model->get_category($sca_parent);
        // 같은 카테고리의 상품들
        $this->data['product_list'] = $this->product_model->get_list($sca_key);

        // 상품문의하기 게시판 카테고리를 가져온다.
        $this->data['qna_category'] = $this->board_model->get_category("sybqna");

        $this->site->meta_title = $this->data['product']['prd_title'] ." - " . $this->data['program_info']['prg_title'];
        $this->site->meta_description = $this->data['product']['prd_info_desc'];
        $this->site->meta_keywords = "{$this->data['product']['ctr_name_kr']},{$this->data['product']['cty_name_kr']}";
        $this->active = $sca_parent;
        $this->layout = 'popup';
        $this->view = "products/program_print";
    }

    /*******************************************************************************************
     *
     * 월별 허니문 추천 지역
     *
     *******************************************************************************************/
    function recommend()
    {
        $this->site->meta_title = "월별 베스트 허니문 지역";
        $this->site->meta_description = "1월~12월 허니문 어디로 가는것이 좋을까? 동유럽부터 ~ 칸쿤까지 지금 확인하세요! 전문가 추천! 월별 베스트 허니문 지역";
        
        $this->layout = $this->site->get_layout();
        $this->view = "products/recommend";
    }

    function mail_preview()
    {
        $data['mail_subject'] = "이메일 템플릿";
        $data['sales_comment'] = "";
        $this->load->view("mail/program",$data);
    }

    /*******************************************************************************************
     *
     * 메일 보내기
     *
     *******************************************************************************************/
    function mailform()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("mail_subject", "메일 제목", "required|trim");
        $this->form_validation->set_rules("mail_sender", "보내는 이", "required|trim");
        $this->form_validation->set_rules("mail_receiver", "받는 이", "required|trim");

        if( $this->form_validation->run() == FALSE )
        {
            $this->data['sca_parent'] = $this->input->get("sca_parent");
            $this->data['sca_key'] = $this->input->get("sca_parent");
            $this->data['prd_idx'] = $this->input->get("prd_idx");
            $this->data['prg_idx'] = $this->input->get("prg_idx");

            if(empty($this->data['prd_idx']))
            {
                alert_close('잘못된 접근입니다.');
                exit;
            }

            $this->data['product'] = $this->product_model->get_product($this->data['prd_idx']);

            if( empty($this->data['product']) )
            {
                alert('잘못된 접근입니다.');
                exit;
            }

            // 일정표 정보를 가져온다.
            $this->data['program_info'] = $this->product_model->get_program($this->data['prg_idx']);
            if(! $this->data['program_info'] )
            {
                alert('잘못된 접근입니다.');
                exit;
            }

            $this->site->meta_title = "메일 보내기";
            $this->layout = "popup";
            $this->view = "products/mailform";
        }
        else
        {
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/sbin/sendmail';
            $config['wordwrap'] = TRUE;
            $config['crlf'] = "\r\n";
            $config['newline'] = "\r\n";
            $config['mailtype'] = 'html';
            $this->load->library('email');
            $this->email->initialize($config);

            $mail_data['sca_parent'] = $this->input->post("sca_parent");
            $mail_data['sca_key'] = $this->input->post("sca_parent");
            $mail_data['prd_idx'] = $this->input->post("prd_idx");
            $mail_data['prg_idx'] = $this->input->post("prg_idx");

            $mail_data['product'] = $this->product_model->get_product($mail_data['prd_idx']);
            $mail_data['program_info'] = $this->product_model->get_program($mail_data['prg_idx']);
            $mail_data['schedule_info'] = json_decode($this->input->post("content"), TRUE);

            $mail_data['prd_title'] = $this->input->post('prd_title', TRUE);
            $mail_data['prg_title'] = $this->input->post('prg_title', TRUE);

            $mail_data['sales_comment'] = $this->input->post("sales_comment", TRUE);
            $mail_data['mail_subject'] = $this->input->post("mail_subject");
            $mail_content = $this->load->view("mail/program",$mail_data,TRUE);

            $attach_list = $this->input->post("attach_list");
            $attach_name = $this->input->post("attach_name");

            $this->email->from("no-reply@1000syb.com",'천생연분닷컴');
            $this->email->to( $this->input->post('mail_receiver') );
            $this->email->reply_to($this->input->post('mail_sender'));
            $this->email->subject($this->input->post("mail_subject"));
            $this->email->set_mailtype("html");
            $this->email->message($mail_content);

            for($i=0; $i<count($attach_list); $i++)
            {
                $this->email->attach($attach_list[$i],'attachment',$attach_name[$i]);
            }

            //$this->load->view('mail/program', $mail_data);

            if( $this->email->send() )
            {
                // 메일로그를 저장
                $data['smg_sender'] = $this->input->post('mail_sender');
                $data['smg_receive'] = $this->input->post('mail_receiver');
                $data['smg_title'] = $this->input->post("mail_subject");
                $data['smg_prd_title'] = $mail_data['prd_title'];
                $data['smg_prg_title'] = $mail_data['prg_title'];
                $data['smg_attaches'] = json_encode($attach_name, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
                $data['smg_content'] = $mail_content;
                $data['smg_regtime'] = date('Y-m-d H:i:s');
                $data['smg_ip'] = ip2long($this->input->ip_address());

                $this->db->insert('tbl_site_maillog', $data);

                alert_close("메일 전송이 완료되었습니다.");
                exit;
            }
            else
            {
                foreach($attach_list as $file)
                {
                    //@unlink($file);
                }
                alert('메일전송에 실패하였습니다.');
                exit;
            }
        }
    }
}
