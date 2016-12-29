<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class Board
 *
 * 게시판 컨트롤러
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2016-10-27
 *************************************************************************************/
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

        $this->data['stxt'] = $param['stxt'] = $this->input->get("stxt", TRUE);
        $this->data['scol'] = $param['scol'] = $this->input->get("scol", TRUE);
        $this->data['category'] = $param['category'] = $this->input->get("category", TRUE);

        // 게시판 목록 가져오기
        $this->data['page'] = $param['page'] = $this->input->get("page", TRUE, 1);
        $param['page_rows'] = DEVICE_MOBILE ? (int)$this->data['board']['brd_page_rows_mobile'] : (int)$this->data['board']['brd_page_rows'];
        $param['brd_key'] = $brd_key;
        $post_list = $this->board_model->get_list($param);
        $this->data['list'] = $post_list['list'];
        $this->data['total_count'] = $post_list['total_count'];
        $this->data['notice'] = $post_list['notice'];
        unset($post_list);

        // 함께넘겨줄 쿼리스트링 데이타를 정리한다.
        $qs = array();
        if( $this->data['stxt'] && $this->data['scol'] ) {
            $qs['stxt'] =$this->data['stxt'];
            $qs['scol'] =$this->data['scol'];
        }
        if( $this->data['category'] ) {
            $qs['category'] = $this->data['category'];
        }

        // 게시판 페이지네이션 생성하기
        $paging_config['page'] = $param['page'];
        $paging_config['page_rows'] = $param['page_rows'];
        $paging_config['total_rows'] = $this->data['total_count'];
        $paging_config['base_url'] = base_url("board/{$brd_key}");
        $paging_config['add_param'] = "&". http_build_query($qs);
        $this->load->library("paging", $paging_config);
        $this->data['pagination'] = $this->paging->create();

        // Meta Tag 설정
        $this->site->meta_title = "{$this->data['board']['brd_title']} {$this->data['page']}페이지";

        $qs['page'] = $param['page'];
        $this->data['querystring'] = "?".http_build_query($qs);

        // Device에 따른 스킨 설정
        $this->site->add_js("/static/js/board.min.js");
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
            $this->site->add_js("/static/js/board.min.js");
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
                alert('비밀번호가 맞지 않습니다.');
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

        // 질문과 답변게시판은 지사일경우 자신의 카테고리에 관한한 subadmin 권한 획득
        if( $brd_key == 'sybqna' && $this->member->level() == 7 && $this->member->info('ath_name') == $this->data['post']['post_category'] )
        {
            $this->data['auth']['is_subadmin'] = TRUE;
        }

        if( ! $this->data['post']['post_idx'] ){
            alert('존재하지 않는 글이거나, 이미 삭제된 글입니다.');
            exit;
        }

        // 글 보기 권한을 확인한다.
        if( ! $this->data['auth']['view'] )
        {
            // 로그인 여부를 확인한다.
            if( $this->member->is_login() )
            {
                if(!$this->data['auth']['is_admin'] && !$this->data['auth']['is_subadmin'] && $this->member->info('usr_id') != $this->data['post']['usr_id']) {
                    alert('해당 글을 열람할 권한이 없습니다.');
                    exit;
                }
            }
            else
            {
                // 비회원일 경우
                // 비밀번호 확인 세션이 있는지 확인한다.
                if( ! $this->session->userdata('post_password_'.$post_idx) )
                {
                    redirect("board/{$brd_key}/password/{$post_idx}?reurl=".current_full_url(TRUE));
                    exit;
                }
            }
        }

        // 비밀글일 경우 열람권한을 확인한다.
        if( $this->data['post']['post_secret'] == 'Y' )
        {
            // 로그인 여부를 확인한다.
            if( $this->member->is_login() )
            {
                if(!$this->data['auth']['is_admin'] && !$this->data['auth']['is_subadmin'] && $this->member->info('usr_id') != $this->data['post']['usr_id']) {
                    alert('비밀글을 열람할 권한이 없습니다.'.$this->member->info('ath_name'));
                    exit;
                }
            }
            else
            {
                // 비회원일 경우
                // 비밀번호 확인 세션이 있는지 확인한다.
                if( ! $this->session->userdata('post_password_'.$post_idx) )
                {
                    redirect("board/{$brd_key}/password/{$post_idx}?reurl=".current_full_url(TRUE));
                    exit;
                }
            }
        }

        // 넘어온 패러미터를 정리한다.
        $qs = array();
        if( $this->input->get('page', TRUE) ) {
            $qs['page'] = $this->input->get("page", TRUE);
        }
        if( $this->input->get('scol', TRUE) && $this->input->get('stxt', TRUE) ) {
            $qs['scol'] = $this->input->get("scol", TRUE);
            $qs['stxt'] = $this->input->get("stxt", TRUE);
        }
        if( $this->input->get('category', TRUE)) {
            $qs['category'] = $this->input->get("category", TRUE);
        }
        $this->data['querystring'] = "?".http_build_query($qs);

        // 게시판의 이전글, 다음글 가져오기
        $this->data['post_np'] = $this->board_model->get_np($brd_key, $this->data['post']['post_idx'], $this->data['post']['post_num'], $this->data['post']['post_depth']);

        // 댓글 목록 가져오기
        $this->data['comment_list'] = $this->board_model->get_comment_list($brd_key, $post_idx);

        // 조회수를 증가시킨다.
        $this->board_model->update_post_hit($post_idx);

        // 메타태그 설정
        $this->site->meta_title = $this->data['post']['post_title'];
        $this->site->meta_keywords = $this->data['post']['post_tag'];
        $this->site->meta_description = trim(preg_replace('/\s\s+/', ' ', cut_str(strip_tags($this->data['post']['post_content']),300)));

        // Device에 따른 스킨 설정
        $this->site->add_js("/static/js/board.min.js");
        $skin = $this->site->viewmode() == DEVICE_MOBILE ? $this->data['board']['brd_skin_mobile'] : $this->data['board']['brd_skin'];
        $this->layout = $this->site->get_layout();
        $this->view = "board/{$skin}/view";
    }

    /**********************************************************
     * 첨부파일 다운로드
     ********************************************************/
    function download( $brd_key="", $bfi_idx="" )
    {
        if(empty($brd_key) OR empty($bfi_idx))
        {
            alert("잘못된 접근입니다.");
            exit;
        }

        if(! $this->data['board'] = $this->board_model->get_board($brd_key))
        {
            alert('존재하지 않는 게시판입니다.');
            exit;
        }

        if(! $attach = $this->board_model->get_attach($bfi_idx) )
        {
            alert('잘못된 접근입니다.');
            exit;
        }

        if( $this->member->level() < $this->data['board']['brd_lv_download'] )
        {
            alert('해당 파일을 다운로드할 수 있는 권한이 없습니다.');
            exit;
        }

        $this->load->helper('download');
        $data = file_get_contents(FCPATH.$attach['bfi_filename']);
        force_download($attach['bfi_originname'], $data);
        exit;
    }

    /*********************************************************************************************
     *
     * 실제 글쓰기를 수행하는 동작
     *
     *******************************************************************************************/
    function _write_process($brd_key, $is_reply)
    {
        $this->load->library("form_validation");

        $this->form_validation->set_rules("post_key", "post_key", "trim|required");

        if( $this->form_validation->run() == FALSE )
        {
            $this->site->add_js("/static/js/board.min.js");
            $skin = $this->site->viewmode() == DEVICE_MOBILE ? $this->data['board']['brd_skin_mobile'] : $this->data['board']['brd_skin'];
            $this->layout = $this->site->get_layout();
            $this->view = "board/{$skin}/" . ($is_reply ? "reply" : "write");
        }
        else
        {
            $data['post_idx'] = $this->input->post("post_idx", TRUE, NULL);
            $data['brd_key'] = $brd_key;
            $data['post_category'] = trim($this->input->post("post_category", TRUE, ""));
            $data['post_title'] = trim($this->input->post("post_title", TRUE, ""));
            $data['post_content'] = $this->input->post("post_content", FALSE);

            $data['post_mobile'] = $this->site->viewmode() == DEVICE_MOBILE ? 'Y':'N';
            $data['post_notice'] = $this->input->post("post_notice", TRUE) == 'Y' ? 'Y' : 'N';
            $data['post_secret'] = $this->input->post("post_secret", TRUE) == 'Y' ? 'Y' : 'N';

            $data['usr_id'] = $this->member->info('usr_id');
            $data['usr_name'] = ($this->member->is_login()) ? $this->member->info('usr_name') : $this->input->post("usr_name", TRUE);

            $usr_pass = $this->input->post("usr_pass", TRUE);

            $data['usr_email'] = trim($this->input->post("usr_email", TRUE, ''));
            $data['usr_phone'] = trim($this->input->post("usr_phone", TRUE, ''));
            $data['post_modtime'] = date('Y-m-d H:i:s');
            $data['post_ip'] = ip2long( $this->input->ip_address() );
            $data['post_tag'] = trim($this->input->post("post_tag", TRUE, ''));


            for($i=1; $i<=10; $i++){
                $data['post_ext'.$i] = trim($this->input->post("post_ext".$i, TRUE, ''));
            }

            if( empty($data['post_idx']) )
            {
                // 신규입력일 경우 추가 필요값 정의
                $data['post_depth'] = 0;
                $data['post_num'] = $this->board_model->get_max_post_num($brd_key);
                $data['post_regtime'] = date('Y-m-d H:i:s');
            }

            if( empty($data['post_title']) )
            {
                alert('글 제목을 입력하셔야 합니다.');
                exit;
            }

            if( empty($data['post_content']))
            {
                alert('글 내용을 입력하셔야 합니다.');
                exit;
            }

            // 로그인이 안되어 있을경우 비밀번호 값 필수
            if( ! $this->member->is_login() )
            {
                if(empty($data['usr_name']))
                {
                    alert('비회원 글 작성시에는 작성자를 입력하셔야 합니다.');
                    exit;
                }

                if(empty($usr_pass))
                {
                    alert('비회원 글 작성시에는 비밀번호를 입력하셔야 합니다.');
                    exit;
                }

                // 비회원으로 등록된 글을 수정할때 비밀번호 체크
                if($data['post_idx'] && !$is_reply)
                {
                    // 기존 값을 가져온다.
                    $original = $this->board_model->get_post($data['post_idx']);
                    if( $original['usr_pass'] != hash('md5', $this->config->item('encryption_key'). $usr_pass) )
                    {
                        alert('기존에 입력된 비밀번호와 다릅니다.');
                        exit;
                    }
                }
                else
                {
                    $data['usr_pass'] = hash('md5', $this->config->item('encryption_key'). $usr_pass);
                }
            }
            else
            {
                // 로그인상태일경우 비밀번호는 회원 비밀번호
                $data['usr_pass'] = $this->member->info('usr_pass');
            }


            // 답글일때 처리
            if ( $is_reply )
            {
                // 원글 정보를 가져온다.
                $parent = $this->board_model->get_post( $data['post_idx'] );

                if(empty($parent))
                {
                    alert('원글의 정보를 찾을 수 없습니다.');
                    exit;
                }

                $data['post_num'] = $parent['post_num'];
                $data['post_depth'] = $this->board_model->get_max_post_depth($brd_key, $data['post_num']);
                $data['usr_pass'] = $parent['usr_pass'];
                $data['post_regtime'] = date('Y-m-d H:i:s');
                unset($data['post_idx']);
            }

            // 등록된 파일이 있을경우 처리한다.
            if( isset($_FILES) && isset($_FILES['userfile']) && count($_FILES['userfile']) > 0 )
            {
                $dir_path = "files/board/{$brd_key}1";
                make_dir($dir_path);
                $upload_config['upload_path'] = FCPATH.$dir_path;
                $upload_config['file_ext_tolower'] = TRUE;
                $upload_config['allowed_types'] = "*";
                $upload_config['encrypt_name'] = TRUE;

                $this->load->library("upload", $upload_config);
                $upload_array = array();

                // for문으로 업로드하기위해 돌리기
                $files = NULL;
                foreach ($_FILES['userfile'] as $key => $value) {
                    foreach ($value as $noKey => $noValue) {
                        $files[$noKey][$key] = $noValue;
                    }
                }
                unset($_FILES);
                foreach ($files as $file) {
                    $_FILES['userfile'] = $file;
                    $this->upload->initialize($upload_config);

                    if( ! isset($_FILES['userfile']['tmp_name']) OR ! $_FILES['userfile']['tmp_name']) continue;

                    if (! $this->upload->do_upload('userfile') )
                    {
                        alert('파일 업로드에 실패하였습니다.\\n'.$this->upload->display_errors(' ',' '));
                        exit;
                    }
                    else
                    {
                        $filedata = $this->upload->data();
                        $upload_array[] = array(
                            "brd_key" => $brd_key,
                            "bfi_originname" => $filedata['orig_name'],
                            "bfi_filename" => $dir_path . "/" . $filedata['file_name'],
                            "bfi_caption" => $filedata['orig_name'],
                            "bfi_download" => 0,
                            "bfi_filesize" => $filedata['file_size'] * 1024,
                            "bfi_width" => $filedata['image_width'] ? $filedata['image_width'] : 0,
                            "bfi_height" => $filedata['image_height'] ? $filedata['image_height'] : 0,
                            "bfi_type" => $filedata['file_ext'],
                            "bfi_is_image" => ($filedata['is_image'] == 1) ? 'Y' : 'N',
                            "bfi_datetime" => date('Y-m-d H:i:s')
                        );
                    }
                }
            }

            // 첨부파일삭제가 있을경우 삭제한다.
            $del_file = $this->input->post("del_file", TRUE);
            if( $del_file && count($del_file) > 0 )
            {
                foreach($del_file as $bfi_idx) {
                    $this->board_model->attach_remove($bfi_idx);
                }
            }

            $msg = "";

            // 신규 등록일 경우
            if( empty($data['post_idx']) OR $is_reply )
            {
                // 신규작성이며 만약 게시판 설정에 승인기능이 사용일경우 기본적으로 승인값이 N으로 들어가게 저장한다.
                if( ! $is_reply && $this->data['board']['brd_use_assign'] == 'Y' && $data['post_notice'] == 'N' )
                {
                    $data['post_assign'] = "N";
                }

                $data['post_idx'] = $this->board_model->insert_post($data);
                $msg = "신규 게시글을 등록하였습니다.";
            }
            // 업데이트일경우
            else
            {
                $this->board_model->update_post($data);
                $msg = "글 수정이 완료되었습니다.";
            }

            // 업로드된 데이타가 있을경우에 DB에 기록
            if(isset($upload_array) && count($upload_array) >0 )
            {
                foreach($upload_array as &$arr) $arr['post_idx'] = $data['post_idx'];
                $this->db->insert_batch("tbl_board_file", $upload_array);
            }

            $this->board_model->attach_count($data['post_idx']);

            // 최근 게시물 Cache 삭제
            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));
            $this->cache->delete('board_recent_'.$brd_key);

            // 자기게시물의 비번은 자동등록
            $this->session->set_userdata('post_password_'.$data['post_idx'], TRUE);

            alert($msg, base_url("board/{$brd_key}/{$data['post_idx']}"));
            exit;
        }
    }

    /********************************************************************************************
     * @param string $brd_key
     * @param string $post_idx
     ********************************************************************************************/
    function reply($brd_key="", $post_idx="")
    {
        if(! $this->data['board'] = $this->board_model->get_board($brd_key))
        {
            alert('존재하지 않는 게시판입니다.');
            exit;
        }

        $this->data['auth'] = $this->board_model->get_auth($brd_key);
        $this->data['original'] = ($post_idx) ? $this->board_model->get_post($post_idx) : array();  // 원글

        if( ! $this->data['original'] )
        {
            alert('해당 원글은 존재하지 않거나, 이미 삭제된 글입니다.');
            exit;
        }

        // 권한 확인
        if( $this->member->is_login() )
        {
            // 로그인 되어있다면 작성자가 같은지 확인
            if( ! $this->data['auth']['reply'] )
            {
                alert('해당글을 수정할 권한이 없습니다.');
                exit;
            }
        }
        else
        {
            if( ! $this->session->userdata('post_password_'.$post_idx) )
            {
                redirect("board/{$brd_key}/password/{$post_idx}?reurl=".current_full_url(TRUE));
                exit;
            }
        }

        $this->_write_process($brd_key, TRUE);
    }

    /*********************************************************
     * 글작성/수정
     * @param string $brd_key
     * @param string $post_idx
     ********************************************************/
    function write($brd_key="", $post_idx="")
    {
        if(! $this->data['board'] = $this->board_model->get_board($brd_key))
        {
            alert('존재하지 않는 게시판입니다.');
            exit;
        }

        // 게시판 권한 가져오기
        $this->data['auth'] = $this->board_model->get_auth($brd_key);
        $this->data['post'] = ($post_idx) ? $this->board_model->get_post($post_idx) : array();

        if( $post_idx && ! $this->data['post'] )
        {
            alert('존재하지 않는 글이거나, 이미 삭제된 글입니다.');
            exit;
        }

        if( ! empty($post_idx) )
        {

            if( $this->member->is_login() )
            {
                // 로그인 되어있다면 작성자가 같은지 확인
                if( $this->member->info('usr_id') != $this->data['post']['usr_id'] )
                {
                    alert('해당글을 수정할 권한이 없습니다.');
                    exit;
                }
            }
            else
            {
                if( $this->data['post']['usr_id'] )
                {
                    alert('해당글을 수정하기 위해선 로그인이 필요합니다.');
                    exit;
                }
                else
                {
                    if( ! $this->session->userdata('post_password_'.$post_idx) )
                    {
                        redirect("board/{$brd_key}/password/{$post_idx}?reurl=".current_full_url(TRUE));
                        exit;
                    }
                }
            }
        }

        if(! $this->data['auth']['write'])
        {
            alert('해당 게시판에 글을 쓸수 있는 권한이 없습니다.');
            exit;
        }

        $this->_write_process($brd_key, FALSE);

    }

    /**************************************************************************************************
     * 코멘트 작성
     * @param string $brd_key
     **************************************************************************************************/
    function comment($brd_key="")
    {
        if(empty($brd_key))
        {
            alert('잘못된 접근입니다.');
            exit;
        }

        if(! $this->data['board'] = $this->board_model->get_board($brd_key))
        {
            alert('존재하지 않는 게시판입니다.');
            exit;
        }

        $post_idx = $this->input->post("post_idx", TRUE);
        if( ! $this->data['post'] = $this->board_model->get_post($post_idx))
        {
            alert('존재하지 않는 글이거나, 이미 삭제된 글입니다.');
            exit;
        }

        $this->data['auth'] = $this->board_model->get_auth($brd_key);
        if( ! $this->data['auth']['is_admin'] && ! $this->data['auth']['is_subadmin']) {
            if( ! $this->data['auth']['comment'] ) {
                alert('해당 글의 댓글을 작성할 권한이 없습니다.');
                exit;
            }
        }

        $data['cmt_content'] = trim($this->input->post("cmt_content", TRUE));
        $data['brd_key'] = $brd_key;
        $data['post_idx'] = $post_idx;
        $data['cmt_regtime'] = date('Y-m-d H:i:s');
        $data['cmt_modtime'] = date('Y-m-d H:i:s');
        $data['cmt_ip'] = ip2long($this->input->ip_address());
        $data['usr_name'] = trim($this->input->post("usr_name", TRUE));

        if(empty($data['cmt_content']))
        {
            alert('댓글 내용을 작성해야 합니다.');
            exit;
        }

        if( $this->member->is_login() )
        {
            $data['usr_id'] = $this->member->info('usr_id');
            $data['usr_name'] = $this->member->info('usr_name');
        }
        else
        {
            $data['usr_pass'] = $this->input->post("usr_pass", TRUE);

            if(empty($data['usr_pass']))
            {
                alert('비회원 댓글작성일 경우 비밀번호를 입력하셔야 합니다.');
                exit;
            }
            $data['usr_pass'] = hash('md5', $this->config->item('encryption_key').$data['usr_pass']);
        }

        $this->db->insert("tbl_board_comment", $data);

        alert("댓글 작성이 완료되었습니다.", $this->input->post("reurl", TRUE, base_url("board/{$brd_key}/{$post_idx}")));
        exit;
    }

    /*********************************************************
     * 게시글 삭제
     ********************************************************/
    function delete($brd_key="", $post_idx="")
    {
        if(empty($brd_key) OR empty($post_idx))
        {
            alert('잘못된 접근입니다.');
            exit;
        }

        if(! $this->data['board'] = $this->board_model->get_board($brd_key))
        {
            alert('존재하지 않는 게시판입니다.');
            exit;
        }

        if( ! $this->data['post'] = $this->board_model->get_post($post_idx))
        {
            alert('존재하지 않는 글이거나, 이미 삭제된 글입니다.');
            exit;
        }

        $this->data['auth'] = $this->board_model->get_auth($brd_key);

        if( ! $this->data['auth']['is_admin'] && ! $this->data['auth']['is_subadmin'])
        {
            // 권한 확인
            if( $this->member->is_login() )
            {
                // 로그인 되어있다면 작성자가 같은지 확인
                if( $this->member->info('usr_id') != $this->data['post']['usr_id'] )
                {
                    alert('해당글을 삭제할 권한이 없습니다.');
                    exit;
                }
            }
            else
            {
                if( $this->data['post']['usr_id'] )
                {
                    alert('해당글을 삭제하기 위해선 로그인이 필요합니다.');
                    exit;
                }
                else
                {
                    if( ! $this->session->userdata('post_password_'.$post_idx) )
                    {
                        redirect("board/{$brd_key}/password/{$post_idx}?reurl=".current_full_url(TRUE));
                        exit;
                    }
                }
            }
        }


        // 글 삭제 실행
        $this->board_model->post_delete( $post_idx );

        alert('해당 글이 삭제되었습니다.', base_url("board/{$brd_key}"));
        exit;
    }

    function comment_delete()
    {
        $cmt_idx = $this->input->get('cmt_idx', TRUE);
        if(empty($cmt_idx)) {
            exit();
        }
        $this->load->view('popup/board/comment_delete',array('cmt_idx'=>$cmt_idx));
        $this->layout = FALSE;
        $this->view = FALSE;
    }

    function comment_edit()
    {
        $cmt_idx = $this->input->get('cmt_idx', TRUE);
        if(empty($cmt_idx)) {
            exit();
        }

        $result = $this->db->where('cmt_idx', $cmt_idx)->where('cmt_status','Y')->get('tbl_board_comment');
        if(! $comment = $result->row_array())
        {
            ajax_error("존재하지 않는 댓글이거나, 이미 삭제된 댓글입니다.", 400);
            exit;
        }

        $this->load->view('popup/board/comment_edit',array('cmt_idx'=>$cmt_idx, 'comment'=>$comment));
        $this->layout = FALSE;
        $this->view = FALSE;
    }
}
