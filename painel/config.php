<?php
require 'environment.php';

define("BASE", "http://localhost/ead/painel/");

global $config;
$config = array();
if(ENVIRONMENT == 'development') {
	$config['dbname'] = 'ead';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
} else {
	$config['dbname'] = 'ead';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = 'root';
}

?>