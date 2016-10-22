<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SYB_Loader extends CI_Loader {

    public function layout($path, $vars = array(), $return = FALSE)
    {
        return $this->_ci_load(array('_ci_path' => $path, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
    }
}
