<?php
//site name
define('SITE_NAME', 'Bloged');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE', 'http://34.221.227.247/');

$host = "127.0.0.1";
$username = "root";
$password = "";
$database = "mainsite";
R::setup("mysql:host=$host;dbname=$database", $username, $password);
R::freeze( TRUE );