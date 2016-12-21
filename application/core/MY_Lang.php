<?php

/*
 * MY_Lang.php
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
 * Description of MY_Lang
 *
 * @author Andi Susilo
 */
class MY_Lang extends CI_Lang {

    function __construct() {
        parent::__construct();
    }

    function load_gettext($language = null, $domain = 'messages') {
        require_once APPPATH . '/helpers/x_helper' . EXT;
        include APPPATH . 'config/' . ENVIRONMENT . '/config' . EXT;
        $tmp = $config;
        include APPPATH . 'config/' . ENVIRONMENT . '/app' . EXT;
        $config = array_merge($tmp, $config);

        if (!empty($config['language'])) {
            $default_langs = array($config['language'] . '.' . $config['charset']);
        }

        $languages = array();
        if (isset($config['lang_force']) && $config['lang_force']) {
            $languages[] = $config['language'];
        } else {
            if (!empty($language)) {
                if (is_array($language)) {
                    $languages = array_merge($languages, $language);
                } else {
                    $languages[] = $language;
                }
            }

            $t = explode(',', @$_SERVER['HTTP_ACCEPT_LANGUAGE']);
            foreach ($t as &$data) {
                $t1 = explode(';', $data);
                $data = $t1[0];
            }
            $accept_lang = $t;

            if (!empty($accept_lang)) {
                $to_merge = array();
                foreach ($accept_lang as $lang) {
                    $to_merge[] = implode('_', explode('-', $lang));
                }
                $languages = array_merge($languages, $to_merge);
            }
            $languages = array_merge($languages, $default_langs);
        }

        // get current timestamp
        $current_domain = '';
        foreach ($languages as &$language) {
            $language = $this->_fix_lang($language);

            // FIXME charset is forced to UTF-8
//            $http_charsets = explode(',', $accept_charset[0]);
            $default_charset = 'UTF-8';

            if (count(explode('.', $language)) <= 1) {
                $language = $language . '.' . $default_charset;
            }

            if (empty($current_domain)) {
                $l = explode('.', $language);
                $domains = glob(APPPATH . 'language/locale/' . $l[0] . '/LC_MESSAGES/messages-*.mo');
                if (!empty($domains)) {
                    $current = basename($domains[0], '.mo');
                    $timestamp = preg_replace('{messages-}i', '', $current);
                    $current_domain = $current;
                }
            }
        }

        if (empty($current_domain)) {
            $current_domain = $domain;
        }
        
        // FIXME to get support multi language fallback with putenv 
        if (is_array($languages)) {
        	putenv("LC_ALL=".$languages[0]);
        } else {
        	putenv("LC_ALL=".$languages);
        }
        setlocale(LC_ALL, 'id_ID.UTF-8');
        bindtextdomain($current_domain, APPPATH . 'language/locale');
        textdomain($current_domain);
    }

    function _fix_lang(&$lang) {
        if ($lang == 'id') {
            $lang = 'id_ID';
        }
        return $lang;
    }

}

