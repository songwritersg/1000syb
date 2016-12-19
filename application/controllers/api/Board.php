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