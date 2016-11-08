<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class Requests
 *
 * 메인페이지 컨트롤러
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2016.10.01
 *************************************************************************************/
class Counseling extends SYB_Controller {

    public function form($form_type)
    {
        if(empty($form_type) OR ! in_array($form_type, array('call', 'visit'))) {
            alert('잘못된 접근입니다.');
            exit;
        }

        $this->load->library("form_validation");

        $this->form_validation->set_rules("cns_status", "cns_status", "required|trim");

        if( $this->form_validation->run() == FALSE )
        {
            $this->data['board']['brd_key'] = $form_type;
            $this->data['board']['brd_title'] = $form_type == 'call' ? '전화상담신청' : '방문상담신청';
            $this->view = "counseling/{$form_type}";
            $this->layout = "desktop";
        }
        else
        {
            $gender = $this->input->post("cns_gender", TRUE, "bride");

            $data['cns_status'] = $this->input->post("cns_status", TRUE);
            $data['cns_const_name'] = $this->input->post("cns_const_name", TRUE);
            $data["cns_{$gender}_name"] = $this->input->post("cns_name", TRUE);
            $data["cns_{$gender}_email"] = $this->input->post("cns_email", TRUE);
            $data["cns_{$gender}_phone"] = $this->input->post("cns_phone", TRUE);
            $data['cns_call_t1'] = '직접입력';
            $data['cns_call_t2'] = $this->input->post("cns_call_t2", TRUE);
            $data['cns_memo'] = $this->input->post("cns_memo", TRUE);
            $data['cns_regtime'] = date('Y-m-d H:i:s');
            $data['cns_modtime'] = date('Y-m-d H:i:s');

            $extend_data = "";

            if( $this->input->post("visit_date", TRUE) )
            {
                $extend_data .= "상담신청일 : ".$this->input->post("visit_date", TRUE) .PHP_EOL;
            }

            if( $this->input->post("travel_start", TRUE) && $this->input->post("travel_end", TRUE))
            {
                $extend_data .= "여행기간 : " . $this->input->post("travel_start", TRUE)."~".$this->input->post("travel_end", TRUE).PHP_EOL;
            }

            if( $this->input->post("travel_expect") )
            {
                $extend_data .= "희망지역 : ".$this->input->post("travel_expect", TRUE).PHP_EOL;
            }

            if( !empty($extend_data)) {
                $data['cns_memo'] = $extend_data .PHP_EOL .PHP_EOL . $data['cns_memo'];
            }

            if( $this->db->insert("tbl_consulting", $data) ) {
                alert("신청이 완료되었습니다.", base_url());
                exit;
            }
            else
            {
                alert("신청도중 오류가 발생하였습니다.\\n관리자에게 문의하세요");
                exit;
            }
        }
    }
}
