<?php
//site name
define('SITE_NAME', 'Shiwkesh Schematics');

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE', 'https://shiwkesh.online/');

$host = "localhost";
$username = "shiwkes1_mainsite";
$password = "mainsite123"; 
$database = "shiwkes1_mainsite";
R::setup("mysql:host=$host;dbname=$database", $username, $password);
R::freeze( TRUE );

