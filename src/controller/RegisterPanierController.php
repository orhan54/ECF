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
    $commandes = $data["commande"];

    foreach ($commandes as $commande) {
        $nomPizza = $commande['nom_pizza'];
        $quantite = $commande['quantité'];
        echo "Nom de la pizza: $nomPizza, Quantité: $quantite\n";
    }
}
}
