<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Board
 *
 * 게시판 컨트롤러
 */
class Board extends SYB_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model('board_model');
    }

    /**********************************************************
     *
     * 게시판 목록보기
     *
     * Author : 장선근 <jang@tjsrms.me>
     * Design : 최건우
     * Date : 20161022
     *********************************************************/
    function lists( $brd_key = "" )
    {
        if(! $this->data['board'] = $this->board_model->get_board($brd_key))
        {
            alert('존재하지 않는 게시판입니다.');
            exit;
        }

        // 게시판 권한 가져오기
        $this->data['auth'] = $this->board_model->get_auth($brd_key);

        // 글 읽기권한 확인
        if( ! $this->data['auth']['list'] )
        {
            alert('해당 게시판에 접근할 권한이 없습니다.');
            exit;
        }

        // 게시판 목록 가져오기
        $this->data['page'] = $param['page'] = $this->input->get("page", TRUE, 1);
        $param['page_rows'] = DEVICE_MOBILE ? (int)$this->data['board']['brd_page_rows_mobile'] : (int)$this->data['board']['brd_page_rows'];
        $param['brd_key'] = $brd_key;
        $post_list = $this->board_model->get_list($param);
        $this->data['list'] = $post_list['list'];
        $this->data['total_count'] = $post_list['total_count'];
        $this->data['notice'] = $post_list['notice'];
        unset($post_list);

        // Meta Tag 설정
        $this->site->meta_title = "{$this->data['board']['brd_title']} {$this->data['page']}페이지";

        // Device에 따른 스킨 설정
        $this->site->add_js("/static/js/board.js");
        $skin = $this->site->viewmode() == DEVICE_MOBILE ? $this->data['board']['brd_skin_mobile'] : $this->data['board']['brd_skin'];
        $this->layout = $this->site->get_layout();
        $this->view = "board/{$skin}/lists";
    }

    /**********************************************************
     *
     * 게시판 암호 확인 페이지
     * @param string $brd_key
     * @param string $post_idx
     *
     *********************************************************/
    function password($brd_key="",$post_idx="")
    {
        $this->output->enable_profiler(TRUE);
        if(! $this->data['board'] = $this->board_model->get_board($brd_key))
        {
            alert('존재하지 않는 게시판입니다.');
            exit;
        }

        $this->data['reurl'] = $this->input->get('reurl', TRUE);

        // 폼검증 라이브러리 로드
        $this->load->library("form_validation");
        // 폼검증 규칙 설정
        $this->form_validation->set_rules("password", "비밀번호","trim|required|min_length[4]|max_length[16]");

        if( $this->form_validation->run() == FALSE )
        {
            $skin = $this->site->viewmode() == DEVICE_MOBILE ? $this->data['board']['brd_skin_mobile'] : $this->data['board']['brd_skin'];
            $this->layout = $this->site->get_layout();
            $this->view = "board/{$skin}/password";
        }
        else
        {
            $reurl = $this->input->post("reurl", TRUE, base_url("board/{$brd_key}/{$post_idx}") );
            $password = $this->input->post("password", TRUE);

            $post = $this->board_model->get_post($post_idx);

            if( hash('md5', $this->config->item('encryption_key') . $password) == $post['usr_pass'] )
            {
                $this->session->set_userdata('post_password_'.$post_idx, TRUE);
                redirect($reurl);
                exit;
            }
            else
            {
                alert('비밀번호가 맞지 않습니다.'.$password);
                exit;
            }
        }
    }

    /**********************************************************
     *
     * 게시판 글 내용보기
     * @param string $brd_key
     * @param string $post_idx
     *
     *********************************************************/
    function view( $brd_key="", $post_idx="")
    {
        if(! $this->data['board'] = $this->board_model->get_board($brd_key))
        {
            alert('존재하지 않는 게시판입니다.');
            exit;
        }

        // 게시판 권한 가져오기
        $this->data['auth'] = $this->board_model->get_auth($brd_key);

        // 글 내용 가져오기
        if( ! $this->data['post'] = $this->board_model->get_post($post_idx))
        {
            alert('존재하지 않는 글이거나, 이미 삭제된 글입니다.');
            exit;
        }

        // 권한을 확인한다.
        if( ! $this->data['auth']['view'] )
        {
            // 로그인 여부를 확인한다.
            if( $this->member->is_login() )
            {

            }
            else
            {
                // 비회원일 경우
                // 비밀번호 확인 세션이 있는지 확인한다.
                if( ! $this->session->userdata('post_password_'.$post_idx) )
                {
                    redirect("board/{$brd_key}/password/{$post_idx}?reurl=".current_full_url(TRUE));
                }
            }
        }

        //if( ! $this->data['auth']['view'] && $this->data[''])

        // 조회수를 증가시킨다.
        $this->board_model->update_post_hit($post_idx);

        // Device에 따른 스킨 설정
        $skin = $this->site->viewmode() == DEVICE_MOBILE ? $this->data['board']['brd_skin_mobile'] : $this->data['board']['brd_skin'];
        $this->layout = $this->site->get_layout();
        $this->view = "board/{$skin}/view";
    }
}
