<?php 

namespace App\Controllers;
use Symfony\Component\Routing\RouteCollection;

class PageController extends Controller
{
    // Homepage action
	public function index(RouteCollection $routes)
	{
		$this->loadView('general_layout','views/home',array());
	}
}