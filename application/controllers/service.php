<?php

/*
 * service.php
 *
 * Created on 05/07/2011 14:57:41
 *
 * Copyright(c) 2011 PT Sagara Xinix Solusitama.  All Rights Reserved.
 * This software is the proprietary information of PT Sagara Xinix Solusitama.
 *
 * History
 * =======
 * (dd/mm/yyyy hh:mm) (name)
 * 05/07/2011 14:57   @author Andi Susilo
 *
 */

/**
 * Description of service
 *
 * @author Andi Susilo
 */
class Service extends Cli_Controller {

	// example of translate chat service
    function translate() {
        $this->load->library('svc_system', NULL, 'svc');
        $this->svc->run();
        exit;
    }

}