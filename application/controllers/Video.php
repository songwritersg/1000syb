<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**************************************************************************************
 *
 * Class Video
 *
 * Vimeo 동영상 리스트
 *
 * @author Jang Seongeun <jang@tjsrms.me>
 * @date 2017.01.11
 *************************************************************************************/
class Video extends SYB_Controller
{
    const VIMEO_AUTHORIZE_URL = "https://api.vimeo.com/oauth/authorize";
    const VIMEO_ACCESS_TOKEN_URL = "https://api.vimeo.com/oauth/access_token";
    const VIMEO_CLIENT_ID = "cf3d7ab65e7eef3daf7013f361f46d508c75c74e";
    const VIMEO_CLEINT_SECRET = "CUW0SsyAgx5nbsdnAVZ5KVX+5OwD0UpdRNeXzzmRUfDlh/tIEZmPQr1E4EWZw2o7MhuxDkYAXWiOEe32/5eOoSuG9Bc75sEG0FIVzxh89QnDOaIatuQwmL1SpieS2Nv6";
    const VIMEO_REDIRECT_URI = "http://www.1000syb.com/video";


    /**********************************************************
     * Video 리스트
     *********************************************************/
    function index()
    {
        if(! $access_token = $this->session->userdata('vimeo_access_token') )
        {
            // Vimeo API 사용
            // Code가 있는지 확인한다.

            // code 및 state값을 받는다.
            $code = $this->input->get('code', TRUE);

            if( empty($code) )
            {
                $param['response_type'] = 'code';
                $param['client_id'] = self::VIMEO_CLIENT_ID;
                $param['redirect_uri'] = self::VIMEO_REDIRECT_URI;
                $param['state'] = md5( microtime().mt_rand());

                $this->session->set_userdata('vimeo_state', $param['state']);

                redirect(self::VIMEO_AUTHORIZE_URL.'?'.http_build_query($param));
            }
            else {
                // access_token을 생성한다.
                $state = $this->input->get('state', TRUE);

                $param['code'] = $code;
                $param['grant_type'] = "authorization_code";
                $param['redirect_uri'] = self::VIMEO_REDIRECT_URI;
                //$param['state'] = $this->input->get('state', TRUE);

                $header = array("Authorization: Basic " . base64_encode( self::VIMEO_CLIENT_ID . ":" . self::VIMEO_CLEINT_SECRET ));

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, self::VIMEO_ACCESS_TOKEN_URL);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER , FALSE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
                $result = curl_exec($ch);

                $result_json = json_decode($result, TRUE);

                $access_token = $result_json['access_token'];
                $this->session->set_userdata('vimeo_access_token', $access_token);

                redirect("video");
            }
        }

        $result =
        $this->db->from("tbl_vimeo AS V")
                 ->order_by("vim_title")
                 ->get();

        $this->data['video_list'] = $result->result_array();

        $result =
            $this->db->from("tbl_vimeo")
                ->group_by("vim_category")
                ->get();
        $this->data['video_category'] = $result->result_array();

        $vimeo_pattern = "/(?:http?s?:\\/\\/)?(?:www\\.)?(?:vimeo\\.com)\\/?(\\S+)/";
        $youtube_pattern = "/(?:http?s?:\\/\\/)?(?:www\\.)?(?:youtube\\.com|youtu\\.be)\\/(?:watch\\?v=)?(\\S+)/";

        $no_thumb_count = 0;

        foreach($this->data['video_list'] as &$row)
        {
            if( preg_match($vimeo_pattern, $row['vim_url'], $match) )
            {
                $row['vim_type'] = "VIMEO";
            }
            else if ( preg_match($youtube_pattern, $row['vim_url'], $match) )
            {
                $row['vim_type'] = "YOUTUBE";
            }

            if( empty($row['vim_id']) )
            {
                if( $row['vim_type'] == 'VIMEO' OR $row['vim_type'] == 'YOUTUBE') {
                    $row['vim_id'] = $match[1];
                    $this->db->where('vim_idx', $row['vim_idx'])->set('vim_id', $row['vim_id'])->update('tbl_vimeo');
                }
            }
            else {
                if( $match[1] != $row['vim_id'] )
                {
                    $row['vim_id'] = $match[1];
                    $row['vim_thumb'] = "";
                    $this->db->where('vim_idx', $row['vim_idx'])->set('vim_id', $row['vim_id'])->update('tbl_vimeo');
                }
            }

            if( empty($row['vim_thumb']) && $no_thumb_count < 20)
            {
                if( $row['vim_type'] == 'VIMEO')
                {
                    $header = array("Authorization: Bearer " . $this->session->userdata('vimeo_access_token') );
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, "https://api.vimeo.com/videos/{$row['vim_id']}?fields=pictures");
                    curl_setopt($ch, CURLOPT_POST, FALSE);
                    curl_setopt ($ch, CURLOPT_HTTPHEADER, $header);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                    $result = curl_exec($ch);
                    $result_json = json_decode($result, TRUE);

                    if( $pictures = $result_json['pictures'] )
                    {
                        foreach( $pictures['sizes'] as $pic )
                        {
                            if($pic['width'] == 640 OR $pic['width'] == 960)
                            {
                                $row['vim_thumb'] = $pic['link'];
                                break;
                            }
                        }

                        if( empty($row['vim_thumb']) )
                        {
                            $row['vim_thumb'] = $pic['link'];
                        }
                    }

                    $no_thumb_count++;

                }
                else if ($row['vim_type'] == 'YOUTUBE')
                {
                    $row['vim_thumb'] = get_yt_thumb($row['vim_id'] ,'sd');
                }

                $this->db->where('vim_idx', $row['vim_idx'])->set('vim_thumb', $row['vim_thumb'])->update('tbl_vimeo');
            }

            // Embed Url Setting
            if( $row['vim_type']  == 'VIMEO' )
            {
                $row['vim_embed_url'] = "https://player.vimeo.com/video/{$row['vim_id']}";;
            }
            else if ($row['vim_type'] == 'YOUTUBE')
            {
                $row['vim_embed_url'] = "http://www.youtube.com/embed/{$row['vim_id']}?hl=ko_KR&version=3&autoplay=0&loop=1&showinfo=0&controls=1&rel=0&playlist={$row['vim_id']}";
            }
        }

        $this->site->meta_title = "지역별 참고 동영상";
        $this->layout = "desktop";
        $this->view = "video/index";
    }
}