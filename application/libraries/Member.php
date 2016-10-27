<?php
/******************************************************
 * Class Member
 * 
 * 회원관련 라이브러리
 ******************************************************/
class Member {

    protected $CI;
    protected $mb;

    function __construct()
    {
        $this->CI =& get_instance();
    }

    /***************************************************
     *
     * 현재 회원이 로그인된 상태인지 확인합니다.
     * @return bool
     **************************************************/
    public function is_login()
    {
        if ($this->CI->session->userdata('ss_u_id')) {
            return $this->CI->session->userdata('ss_u_id');
        } else {
            return FALSE;
        }
    }

    /***************************************************
     * 회원정보중 한 컬럼을 반환합니다.
     * @param null $column
     * @return null
     **************************************************/
    public function info($column = NULL)
    {
        // 현재 로그인되어있는 아이디 가져옴
        $id = $this->is_login();
        if(! $id) return NULL;
        if( ! $this->mb )
        {
            $this->CI->load->model('user_model');
            $this->mb =$this->CI->user_model->get_by_id($id);
        }

        if( $column )
        {
            return $this->mb[$column];

        }
        else {
            return $this->mb;
        }
    }

    /***************************************************
     *
     * 현재 사용자의 회원 레벨을 반환합니다.
     * @return int
     *
     **************************************************/
    public function level() {
        return (int)$this->info("ath_level");
    }
}