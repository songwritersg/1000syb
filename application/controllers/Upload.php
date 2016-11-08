<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class Upload
 *
 * 업로드 관련 컨트롤러
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2016.11.07
 *************************************************************************************/
class Upload extends SYB_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
    }

    function tinymce()
    {
        $this->layout	= FALSE;
        $this->view		= FALSE;

        $upload_url = "files/editor/".date('Y')."/".date('m')."/";
        make_dir($upload_url);

        $upload_path = "./".$upload_url;

        if (isset($_FILES)
            && isset($_FILES['file'])
            && isset($_FILES['file']['name'])) {

            $uploadconfig = array(
                'upload_path' => $upload_path,
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size' => 15 * 1024,
                'encrypt_name' => true,
            );

            $this->upload->initialize($uploadconfig);

            if ($this->upload->do_upload('file')) {

                $filedata = $this->upload->data();

                if( element('is_image', $filedata) == 1 &&  element('image_width', $filedata) > 1000)
                {
                    $imgconfig['image_library'] = 'gd2';
                    $imgconfig['source_image'] = element('full_path', $filedata);
                    $imgconfig['maintain_ratio'] = TRUE;
                    $imgconfig['width']         = 1000;
                    $this->load->library('image_lib', $imgconfig);
                    $this->image_lib->resize();
                }

                $image_url = "http://img.1000syb.com/".ltrim($upload_url . element('file_name', $filedata), "/");
                exit($image_url);

            } else {
                exit("!" . $this->upload->display_errors(' ',' ') );
            }

        }
    }
}