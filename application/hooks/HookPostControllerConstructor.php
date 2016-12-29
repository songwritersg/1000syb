<?php
/**
 *
 * HookPostControllerConstructor.php
 *
 * 컨트롤러가 인스턴스화 된 직후 가동되는 후킹 클래스.
 *
 */
class HookPostControllerConstructor {

    protected $CI;

    /************************************************
     *
     * 후킹 초기 실행 지점
     *
     ***********************************************/
    function init() {
        // 인스턴스화 된 컨트롤러를 불러와 참조시킨다.
        $this->CI =& get_instance();

        // 천생연분 Config 파일 불러오기
        require_once APPPATH . "/config/sybconfig.php";

        // 사이트 정보 클래스 로드
        $this->CI->load->library("site");
        // User Agent Library
        $this->CI->load->library("user_agent");

        $this->deny_ips();
        $this->setup_device_view();
    }

    function deny_ips()
    {
        ini_set('display_errors',1);
        if( $this->CI->site->config('deny_ip') )
        {
            $blacklist =  preg_split('/\r\n|\r|\n/', $this->CI->site->config('deny_ip'));
            $blacklist = array_map("trim", $blacklist);
            if( in_array( $this->CI->input->ip_address(), $blacklist) )
            {
                exit("access denied");
            }
        }
    }

    /************************************************
     *
     * 현재 접속한 기기정보와, 보기 모드 설정들을 정의한다.
     *
     ***********************************************/
    function setup_device_view()
    {


        // 모바일 접속여부에 따라 device 정보 확인
        $device = $viewmode = $this->CI->agent->is_mobile() ? DEVICE_MOBILE : DEVICE_DESKTOP;
        
        // 해당 모드로 보기 쿠키가 존재한다면 해당 보기 모드로
        if( get_cookie( COOKIE_VIEWMODE )  && ( get_cookie( COOKIE_VIEWMODE ) == DEVICE_DESKTOP OR get_cookie( COOKIE_VIEWMODE ) == DEVICE_MOBILE) )
        {
            $viewmode = get_cookie(COOKIE_VIEWMODE);
        }

        // 사이트 정보에 저장
        $this->CI->site->set_device($device);
        $this->CI->site->set_viewmode($viewmode);
    }
}