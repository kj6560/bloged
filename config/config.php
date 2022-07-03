<?php
//site name
define('SITE_NAME', 'Shiwkesh Schematics');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE', 'http://34.221.227.247/');

$host = "34.221.227.247";
$username = "keshav";
$password = "mainsite";
$database = "mainsite";
R::setup("mysql:host=$host;dbname=$database", $username, $password);
R::freeze( TRUE );

