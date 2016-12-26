<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
/**************************************************************
 * 게시판용 REST API
 *
 * @author Jang seongeun <jang@tjsrms.me>
 * @date 2016.11.07
 **************************************************************/
class Board extends REST_Controller {

    function comments_post()
    {
        $cmt_idx = $this->post('cmt_idx', TRUE);
        $comment_user = trim($this->post('comment_user', TRUE));
        $comment_content = trim($this->post('comment_content', TRUE));
        $comment_password = $this->post('comment_password', TRUE);

        if(empty($cmt_idx)) $this->response(["status"=>FALSE, "message"=>"잘못된 접근입니다."],400);
        if(empty($comment_user)) $this->response(["status"=>FALSE, "message"=>"작성자 이름을 합니다."],400);
        if(empty($comment_password)) $this->response(["status"=>FALSE, "message"=>"비밀번호를 입력하셔야 합니다."],400);
        if(empty($comment_content)) $this->response(["status"=>FALSE, "message"=>"댓글 내용을 입력하셔야 합니다."],400);

        $this->db->where('cmt_idx', $cmt_idx);
        $this->db->where('cmt_status', "Y");
        if(! $result = $this->db->get('tbl_board_comment') )
        {
            $this->response(["status"=>FALSE, "message"=>"잘못된 접근입니다."],500);
        }
        if(! $comment = $result->row_array() )
        {
            $this->response(["status"=>FALSE, "message"=>"존재하지 않는 댓글이거나, 이미 삭제된 댓글입니다."],400);
        }

        if( $comment['usr_pass'] != hash('md5', $this->config->item('encryption_key').$comment_password ) )
        {
            $this->response(["status"=>FALSE, "message"=>"비밀번호가 맞지 않습니다."],400);
        }

        $this->db->where('cmt_idx', $cmt_idx);
        $this->db->set('cmt_status', 'Y');
        if( $comment['usr_name']  != $comment_user) $this->db->set('usr_name' , $comment_user);
        if( $comment['cmt_content'] != $comment_content ) $this->db->set('cmt_content', $comment_content);
        if( $this->db->update('tbl_board_comment') ) {
            $this->response(["status"=>TRUE, "message"=>"SUCCESS"],200);
        }
        else {
            $this->response(["status"=>FALSE, "message"=>"DB저장도중 오류가 발생하였습니다."],500);
        }
    }

    function comments_delete()
    {
        $cmt_idx = $this->delete('cmt_idx', TRUE);
        $comment_password = $this->delete('comment_password', TRUE);
        
        if(empty($cmt_idx)) $this->response(["status"=>FALSE, "message"=>"잘못된 접근입니다."],400);
        if(empty($comment_password)) $this->response(["status"=>FALSE, "message"=>"비밀번호를 입력하셔야 합니다."],400);

        // 댓글을 가져옴
        $this->db->where('cmt_idx', $cmt_idx);
        $this->db->where('cmt_status', "Y");
        if(! $result = $this->db->get('tbl_board_comment') )
        {
            $this->response(["status"=>FALSE, "message"=>"잘못된 접근입니다."],500);
        }
        if(! $comment = $result->row_array() )
        {
            $this->response(["status"=>FALSE, "message"=>"존재하지 않는 댓글이거나, 이미 삭제된 댓글입니다."],400);
        }

        if( $comment['usr_pass'] != hash('md5', $this->config->item('encryption_key').$comment_password ) )
        {
            $this->response(["status"=>FALSE, "message"=>"비밀번호가 맞지 않습니다."],400);
        }

        $this->db->where('cmt_idx', $cmt_idx);
        $this->db->set('cmt_status', 'N');
        if( $this->db->update('tbl_board_comment') ) {
            $this->response(["status"=>TRUE, "message"=>"SUCCESS"],200);
        }
        else {
            $this->response(["status"=>FALSE, "message"=>"DB저장도중 오류가 발생하였습니다."],500);
        }


    }
    
    function trstory_best_post()
    {
        $this->load->library('upload');
        $array = array("best_one_desc_1", "best_one_desc_2", "best_two_desc_1", "best_two_desc_2", "best_one_link","best_two_link");

        foreach($array as $item)
        {
            $this->db->where("brd_key", "trstory");
            $this->db->where("ext_key", $item);
            $this->db->set("ext_value", $this->post($item, TRUE));
            $this->db->update("tbl_board_extra");

            $this->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        }

        for($i=1; $i<=2; $i++)
        {
            if (isset($_FILES)
                && isset($_FILES['userfile_'.$i])
                && isset($_FILES['userfile_'.$i]['name']) ) {

                $upload_url = "files/board/trstory1/";
                make_dir($upload_url);
                $upload_path = FCPATH . $upload_url;

                $uploadconfig = array(
                    'upload_path' => $upload_path,
                    'allowed_types' => 'jpg|jpeg|png|gif',
                    'max_size' => 15 * 1024,
                    'encrypt_name' => true,
                );
                $this->upload->initialize($uploadconfig);
                if ($this->upload->do_upload('userfile_'.$i)) {
                    $filedata = $this->upload->data();

                    $this->db->where("brd_key", "trstory");
                    $this->db->where("ext_key", $i==1?'best_one_thumb':'best_two_thumb');
                    $this->db->set('ext_value', $upload_url . element('file_name', $filedata));
                    $this->db->update("tbl_board_extra");


                }
            }
        }

        $this->cache->delete("board_info_trstory");
    }
}