<?php

/**
 * Description of MY_Log
 *
 * @author Andi Susilo
 */
class MY_Log extends CI_Log {
    
    function get_log_path() {
        return $this->_log_path;
    }

}