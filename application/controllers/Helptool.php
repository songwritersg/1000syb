<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Helptool
 *
 * 기타 페이지 컨트롤러
 */
class Helptool extends SYB_Controller {

    function page_404() {
        $this->output->set_status_header('404');
        $data['yield'] = $this->load->view($this->site->get_layout()."/helptool/page_404", NULL, TRUE);
        $this->load->view($this->site->get_layout()."/layout", $data);
    }
}
