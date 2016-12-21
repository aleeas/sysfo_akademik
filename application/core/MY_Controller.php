<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of MY_Controller
 *
 * @author Andi Susilo
 */
function controller_loader($class_name) {
    if (strpos($class_name, '_Controller')) {
        require_once(APPPATH.'/controllers/'.strtolower($class_name).EXT);
    }
}

spl_autoload_register('controller_loader');


?>
