<?php
/**
 * Description of MY_Exceptions
 *
 * @author Andi Susilo
 */

class MY_Exceptions extends CI_Exceptions {

    function  __construct() {
        parent::__construct();
        
        if (class_exists('CI_Controller')) {
            $CI =  &get_instance();
            $CI->lang->load_gettext();
        } else {
            require_once APPPATH.'helpers/x_helper'.EXT;
        }
    }

}

