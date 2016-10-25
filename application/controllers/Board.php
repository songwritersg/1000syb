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
        $skin = $this->site->viewmode() == DEVICE_MOBILE ? $this->data['board']['brd_skin_list_mobile'] : $this->data['board']['brd_skin_list'];
        $this->layout = $this->site->get_layout();
        $this->view = "board/{$skin}/lists";
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

        //if( ! $this->data['auth']['view'] && $this->data[''])

        // 조회수를 증가시킨다.
        $this->board_model->update_post_hit($post_idx);

        // Device에 따른 스킨 설정
        $skin = $this->site->viewmode() == DEVICE_MOBILE ? $this->data['board']['brd_skin_view_mobile'] : $this->data['board']['brd_skin_view'];
        $this->layout = $this->site->get_layout();
        $this->view = "board/{$skin}/view";
    }
}
