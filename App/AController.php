<?php

namespace App;


use App\Exceptions\AuthException;

abstract class AController
{
    use TSingleton;

    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

}