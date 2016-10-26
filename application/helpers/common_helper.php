<?php
/*****************************************************************************************
 * Alert 창을 띄우고 특정 URL로 이동합니다.
 * @param string $msg
 * @param string $url
 ****************************************************************************************/
function alert($msg = '', $url = '')
{
    if (empty($msg)) {
        $msg = '잘못된 접근입니다';
    }
    echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
    echo '<script type="text/javascript">alert("' . $msg . '");';
    if (empty($url)) {
        echo 'history.go(-1);';
    }
    if ($url) {
        echo 'document.location.href="' . $url . '"';
    }
    echo '</script>';
    exit;
}

/*****************************************************************************************
 * 현재 주소를 Parameter 포함해서 가져온다.
 * @return string
 ****************************************************************************************/
function current_full_url($urlencode = FALSE)
{
    $CI =& get_instance();
    $url = $CI->config->site_url($CI->uri->uri_string());
    $return = ($CI->input->server('QUERY_STRING'))
        ? $url . '?' . $CI->input->server('QUERY_STRING') : $url;
    return $urlencode ?  urlencode($return) : $return;
}

/****************************************************************************************
 * 배열의 특정 키값을 가져옵니다.
 * @param $item
 * @param $array
 * @param null $default
 * @return mixed|null
 ***************************************************************************************/
function element($item, $array, $default = NULL)
{
    return is_array($array) && array_key_exists($item, $array) ? $array[$item] : $default;
}


/****************************************************************************************
 * 글자수를 자릅니다.
 * @param string $str
 * @param string $len
 * @param string $suffix
 * @return string
 ****************************************************************************************/
function cut_str($str = '', $len = '', $suffix = '…')
{
    $arr_str = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);
    $str_len = count($arr_str);

    if ($str_len >= $len) {
        $slice_str = array_slice($arr_str, 0, $len);
        $str = join('', $slice_str);
        return $str . ($str_len > $len ? $suffix : '');
    } else {
        $str = join('', $arr_str);
        return $str;
    }
}


/******************************************************************************************
 * 해당 URL이 우리 서버 도메인을 가르키는지 확인한다.
 * @param $url 체크할 URL
 * @param bool $check_file_exist 파일존재 여부까지 확인한다.
 * @return bool
 *****************************************************************************************/
function is_my_domain($url, $check_file_exist = TRUE) {
    global $_SERVER;

    // 처음 시작이 / 이고 두번제 문자가 /이 아닐경우
    if( substr($url,0,1) === '/' && substr($url,1,1) !== '/' )
    {
        if( $check_file_exist ) {
            return file_exists( $_SERVER['DOCUMENT_ROOT'] . $url );
        }
        return TRUE;
    }

    if( strpos( $url, base_url()) !== FALSE ) {

        if( $check_file_exist ) {
            return file_exists( $_SERVER['DOCUMENT_ROOT'] . str_replace( base_url(), "/", $url ));
        }
        return TRUE;
    }
    return FALSE;
}

/*******************************************************************************************
 *
 * 날짜 표시형식을 변형합니다.
 * @param $date
 *
 ******************************************************************************************/
function board_date_format($date){
    if(! is_numeric($date) ){
        $date = strtotime($date);
    }

    if(date('Y-m-d') == date('Y-m-d', $date))
    {
        return date('H:m', $date);
    }
    else
    {
        return date('Y.m.d', $date);
    }
}


/********************************************************************************************
 * URL주소를 자동으로 링크로 바꿔줍니다.
 * @param string $str
 * @param bool $popup
 * @return bool|mixed|string
 *******************************************************************************************/
