<?php

namespace App\controller;

use App\controller\ControllerInterface;
use App\Router;

class RegisterPanierController implements ControllerInterface
{

    public function __construct() {}

    public function doGET() {}

    public function doPOST()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $nomPizza = $data["commande"];
        var_dump($data);
        exit;
    }
}
