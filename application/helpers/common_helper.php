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

function alert_close($msg='')
{
    if (empty($msg)) {
        $msg = '잘못된 접근입니다';
    }
    echo '<meta http-equiv="content-type" content="text/html; charset=utf-8">';
    echo '<script type="text/javascript">alert("' . $msg . '");';
    echo 'window.close();';
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
    return is_array($array) && array_key_exists($item, $array) &&  $array[$item] ? $array[$item] : $default;
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
        return date('H:i', $date);
    }
    else
    {
        return date('Y.m.d', $date);
    }
}

function make_dir($dir = "")
{
    $dirs = explode("/", $dir);
    $now_dir = FCPATH;
    foreach($dirs as $dr)
    {
        $now_dir .= "/" . $dr;
        if (is_dir($now_dir) === false) {
            $old = umask(0);
            mkdir($now_dir, 0777);
            umask($old);
        }
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

function get_yoil( $date, $short = TRUE )
{
    $yoil_array = array("일","월","화","수","목","금","토");

    if(! is_numeric($date) )
    {
        $date = strtotime($date);
    }

    $w = date('w', $date);
    $return = $yoil_array[$w];

    return ($short) ? $return : $return ."요일";
}

/*******************************************************************************************
 * 파일이 실제로 존재하는지 체크한다.
 * @param $file_src
 * @return bool
 ******************************************************************************************/
function file_check( $file_src )
{
    if( empty($file_src) ) return FALSE;

    $file_src = FCPATH . $file_src;
    return file_exists($file_src);
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

/*****************************************************************************
 * 해당 게시물의 대표 이미지를 가져온다.
 * @param $post_idx
 ****************************************************************************/
function get_post_image($contents = '', $thumb_width = '', $thumb_height = '')
{

    $CI = & get_instance();

    if (empty($contents)) {
        return;
    }

    $matches = get_editor_image($contents);
    if (empty($matches)) {
        return;
    }


    $img = element(0, element(1, $matches));
    if (empty($img)) {
        return;
    }

    preg_match("/src=[\'\"]?([^>\'\"]+[^>\'\"]+)/i", $img, $m);
    $src = isset($m[1]) ? $m[1] : '';

    $p = parse_url($src);
    if (isset($p['host']) && strpos($p['host'], "1000syb.com") !== FALSE) {
        $src = str_replace(FCPATH, "", thumbnail($p['path'], $thumb_width, $thumb_height ));
    }

    return $src;
}


function thumbnail($filename = '', $thumb_width = 0, $thumb_height = 0, $is_create = false, $is_crop = true, $crop_mode = 'center', $is_sharpen = false, $um_value = '80/0.5/3', $create_animate_thumb = false)
{
    $source_file = $filename;
    $source_file = FCPATH . $source_file;
    if (is_file($source_file) === false) { // 원본 파일이 없다면
        return;
    }

    if (empty($thumb_width) && empty($thumb_height)) {
        return $source_file;
    }

    $size = @getimagesize($source_file);
    if ($size[2] < 1 OR $size[2] > 3) { // gif, jpg, png 에 대해서만 적용
        return;
    }

    $uploadDir = FCPATH . '/files/cache/';
    if (is_dir($uploadDir) === false) {
        @mkdir($uploadDir, 0755);
        @chmod($uploadDir, 0755);
        $file = $uploadDir . 'index.php';
        $f = @fopen($file, 'w');
        @fwrite($f, '');
        @fclose($f);
        @chmod($file, 0644);
    }
    $exp = explode('/', $filename);
    $filepos = count($exp) - 1;
    for ($k = 0; $k < $filepos; $k++) {
        $uploadDir .= $exp[$k] . '/';
        if (is_dir($uploadDir) === false) {
            @mkdir($uploadDir, 0755);
            @chmod($uploadDir, 0755);
            $file = $uploadDir . 'index.php';
            $f = @fopen($file, 'w');
            @fwrite($f, '');
            @fclose($f);
            @chmod($file, 0644);
        }
    }

    $realfilename = $exp[$filepos];

    $target_path = $uploadDir;

    // 디렉토리가 존재하지 않거나 쓰기 권한이 없으면 썸네일 생성하지 않음
    if ( ! (is_dir($target_path) && is_writable($target_path))) {
        return '';
    }

    // Animated GIF는 썸네일 생성하지 않음
    if ($size[2] === 1) {
        if (is_animated_gif ($source_file) && $create_animate_thumb === false) {
            return $source_file;
        }
    }

    $ext = array(1 => 'gif', 2 => 'jpg', 3 => 'png');
    $thumb_filename = preg_replace("/\.[^\.]+$/i", '', $realfilename); // 확장자제거
    $thumb_file = $target_path . 'thumb-' . $thumb_filename . '_' . $thumb_width . 'x' . $thumb_height . '.' . $ext[$size[2]];

    $thumb_time = @filemtime($thumb_file);
    $source_time = @filemtime($source_file);

    if (file_exists($thumb_file)) {
        if ($is_create === false && $source_time < $thumb_time) {
            return $thumb_file;
        }
    }

    // 원본파일의 GD 이미지 생성
    $src = null;
    $degree = 0;

    if ($size[2] === 1) {
        $src = imagecreatefromgif ($source_file);
        $src_transparency = imagecolortransparent($src);
    } elseif ($size[2] === 2) {
        $src = imagecreatefromjpeg($source_file);

        if (function_exists('exif_read_data')) {
            // exif 정보를 기준으로 회전각도 구함
            $exif = @exif_read_data($source_file);
            if ( ! empty($exif['Orientation'])) {
                switch ($exif['Orientation']) {
                    case 8:
                        $degree = 90;
                        break;
                    case 3:
                        $degree = 180;
                        break;
                    case 6:
                        $degree = -90;
                        break;
                }

                // 회전각도 있으면 이미지 회전
                if ($degree) {
                    $src = imagerotate($src, $degree, 0);

                    // 세로사진의 경우 가로, 세로 값 바꿈
                    if ($degree === 90 || $degree === -90) {
                        $tmp = $size;
                        $size[0] = $tmp[1];
                        $size[1] = $tmp[0];
                    }
                }
            }
        }
    } elseif ($size[2] === 3) {
        $src = imagecreatefrompng($source_file);
        imagealphablending($src, true);
    } else {
        return;
    }

    if (empty($src)) {
        return;
    }

    $is_large = true;
    $keep_origin = false;
    // width, height 설정
    if ($thumb_width) {
        if (empty($thumb_height)) {
            $thumb_height = round(($thumb_width * $size[1]) / $size[0]);
            if ($thumb_width > $size[0]) {
                $keep_origin = true;
            }
        } else {
            if ($size[0] < $thumb_width || $size[1] < $thumb_height) {
                $is_large = false;
            }
        }
    } else {
        if ($thumb_height) {
            $thumb_width = round(($thumb_height * $size[0]) / $size[1]);
        }
    }

    $dst_x = 0;
    $dst_y = 0;
    $src_x = 0;
    $src_y = 0;
    $src_w = $size[0];
    $src_h = $size[1];
    $dst_w = $keep_origin ? $src_w : $thumb_width;
    $dst_h = $keep_origin ? $src_h : $thumb_height;

    $ratio = $dst_h / $dst_w;

    if ($is_large) {
        // 크롭처리
        if ($is_crop) {
            switch ($crop_mode) {
                case 'center':
                    if ($size[1] / $size[0] >= $ratio) {
                        $src_h = round($src_w * $ratio);
                        $src_y = round(($size[1] - $src_h) / 2);
                    } else {
                        $src_w = round($size[1] / $ratio);
                        $src_x = round(($size[0] - $src_w) / 2);
                    }
                    break;
                default:
                    if ($size[1] / $size[0] >= $ratio) {
                        $src_h = round($src_w * $ratio);
                    } else {
                        $src_w = round($size[1] / $ratio);
                    }
                    break;
            }
        }

        $dst = imagecreatetruecolor($dst_w, $dst_h);

        if ($size[2] === 3) {
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        } elseif ($size[2] === 1) {
            $palletsize = imagecolorstotal($src);
            if ($src_transparency >= 0 && $src_transparency < $palletsize) {
                $transparent_color = imagecolorsforindex($src, $src_transparency);
                $current_transparent = imagecolorallocate($dst, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagefill($dst, 0, 0, $current_transparent);
                imagecolortransparent($dst, $current_transparent);
            }
        }
    } else {
        $dst = imagecreatetruecolor($dst_w, $dst_h);
        $bgcolor = imagecolorallocate($dst, 255, 255, 255); // 배경색

        if ($src_w < $dst_w) {
            if ($src_h >= $dst_h) {
                $dst_x = round(($dst_w - $src_w) / 2);
                $src_h = $dst_h;
            } else {
                $dst_x = round(($dst_w - $src_w) / 2);
                $dst_y = round(($dst_h - $src_h) / 2);
                $dst_w = $src_w;
                $dst_h = $src_h;
            }
        } else {
            if ($src_h < $dst_h) {
                $dst_y = round(($dst_h - $src_h) / 2);
                $dst_h = $src_h;
                $src_w = $dst_w;
            }
        }

        if ($size[2] === 3) {
            $bgcolor = imagecolorallocatealpha($dst, 0, 0, 0, 127);
            imagefill($dst, 0, 0, $bgcolor);
            imagealphablending($dst, false);
            imagesavealpha($dst, true);
        } elseif ($size[2] === 1) {
            $palletsize = imagecolorstotal($src);
            if ($src_transparency >= 0 && $src_transparency < $palletsize) {
                $transparent_color = imagecolorsforindex($src, $src_transparency);
                $current_transparent = imagecolorallocate($dst, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']);
                imagefill($dst, 0, 0, $current_transparent);
                imagecolortransparent($dst, $current_transparent);
            } else {
                imagefill($dst, 0, 0, $bgcolor);
            }
        } else {
            imagefill($dst, 0, 0, $bgcolor);
        }
    }

    imagecopyresampled($dst, $src, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);

    // sharpen 적용
    if ($is_sharpen && $is_large) {
        $val = explode('/', $um_value);
        UnsharpMask($dst, $val[0], $val[1], $val[2]);
    }

    if ($size[2] === 1) {
        imagegif ($dst, $thumb_file);
    } elseif ($size[2] === 3) {
        $png_compress = 5;
        imagepng($dst, $thumb_file, $png_compress);
    } else {
        $jpg_quality = 90;
        imagejpeg($dst, $thumb_file, $jpg_quality);
    }

    chmod($thumb_file, 0644); // 추후 삭제를 위하여 파일모드 변경

    imagedestroy($src);
    imagedestroy($dst);

    return $thumb_file;
}


function UnsharpMask($img, $amount, $radius, $threshold)
{
    // $img is an image that is already created within php using
    // imgcreatetruecolor. No url! $img must be a truecolor image.

    // Attempt to calibrate the parameters to Photoshop:
    if ($amount > 500) {
        $amount = 500;
    }
    $amount = $amount * 0.016;
    if ($radius > 50) {
        $radius = 50;
    }
    $radius = $radius * 2;
    if ($threshold > 255) {
        $threshold = 255;
    }

    $radius = abs(round($radius)); // Only integers make sense.
    if ($radius === 0) {
        return $img; imagedestroy($img);
    }
    $w = imagesx($img); $h = imagesy($img);
    $imgCanvas = imagecreatetruecolor($w, $h);
    $imgBlur = imagecreatetruecolor($w, $h);

    if (function_exists('imageconvolution')) { // PHP >= 5.1
        $matrix = array(
            array( 1, 2, 1 ),
            array( 2, 4, 2 ),
            array( 1, 2, 1 ),
        );
        $divisor = array_sum(array_map('array_sum', $matrix));
        $offset = 0;

        imagecopy ($imgBlur, $img, 0, 0, 0, 0, $w, $h);
        imageconvolution($imgBlur, $matrix, $divisor, $offset);
    } else {

        // Move copies of the image around one pixel at the time and merge them with weight
        // according to the matrix. The same matrix is simply repeated for higher radii.
        for ($i = 0; $i < $radius; $i++) {
            imagecopy ($imgBlur, $img, 0, 0, 1, 0, $w - 1, $h); // left
            imagecopymerge ($imgBlur, $img, 1, 0, 0, 0, $w, $h, 50); // right
            imagecopymerge ($imgBlur, $img, 0, 0, 0, 0, $w, $h, 50); // center
            imagecopy ($imgCanvas, $imgBlur, 0, 0, 0, 0, $w, $h);

            imagecopymerge ($imgBlur, $imgCanvas, 0, 0, 0, 1, $w, $h - 1, 33.33333 ); // up
            imagecopymerge ($imgBlur, $imgCanvas, 0, 1, 0, 0, $w, $h, 25); // down
        }
    }

    if ($threshold> 0) {
        // Calculate the difference between the blurred pixels and the original
        // and set the pixels
        for ($x = 0; $x < $w-1; $x++) { // each row
            for ($y = 0; $y < $h; $y++) { // each pixel

                $rgbOrig = ImageColorAt($img, $x, $y);
                $rOrig = (($rgbOrig >> 16) & 0xFF);
                $gOrig = (($rgbOrig >> 8) & 0xFF);
                $bOrig = ($rgbOrig & 0xFF);

                $rgbBlur = ImageColorAt($imgBlur, $x, $y);

                $rBlur = (($rgbBlur >> 16) & 0xFF);
                $gBlur = (($rgbBlur >> 8) & 0xFF);
                $bBlur = ($rgbBlur & 0xFF);

                // When the masked pixels differ less from the original
                // than the threshold specifies, they are set to their original value.
                $rNew = (abs($rOrig - $rBlur) >= $threshold)
                    ? max(0, min(255, ($amount * ($rOrig - $rBlur)) + $rOrig))
                    : $rOrig;
                $gNew = (abs($gOrig - $gBlur) >= $threshold)
                    ? max(0, min(255, ($amount * ($gOrig - $gBlur)) + $gOrig))
                    : $gOrig;
                $bNew = (abs($bOrig - $bBlur) >= $threshold)
                    ? max(0, min(255, ($amount * ($bOrig - $bBlur)) + $bOrig))
                    : $bOrig;



                if (($rOrig !== $rNew) || ($gOrig !== $gNew) || ($bOrig !== $bNew)) {
                    $pixCol = ImageColorAllocate($img, $rNew, $gNew, $bNew);
                    ImageSetPixel($img, $x, $y, $pixCol);
                }
            }
        }
    } else {
        for ($x = 0; $x < $w; $x++) { // each row
            for ($y = 0; $y < $h; $y++) { // each pixel
                $rgbOrig = ImageColorAt($img, $x, $y);
                $rOrig = (($rgbOrig >> 16) & 0xFF);
                $gOrig = (($rgbOrig >> 8) & 0xFF);
                $bOrig = ($rgbOrig & 0xFF);

                $rgbBlur = ImageColorAt($imgBlur, $x, $y);

                $rBlur = (($rgbBlur >> 16) & 0xFF);
                $gBlur = (($rgbBlur >> 8) & 0xFF);
                $bBlur = ($rgbBlur & 0xFF);

                $rNew = ($amount * ($rOrig - $rBlur)) + $rOrig;
                if ($rNew > 255) {
                    $rNew= 255;
                } elseif ($rNew < 0) {
                    $rNew= 0;
                }
                $gNew = ($amount * ($gOrig - $gBlur)) + $gOrig;
                if ($gNew > 255) {
                    $gNew= 255;
                } elseif ($gNew < 0) {
                    $gNew= 0;
                }
                $bNew = ($amount * ($bOrig - $bBlur)) + $bOrig;
                if ($bNew>255) {
                    $bNew= 255;
                } elseif ($bNew < 0) {
                    $bNew= 0;
                }
                $rgbNew = ($rNew << 16) + ($gNew <<8) + $bNew;
                ImageSetPixel($img, $x, $y, $rgbNew);
            }
        }
    }
    imagedestroy($imgCanvas);
    imagedestroy($imgBlur);

    return true;
}

function is_animated_gif ($filename)
{
    if ( ! ($fh = @fopen($filename, 'rb'))) {
        return false;
    }
    $count = 0;

    // We read through the file til we reach the end of the file, or we've found
    // at least 2 frame headers
    while ( ! feof($fh) && $count < 2) {
        $chunk = fread($fh, 1024 * 100); //read 100kb at a time
        $count += preg_match_all(
            '#\x00\x21\xF9\x04.{4}\x00(\x2C|\x21)#s',
            $chunk,
            $matches
        );
    }

    fclose($fh);
    return $count > 1;
}

function ajax_error($message, $status=400)
{
    $CI =& get_instance();
    $CI->output
        ->set_status_header($status)
        ->set_content_type('application/json')
        ->set_output(json_encode(["status"=>FALSE, "message"=>$message], JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES))
        ->_display();
    exit;
}

