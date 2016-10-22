<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SYB_Model extends CI_Model
{
    protected $_table   = NULL;
    protected $_pk      = NULL;
    protected $_status  = NULL;

    function __construct()
    {
        parent::__construct();
    }

    function get_one( $idx , $column = "" )
    {
        if(empty($idx)) {
            return FALSE;
        }

        if(empty($column)) {
            $column = $this->_pk;
        }

        $this->db->where($column, $idx);
        $result = $this->db->get($this->_table);

        return $result->row_array();
    }
}