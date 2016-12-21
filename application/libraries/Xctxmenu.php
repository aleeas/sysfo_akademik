<?php
/**
 * Description of Xcontext_menu
 *
 * @author Andi Susilo
 */
class Xctxmenu {

    var $actions = array();

    function  __construct($params = array()) {
        $this->initialize($params);
    }

    function initialize($params = array()) {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->$key)) {
                    $this->$key = $val;
                }
            }
        }
    }

    function show($selector) {
        $CI = &get_instance();

        return $CI->load->view('libraries/xctxmenu_show', array(
                'selector' => $selector,
                'self' => $this,
                ), true);
    }
}
?>
