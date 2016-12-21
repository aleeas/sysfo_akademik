<?php

class MY_Upload extends CI_Upload {

    var $field = '';

    function initialize($params = array()) {
        $CI = &get_instance();

        if (!empty($params['field'])) {
            $this->field = $params['field'];
        }

        parent::initialize($params);
    }

}