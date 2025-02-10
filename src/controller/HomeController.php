<?php

namespace App\controller;

class HomeController implements ControllerInterface {

    public function __construct() {}

    public function doGET() {
        $title = "Accueil";
        include("./src/view/home.php");
    }
    public function doPOST() {
        throw new ControllerException("Cette action n'est pas supportée");
    }

}