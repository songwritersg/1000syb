<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class Members
 *
 * 회원 관련 컨트롤러
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2016.10.27
 *************************************************************************************/
class Members extends SYB_Controller {

    /*************************************************************************************
     * 사용자 로그인
     *************************************************************************************/
    public function login()
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("login_id","사용자 아이디","trim|required");
        $this->form_validation->set_rules("login_pass","사용자 비밀번호","trim|required");

        if( $this->form_validation->run() == FALSE )
        {
            $this->site->meta_title = "사용자 로그인";
            $this->view = "members/login";
            $this->layout = $this->site->get_layout();
        }
        else
        {
            $login_id = trim($this->input->post("login_id", TRUE));
            $login_pass = trim($this->input->post("login_pass", TRUE));

            if(empty($login_id) OR empty($login_pass)) {
                alert('존재하지 않는 ID 또는 잘못된 비밀번호 입니다.');
                exit;
            }

            $this->load->model('user_model');

            if( ! $member = $this->user_model->get_by_id($login_id) )
            {
                alert('존재하지 않는 ID 또는 잘못된 비밀번호 입니다.');
                exit;
            }

            if( $member['usr_pass'] != hash('md5', $this->config->item('encryption_key'). $login_pass) )
            {
                alert('존재하지 않는 ID 또는 잘못된 비밀번호 입니다.');
                exit;
            }

            if( $member['usr_status']  != 'Y')
            {
                alert('탈퇴한 ID이거나 접근이 금지된 ID입니다.');
                exit;
            }

            $this->session->set_userdata('ss_u_id', $login_id);
            redirect(base_url());
            exit;
        }
    }

    /*************************************************************************************
     * 사용자 로그아웃
     *************************************************************************************/
    function logout()
    {
        $reurl = $this->input->get("reurl", TRUE, base_url());
        $this->session->sess_destroy();
        redirect($reurl);
        exit;
    }
}
