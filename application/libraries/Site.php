<?php
/**
 * Class Site
 *
 * 사이트 정보를 가지고 있는 객체.
 *
 */
class Site {
    /**
     * @var 현재 접속한 기기 desktop OR mobile
     */
    protected $device;

    /**
     * @var 현재 보기 모드로 설정된 모드 desktop OR mobile
     */
    protected $viewmode;

    /**
     * @var 사이트 전역설정을 저장한다.
     */
    protected $config;

    protected $css_before = array();
    protected $css_after = array();
    protected $js_before = array();
    protected $js_after = array();

    public $meta_title 			= "";
    public $meta_description 	= "";
    public $meta_keywords 		= "";
    public $meta_image			= "";

    /**
     * 사이트 전역설정중 특정 컬럼의 값을 반환한다.
     * @param $column 반활할 컬럼 이름
     * @return var 컬럼의 값
     */
    public function config($column) {

        // 컬럼값이 없으면 리턴한다.
        if( empty($column) ) return NULL;

        // 캐시 드라이버 로드
        $CI =& get_instance();
        $CI->load->driver('cache', array('adapter' => 'apc', 'backup' => 'file'));

        if( ! $config = $CI->cache->get('site_config') )
        {
            $result = $CI->db->get("tbl_config");
            $config_list = $result->result_array();
            $config = array();
            foreach( $config_list as $row ) {
                $config[$row['cfg_key']] = $row['cfg_value'];
            }

            $CI->cache->save('site_config', $config);
        }

        return element($column, $config, NULL);
    }

    public function get_layout()
    {
        return ( $this->viewmode == DEVICE_MOBILE ) ? LAYOUT_MOBILE : LAYOUT_DEKSTOP;
    }

    /**
     * 현재 접속된 기기 정보를 저장
     * @param $device
     */
    public function set_device($device) {
        if( empty($device) OR ($device != DEVICE_DESKTOP && $device != DEVICE_MOBILE))
        {
            $device = DEVICE_DESKTOP;
        }
        $this->device = $device;
    }

    /**
     * 현재 접속된 기기 정보를 리턴
     */
    public function device() {
        return $this->device;
    }

    /**
     * Function set_viewmode
     * 현재 보기모드를 설정
     * @param $viewmode
     */
    public function set_viewmode($viewmode) {
        if( empty($viewmode) OR ($viewmode != DEVICE_DESKTOP && $viewmode != DEVICE_MOBILE) )
        {
            $viewmode = DEVICE_DESKTOP;
        }
        $this->viewmode = $viewmode;
    }

    /**
     * Function viewmode
     * @return 현재설정된 보기 모드를 리턴
     */
    public function viewmode(){
        return $this->viewmode;
    }

    /**
     * 사이트에 사용할 CSS를 추가합니다.
     * @param $url 추가할 CSS
     * @param bool $insert_last 마지막에 추가할지 처음에 추가할지
     */
    public function add_css( $url, $insert_first = FALSE) {
        if(!empty($url) && ! in_array($url, $this->css_after) && !in_array($url, $this->css_before)) {
            if( $insert_first ) {
                array_push($this->css_before, $url);
            }
            else {
                array_push($this->css_after, $url);
            }
        }
    }

    /**
     * 사이트에 사용할 JS를 추가한다.
     * @param $url 추가할 JS
     * @param bool $insert_last 마지막에 추가할것인가?
     */
    public function add_js( $url, $insert_first = FALSE ) {
        if(!empty($url) && ! in_array($url, $this->js_before) && ! in_array($url, $this->js_after)) {
            if( $insert_first ) {
                array_push($this->js_before, $url);
            }
            else {
                array_push($this->js_after, $url);
            }
        }
    }

    /**
     * 배열에 담긴 CSS를 메타태그와 함께 같이 출력한다.
     * @return string
     */
    public function display_css() {
        $return = '';

        $css_array = array_merge($this->css_before, $this->css_after);
        $css_array = array_unique($css_array);

        foreach($css_array as $css) {
            if( is_my_domain( $css ) ) {
                $css .= "?" . date('YmdHis', filemtime( $_SERVER['DOCUMENT_ROOT'] . $css ));
            }
            $return .= '<link rel="stylesheet" type="text/css" href="'.$css.'" />';
        }
        return $return;
    }

    /**
     * 배열에 담긴 JS를 메타태그와 함께 같이 출력한다.
     * @return string
     */
    public function display_js() {
        $return = '';

        $js_array = array_merge($this->js_before, $this->js_after);
        $js_array = array_unique($js_array);

        foreach($js_array as $js) {

            if( is_my_domain( $js ) ) {
                if( ! file_exists( $_SERVER['DOCUMENT_ROOT']. $js ) ) continue;
                $js .= "?" . date('YmdHis', filemtime( $_SERVER['DOCUMENT_ROOT'] . $js ));
            }

            $return .= '<script type="text/javascript" src="'.$js.'"></script>';
        }
        return $return;
    }

