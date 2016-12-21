<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Description of MY_Model
 *
 * @author Andi Susilo
 */

class MY_Model extends CI_Model {

}

require_once(APPPATH.'/models/base_model'.EXT);
require_once(APPPATH.'/models/app_base_model'.EXT);

//function model_loader($class_name) {
//    if (strpos($class_name, 'Base_Model')) {
//        require_once(APPPATH.'/models/'.strtolower($class_name).EXT);
//    }
//}
//
//spl_autoload_register('model_loader');

?>
