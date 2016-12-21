<?php

/**
 * Description of sysparam
 *
 * @author Andi Susilo
 */
class Sysparam extends App_Crud_Controller {

    function _config_grid() {
        $config = parent::_config_grid();
        $config['fields']    = array('sgroup', 'skey', 'svalue', 'lvalue');
        $config['names']    = array('Group', 'Key', 'Value Pendek', 'Value Panjang');
        return $config;
    }

}