    /**
     * 메타태그를 자동으로 생성하여 표시한다.
     */
    public function display_meta(){
        // Default 값 설정
        $this->meta_title = $this->meta_title ? $this->meta_title : $this->config('site_subtitle');
        if( ! empty($this->meta_title) ) $this->meta_title .= ' :: ';
        $this->meta_title .= $this->config('site_title');
        $this->meta_description = $this->meta_description ? $this->meta_description : $this->config('meta_description');
        $this->meta_keywords = $this->meta_keywords ? $this->meta_keywords : "";
        $this->meta_image = $this->meta_image ? $this->meta_image : $this->config('meta_image');

        if( $this->meta_image ) $this->meta_image = base_url($this->meta_image);

        $default_keywords = explode(",", $this->config('meta_keywords'));
        $in_keywords = explode(",", $this->meta_keywords);
        foreach($in_keywords as $keyword) {
            $keyword = trim($keyword);
            if(! in_array($keyword, $default_keywords)) {
                array_push($default_keywords, $keyword);
            }
        }
        $default_keywords = array_unique($default_keywords);

        $this->meta_keywords = "";
        // 합친 키워드를 다시 직렬화
        foreach($default_keywords as $keyword) {
            $this->meta_keywords .= $keyword.",";
        }
        $this->meta_keywords = rtrim($this->meta_keywords,",");
        
        // 기본태그
        $return = "";
        $return .= '<meta charset="utf-8">';
        $return .= '<meta content="yes" name="apple-mobile-web-app-capable" />';
        //$return .=  ($this->viewmode() == DEVICE_DESKTOP) ? '<meta name="viewport" content="width=device-width,initial-scale=auto,user-scalable=yes">' : '<meta name="viewport" content="width=device-width,initial-scale=1">';
        $return .= '<meta name="viewport" content="width=1140,initial-scale=auto,user-scalable=yes">';
        $return .= '<meta http-equiv="X-UA-Compatible" content="IE=edge">';
        $return .= '<meta name="google-site-verification" content="braa6osDc8_MkL5286zzaInxLq_iy-AHIEdDENL8aTA" />';
        // 기본 메타 태그
        $return .= '<title>' . $this->meta_title . '</title>';
        $return .= '<meta name="description" content="'.$this->meta_description.'">';
        $return .= '<meta name="keywords" content="'. $this->meta_keywords.'">';
        $return .= $this->meta_image ? '<link rel="image_src" href="'.$this->meta_image.'">': '';
        // 페이스북 메타 태그
        $return .= '<meta property="og:title" content="'.$this->meta_title.'" />';
        $return .= '<meta property="og:type" content="article" />';
        $return .= '<meta property="og:url" content="'.current_url().'" />';
        $return .= $this->meta_image ? '<meta property="og:image" content="'.$this->meta_image.'" />': '';
        $return .= '<meta property="og:description" content="'.$this->meta_description.'" />';
        $return .= '<meta property="og:site_name" content="'.$this->config('site_title').'" />';
        // 트위터 메타 태그
        $return .= '<meta name="twitter:card" content="summary"/>';
        $return .= '<meta name="twitter:site" content="'.$this->config('site_title').'"/>';
        $return .= '<meta name="twitter:title" content="'.$this->meta_title.'">';
        $return .= '<meta name="twitter:description" content="'.$this->meta_description.'"/>';
        $return .= '<meta name="twitter:creator" content="'.$this->config('site_title').'"/>';
        $return .= $this->meta_image ? '<meta name="twitter:image:src" content="'.$this->meta_image.'"/>' : '';
        $return .= '<meta name="twitter:domain" content="'.base_url().'"/>';
        // 네이트온 메타 태그
        $return .= '<meta name="nate:title" content="'.$this->meta_title.'" />';
        $return .= '<meta name="nate:description" content="'.$this->meta_description.'" />';
        $return .= '<meta name="nate:site_name" content="'.$this->config('site_title').'" />';
        $return .= '<meta name="nate:url" content="'.current_url().'" />';
        $return .= $this->meta_image ? '<meta name="nate:image" content="'.$this->meta_image.'" />' : '';
        $return .= '<link rel="canonical" href="'.current_url().'" />';
        // IE8 미만에서 html5shiv, respond 로드
        $return .= '<!--[if lt IE 9]>';
        $return .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>';
        $return .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>';
        $return .= '<![endif]-->';
        return $return;
    }
}