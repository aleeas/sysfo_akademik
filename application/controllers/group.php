<?php
/**
 * Description of group
 *
 * @author Andi Susilo
 */
class Group extends App_Crud_Controller {
    
    function _config_grid() {
        $config = parent::_config_grid();
        $config['fields']    = array('name');
        return $config;
    }

}