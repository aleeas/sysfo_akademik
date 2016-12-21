<?php
$config = array(
        'hostname' => 'semut-srv.xinix-technology.com',
        'port' => 389,
        'protocol_version' => 3,
        'base_dn' => 'dc=xinix,dc=co,dc=id',
        'user_dn' => 'cn=admin,dc=xinix,dc=co,dc=id',
        'password' => 'password',
        'user_base' => 'ou=employees,dc=xinix,dc=co,dc=id',
        'query' => '(cn=%s)',
        'fields' => array ('cn','mail'),
);