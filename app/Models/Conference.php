<?php 
namespace App\Models;
use \RedBeanPHP\R as R;
class Conference extends \RedBeanPHP\SimpleModel
{
	
    public function readConferences(){
        $conference = R::dispense("conference");
        print_r($conference);
    }
	
}