function url_auto_link($str = '', $popup = false)
{
    if (empty($str)) {
        return false;
    }
    $target = $popup ? 'target="_blank"' : '';
    $str = str_replace(
        array("&lt;", "&gt;", "&amp;", "&quot;", "&nbsp;", "&#039;"),
        array("\t_lt_\t", "\t_gt_\t", "&", "\"", "\t_nbsp_\t", "'"),
        $str
    );
    $str = preg_replace(
        "/([^(href=\"?'?)|(src=\"?'?)]|\(|^)((http|https|ftp|telnet|news|mms):\/\/[a-zA-Z0-9\.-]+\.[가-힣\xA1-\xFEa-zA-Z0-9\.:&#=_\?\/~\+%@;\-\|\,\(\)]+)/i",
        "\\1<a href=\"\\2\" {$target}>\\2</A>",
        $str
    );
    $str = preg_replace(
        "/(^|[\"'\s(])(www\.[^\"'\s()]+)/i",
        "\\1<a href=\"http://\\2\" {$target}>\\2</A>",
        $str
    );
    $str = preg_replace(
        "/[0-9a-z_-]+@[a-z0-9._-]{4,}/i",
        "<a href=\"mailto:\\0\">\\0</a>",
        $str
    );
    $str = str_replace(
        array("\t_nbsp_\t", "\t_lt_\t", "\t_gt_\t", "'"),
        array("&nbsp;", "&lt;", "&gt;", "&#039;"),
        $str
    );
    return $str;
}


/*******************************************************************************************
 *
 * HTML 형식을 변형하여 읽기좋게 출력합니다.
 * @param $date
 *
 ******************************************************************************************/
function display_html_content($content = '', $html = '', $thumb_width=800, $autolink = false, $popup = false)
{
    if (empty($html)) {
        $content = nl2br(html_escape($content));
        if ($autolink) {
            $content = url_auto_link($content, $popup);
        }
        $content = preg_replace(
            "/\[<a\s*href\=\"(http|https|ftp)\:\/\/([^[:space:]]+)\.(gif|png|jpg|jpeg|bmp).*<\/a>(\s\]|\]|)/i",
            "<img src=\"$1://$2.$3\" alt=\"\" style=\"max-width:100%;border:0;\">",
            $content
        );

        return $content;
    }

    $source = array();
    $target = array();

    $source[] = '//';
    $target[] = '';

    $source[] = "/<\?xml:namespace prefix = o ns = \"urn:schemas-microsoft-com:office:office\" \/>/";
    $target[] = '';

    // 테이블 태그의 갯수를 세어 테이블이 깨지지 않도록 한다.
    $table_begin_count = substr_count(strtolower($content), '<table');
    $table_end_count = substr_count(strtolower($content), '</table');
    for ($i = $table_end_count; $i < $table_begin_count; $i++) {
        $content .= '</table>';
    }

    $content = preg_replace($source, $target, $content);

    if ($autolink) {
        $content = url_auto_link($content, $popup);
    }


    $content = html_purifier($content);
    $content = get_view_thumbnail($content, $thumb_width);

    return $content;
}


/*******************************************************************************************
 * 보안을 위한 HTML처리 (HtmlPurifier)
 * @param $html
 * @return mixed
 ******************************************************************************************/
function html_purifier($html)
{
    $CI = & get_instance();

    $white_iframe = $CI->site->config('white_iframe');;
    $white_iframe = preg_replace("/[\r|\n|\r\n]+/", ",", $white_iframe);
    $white_iframe = preg_replace("/\s+/", "", $white_iframe);
    if ($white_iframe) {
        $white_iframe = explode(',', trim($white_iframe, ','));
        $white_iframe = array_unique($white_iframe);
    }
    $domains = array();
    if ($white_iframe) {
        foreach ($white_iframe as $domain) {
            $domain = trim($domain);
            if ($domain) {
                array_push($domains, $domain);
            }
        }
    }
    // 내 도메인도 추가
    array_push($domains, $CI->input->server('HTTP_HOST') . '/');
    $safeiframe = implode('|', $domains);

    if ( ! defined('INC_HTMLPurifier')) {
        include_once(APPPATH . 'third_party/htmlpurifier/HTMLPurifier.standalone.php');
        define('INC_HTMLPurifier', true);
    }

    $config = HTMLPurifier_Config::createDefault();
    // cache 디렉토리에 CSS, HTML, URI 디렉토리 등을 만든다.

    $cache_path = config_item('cache_path') ? config_item('cache_path') : APPPATH . 'cache/';

    $config->set('Cache.SerializerPath', $cache_path);
    $config->set('HTML.SafeEmbed', false);
    $config->set('HTML.SafeObject', false);
    $config->set('HTML.SafeIframe', true);
    $config->set('URI.SafeIframeRegexp','%^(https?:)?//(' . $safeiframe . ')%');
    $config->set('Attr.AllowedFrameTargets', array('_blank'));
    $config->set('Core.Encoding', 'utf-8');
    $config->set('Core.EscapeNonASCIICharacters', true);
    $config->set('HTML.MaxImgLength', null);
    $config->set('CSS.MaxImgLength', null);
    $purifier = new HTMLPurifier($config);

    return $purifier->purify($html);
}

