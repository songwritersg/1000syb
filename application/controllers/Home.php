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
	    $this->view = "home/index";
        $this->layout = "desktop";
	}
}
