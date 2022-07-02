<?php

namespace App\Commands;


class Bloged
{
    public function action($args)
    {
        $script = array_shift($args);

        print($args[0]);
    }
}
