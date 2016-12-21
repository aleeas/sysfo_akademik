<?php

/**
 * Description of Xservice
 *
 * @author Andi Susilo
 */
class Xservice {

    var $inbox = 'chat_inbox';
    var $outbox = 'chat_outbox';

    function __construct($params = array()) {
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

    function request($request) {
        return $request;
    }

    function run() {
        $CI = &get_instance();
        
        while (1) {
            $inbox = $CI->_model($this->inbox)->find();

            foreach ($inbox as $row) {
                $response = $this->request($row['body']);
                if (!is_array($response)) {
                    $response = array($response);
                }

                foreach ($response as $line) {
                    $CI->_model($this->outbox)->save(array(
                        'account' => $row['account'],
                        'to' => $row['from'],
                        'body' => $line,
                    ));
                }
            }
            $CI->_model($this->inbox)->truncate();
            sleep(1);
        }
    }

}