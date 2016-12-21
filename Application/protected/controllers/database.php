<?php defined('SYSPATH') OR die('No direct access allowed.');

return array
(
	'default' => array
	(
		'type'       => 'MySQL',
		'connection' => array(
			/**
			 * The following options are available for MySQL:
			 *
			 * string   hostname     server hostname, or socket
			 * string   database     database name
			 * string   username     database username
			 * string   password     database password
			 * boolean  persistent   use persistent connections?
			 * array    variables    system variables as "key => value" pairs
			 *
			 * Ports and sockets may be appended to the hostname.
			 */
			'hostname'   => 'rdst3c1risr4c416vd03.mysql.rds.aliyuncs.com',
			'database'   => 'yijuhua_sso',
			'username'   => 'yijuhuauser',
			'password'   => 'Y3S0Sy77923JkxaRF74o',
			'persistent' => FALSE,
		),
		'table_prefix' => '',
		'charset'      => 'utf8',
		'caching'      => FALSE,
	),

	'syj' => array
    (
        'type'       => 'MySQL',
        'connection' => array(
            /**
             * The following options are available for MySQL:
             *
             * string   hostname     server hostname, or socket
             * string   database     database name
             * string   username     database username
             * string   password     database password
             * boolean  persistent   use persistent connections?
             * array    variables    system variables as "key => value" pairs
             *
             * Ports and sockets may be appended to the hostname.
             */
            'hostname'   => 'rdsl4ijt20w58yr268v6.mysql.rds.aliyuncs.com',
            //'hostname'   => '192.168.1.62',
            'database'   => 'syj_platform',
            'username'   => 'syj_platformuser',
            'password'   => 'Y3S0Sy779fbJkxaRF74o',
            'persistent' => FALSE,
        ),
        'table_prefix' => 'syj_',
        'charset'      => 'utf8',
        'caching'      => FALSE,
    ),

);
