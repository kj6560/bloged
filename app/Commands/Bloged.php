<?php

namespace App\Commands;


class Bloged
{
    public function action($args)
    {
        require_once "/".ucfirst($args[0]).".php";
        $classname = ucfirst($args[0]);
        $comm = new $classname;
    }
}
