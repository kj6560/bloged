# Simple MVC PHP Framework created by Keshav Jha


 
#Configure the framework by the following

//site name
define('SITE_NAME', 'site_name'); //change this

//App Root
define('APP_ROOT', dirname(dirname(__FILE__)));
define('URL_ROOT', '/');
define('URL_SUBFOLDER', '');
define('BASE', 'http://host/'); //change this

$host = "host"; //change this
$username = "user"; //change this
$password = "password"; //change this
$database = "db_name"; //change this
R::setup("mysql:host=$host;dbname=$database", $username, $password);
R::freeze( TRUE );
