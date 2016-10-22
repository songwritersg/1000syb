<?php
/*************************************************************
 *
 * alert();
 * -----------------------------------------------------------
 *
 * Javscript Alert 창을 띄우고 지정한 URL로 이동합니다.
 *
 ************************************************************/
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

/**
 * 해당 URL이 우리 서버 도메인을 가르키는지 확인한다.
 * @param $url 체크할 URL
 * @param bool $check_file_exist 파일존재 여부까지 확인한다.
 * @return bool
 */
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