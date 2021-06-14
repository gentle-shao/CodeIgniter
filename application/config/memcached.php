<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Memcached settings
| -------------------------------------------------------------------------
| Your Memcached servers can be specified below.
|
|	See: https://codeigniter.com/userguide3/libraries/caching.html#memcached
|
*/
$config = array(
	'default' => array(
		'hostname' => getenv('MEMCACHED_HOST'),
		'port'     => getenv('MEMCACHED_PORT'),
		'weight'   => getenv('MEMCACHED_WEIGHT'),
	),
);
