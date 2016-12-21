<?php

/**
 * Description of svc_system
 *
 * @author Andi Susilo
 */
require_once APPPATH . 'libraries/Xservice.php';

class svc_system extends Xservice {

    function request($request) {
		// service example
        $json = file_get_contents("https://ajax.googleapis.com/ajax/services/language/translate?v=1.0&q=".rawurlencode($request)."&langpair=id%7Cen");
        $data = json_decode($json);
        return $data->responseData->translatedText;
    }

}
