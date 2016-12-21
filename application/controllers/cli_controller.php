<?php

/**
 * Description of app_base_controller
 *
 * @author Andi Susilo
 */
class Cli_Controller extends CI_Controller {

    function _post_controller_constructor() {
        if (!$this->_check_access()) {
            $this->load->helper('url');
            header("Status: 500 Cannot access from outside CLI");
            exit;
        }
    }
    
    function _check_access() {
        return $this->input->is_cli_request();
    }
    
    function &_model($name) {
        $model = $name . '_model';
        $this->load->model($model);
        return $this->$model;
    }

}