/***************************************************************************************
 * 게시글 보기에서 썸네일을 한개 가져온다.
 * @param string $contents
 * @param int $thumb_width
 * @return bool|mixed|string
 **************************************************************************************/
function get_view_thumbnail($contents = '', $thumb_width= 0)
{
    if (empty($contents)) {
        return false;
    }

    $CI = & get_instance();

    if (empty($thumb_width)) {
        $thumb_width = 700;
    }

    // $contents 중 img 태그 추출
    $matches = get_editor_image($contents, TRUE);

    if (empty($matches)) {
        return $contents;
    }

    $end = count(element(1, $matches));
    for ($i = 0; $i < $end; $i++) {

        $img = $matches[1][$i];
        preg_match("/src=[\'\"]?([^>\'\"]+[^>\'\"]+)/i", $img, $m);
        $src = isset($m[1]) ? $m[1] : '';
        preg_match("/style=[\"\']?([^\"\'>]+)/i", $img, $m);
        $style = isset($m[1]) ? $m[1] : '';
        preg_match("/width:\s*(\d+)px/", $style, $m);
        $width = isset($m[1]) ? $m[1] : '';
        preg_match("/height:\s*(\d+)px/", $style, $m);
        $height = isset($m[1]) ? $m[1] : '';
        preg_match("/alt=[\"\']?([^\"\']*)[\"\']?/", $img, $m);
        $alt = isset($m[1]) ? html_escape($m[1]) : '';
        if (empty($width)) {
            preg_match("/width=[\"\']?([^\"\']*)[\"\']?/", $img, $m);
            $width = isset($m[1]) ? html_escape($m[1]) : '';
        }
        if (empty($height)) {
            preg_match("/height=[\"\']?([^\"\']*)[\"\']?/", $img, $m);
            $height = isset($m[1]) ? html_escape($m[1]) : '';
        }

        // 이미지 path 구함
        $p = parse_url($src);
        if (isset($p['host']) && $p['host'] === $CI->input->server('HTTP_HOST')
            && strpos($p['path'], '/files/editor/') !== false) {
            $thumb_tag = '<img src="' . thumb_url('editor', str_replace(base_url('/files/editor') . '/', '', $src), $thumb_width) . '" ';
        } else {
            $thumb_tag = '<img src="' . $src . '" ';
        }
        if ($width) {
            $thumb_tag .= ' width="' . $width . '" ';
        }
        $thumb_tag .= 'alt="' . $alt . '" style="max-width:100%;"/>';

        $img_tag = $matches[0][$i];
        $contents = str_replace($img_tag, $thumb_tag, $contents);
        if ($width) {
            $thumb_tag .= ' width="' . $width . '" ';
        }
        $thumb_tag .= 'alt="' . $alt . '" style="max-width:100%;"/>';

        $img_tag = $matches[0][$i];
        $contents = str_replace($img_tag, $thumb_tag, $contents);
    }

    return $contents;
}


/***************************************************************************************
 * 본문내용중에 <img>태그를 가져온다.
 * @param string $contents
 * @param bool $view
 * @return bool
 **************************************************************************************/
function get_editor_image($contents = '', $view = true)
{
    if (empty($contents)) {
        return false;
    }

    // $contents 중 img 태그 추출
    if ($view) {
        $pattern = "/<img([^>]*)>/iS";
    } else {
        $pattern = "/<img[^>]*src=[\'\"]?([^>\'\"]+[^>\'\"]+)[\'\"]?[^>]*>/i";
    }
    preg_match_all($pattern, $contents, $matchs);

    return $matchs;
}