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

        // 게시판 목록 가져오기
        $param['page'] = $this->input->get("page", TRUE, 1);
        $param['page_rows'] = DEVICE_MOBILE ? (int)$this->data['board']['brd_skin_list_mobile'] : (int)$this->data['board']['brd_skin_list'];
        $this->data['list'] = $this->board_model->get_list($param);

        // Device에 따른 스킨 설정
        $skin = $this->site->viewmode() == DEVICE_MOBILE ? $this->data['board']['brd_skin_list_mobile'] : $this->data['board']['brd_skin_list'];

        $this->layout = $this->site->get_layout();
        $this->view = "board/{$skin}/lists";
    }
}
