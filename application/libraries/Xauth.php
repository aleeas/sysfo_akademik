<?php

/**
 * Description of Xauth
 *
 * @author Andi Susilo
 */
class Xauth {

    var $session_id = 'xauth.user';
    var $schema = array('ldap', '');

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

    function login($login, $password, $mode = '') {
        if (empty($mode) && (empty($login) || empty($password))) {
            return false;
        }

        if (empty($mode)) {
            $modes = $this->schema;
        } else {
            $modes = array($mode);
        }

        foreach ($modes as $mode) {
            $user = $this->try_login($login, $password, $mode);
            if (!empty($user)) {
                $this->set_user($user);
                return true;
            }
        }

        return false;
    }

    function try_login($login, $password, $mode) {
        $CI = &get_instance();
        $method = (empty($mode)) ? 'login' : 'login_' . $mode;

        if ($mode == 'facebook') {
            $CI->load->library('facebook');
            if (!$CI->facebook->logged_in()) {
                $CI->facebook->login();
                exit;
            } else {
                $user_sso = $CI->facebook->user();
                $user = $CI->_model('user')->$method($user_sso->id);
                if (!empty($user)) {
                    return $user;
                }

                // calback
                $data = array(
                    'sso_facebook' => $user_sso->id,
                    'username' => uniqid(),
                    'password' => '',
                    'email' => $user_sso->email,
                    'first_name' => $user_sso->first_name,
                    'last_name' => $user_sso->last_name,
                    'address' => $user_sso->location->name,
                );
                $CI->_model('user')->save($data);
                return $CI->_model('user')->$method($user_sso->id);
            }
        } else if ($mode == 'twitter') {
            $CI->load->library('tweet');
            if (!$CI->tweet->logged_in()) {
                $CI->tweet->login();
                exit;
            } else {
                $user_sso = $CI->tweet->call('get', 'account/verify_credentials');

                $user = $CI->_model('user')->$method($user_sso->id);
                if (!empty($user)) {
                    return $user;
                }

                $name = explode(' ', $user_sso->name);
                if (empty($name)) {
                    $name = $user_sso->screen_name;
                }

                // calback
                $data = array(
                    'sso_twitter' => $user_sso->id,
                    'username' => uniqid(),
                    'password' => '',
                    'first_name' => $name[0],
                    'last_name' => $name[count($name) - 1],
                );
                $CI->_model('user')->save($data);
                return $CI->_model('user')->$method($user_sso->id);
            }
        }




        return $CI->_model('user')->$method($login, $password);
    }

    function logout() {
        $CI = &get_instance();
        $CI->session->sess_destroy();
        $CI->session->sess_create();
        $this->set_user(null);
    }

    function is_login() {
        return $this->get_user()->is_login;
    }

    function set_user($user) {
        $CI = &get_instance();
        if (empty($user)) {
            $user = new stdClass();
            $user->login = $user->username = 'guest';
            $user->id = '0';
            $CI->_model('user')->_fetch_user_data($user);
            $user->is_login = false;
        } else {
            $user->is_login = true;
        }
        $CI->session->set_userdata($this->session_id, $user);
        return $user;
    }

    function get_user($refetch = false) {
        $CI = &get_instance();
        $user = $CI->session->userdata($this->session_id);
        if ($refetch) {
            $user = $CI->_model('user')->refetch_user($user);
            $user->is_login = true;
            $CI->session->set_userdata($this->session_id, $user);
        }
        if (empty($user)) {
            $user = $this->set_user(null);
        }
        return $user;
    }

}
