<?php

namespace App\controller;

use App\model\PizzaDAO;

class PizzaController implements ControllerInterface {

    private $pizzaDAO;

    public function __construct() {
        $this->pizzaDAO = new PizzaDAO();
    }

    public function doGET() {
        $title = "Pizza";
        $pizzas = $this->pizzaDAO->findAll();
        header('Content-Type: application/json');
        echo json_encode($pizzas);
    }

    public function doPOST() {
        throw new ControllerException("Cette action n'est pas supportée");
    }
}