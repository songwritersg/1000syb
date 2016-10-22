<?php

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