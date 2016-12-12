<?php

namespace App;
use App\Exceptions\BaseException;
use MongoDB\Driver\Exception\ConnectionException;

/**
 * Class Router
 * @package App
 */
class Router
{
    /**
     * @return string query
     */
    public function run()
    {
        $parts = explode('/', $_SERVER['REQUEST_URI']);
         //get controller

        $ctrlRequest = !empty($parts[1]) ? $parts[1] : 'Index';
        $ctrlClassName = '\App\Controllers\\' . $ctrlRequest;
        $ctrl = new $ctrlClassName;

        //get method
        $actRequest = !empty($parts[2]) ? $parts[2] : 'Default';
        //get id
        $idRequest = !empty($parts[3]) ? $parts[3] : null;

        $actMethodName = 'action' . $actRequest;

        $ctrl->$actMethodName($idRequest);

    }
}