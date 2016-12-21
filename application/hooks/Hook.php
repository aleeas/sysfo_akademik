<?php

/*
 * Hook.php
 *
 * Created on 21/06/2011 16:17:47
 *
 * Copyright(c) 2011 PT Sagara Xinix Solusitama.  All Rights Reserved.
 * This software is the proprietary information of PT Sagara Xinix Solusitama.
 *
 * History
 * =======
 * (dd/mm/yyyy hh:mm) (name)
 * 21/06/2011 16:17   @author Andi Susilo
 *
 */

/**
 * Description of Hook
 *
 * @author Andi Susilo
 */
class Hook {
    function post_controller_constructor() {
        $CI = &get_instance();
        if (method_exists($CI, '_post_controller_constructor')) {
            $CI->_post_controller_constructor();
        }
    }

    function post_controller() {
        $CI = &get_instance();
        if (method_exists($CI, '_post_controller')) {
            $CI->_post_controller();
        }
    }
}

