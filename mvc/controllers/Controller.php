<?php 
class Controller{

    function __construct($class_name){       
        $this->loadModel(get_class($this));
    }

    public function loadModel($name){
        $name = ucfirst($name);
         $path = 'mvc/model/' . $name . '.php';

         if(file_exists($path)){
              require 'mvc/model/' . $name . '.php';
              $this->model = new $name();            
         }
    }
}
