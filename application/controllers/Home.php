<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class Home
 * 
 * 메인페이지 컨트롤러
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2016.10.01
 *************************************************************************************/
class Home extends SYB_Controller {

	public function index()
	{
	    $this->data['main_slide_banners'] = $this->banner->lists("MAIN_SLIDE");
        $this->data['main_middle_banners'] = $this->banner->lists("MAIN_MIDDLE");
        $this->data['main_best_banners'] = $this->banner->lists("MAIN_BEST");

	    $this->view = "home/index";
        $this->layout = "desktop";
	}
}
