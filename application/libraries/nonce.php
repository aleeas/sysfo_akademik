<?php

/**
 * Description of nonce
 *
 * @author Andi Susilo
 */
class Nonce {

    var $_track;

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

    function create() {
        $CI = &get_instance();

        $nonce = hash_hmac('md5', uri_string(), uniqid());

        $data = array(
            'nonce' => $nonce,
            'uri' => $CI->uri->uri_string,
            'referer' => $CI->input->referer(),
        );
        $this->_set($nonce, $data);
        return $nonce;
    }

    function validate($nonce) {
        $data = $this->_get($nonce);
        if (empty($data)) {
            return false;
        }
        return true;
    }

    function destroy($nonce) {
        $this->_set($nonce, NULL);
    }

    function get($nonce) {
        return $this->_get($nonce);
    }

    function _get($nonce) {
        $CI = &get_instance();
        $nonces = $CI->session->userdata('nonces');
        return $nonces[$nonce];
    }

    function _set($nonce, $data) {
        $CI = &get_instance();
        $nonces = $CI->session->userdata('nonces');

        // TODO if you want multi nonce comment one line below
        $nonces = array();

        if (empty($data)) {
            unset($nonces[$nonce]);
        } else {
            $nonces[$nonce] = $data;
        }
        $CI->session->set_userdata('nonces', $nonces);
    }

    function track() {
        $CI = &get_instance();
        $uri = uri_string();

        $this->_track = $CI->session->userdata('track');

        if (empty($this->_track)) {
            $this->_track = array();
        }

        $found = false;

        $new = array();

        foreach ($this->_track as $key => $track_uri) {
            if ($track_uri == $uri) {
                $found = true;
            }

            if (!$found) {
                $new[] = $track_uri;
            }
        }


        $this->_track = $new;
        $this->_track[] = $uri;

        $CI->session->set_userdata('track', $this->_track);

        return $this->_track;
    }

    function get_track() {
        return $this->_track;
    }

    function back_track() {
        if (count($this->_track) <= 1) {
            return '/';
        }

        if ($this->_track[count($this->_track) - 2]) {
            return $this->_track[count($this->_track) - 2];
        }
    }

}