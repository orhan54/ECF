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
        $json = file_get_contents('php://input');
        $data = json_decode($json);
        foreach ($data["commande"] as $commande) {
            //traitement de la commande
            // $commande["nom_pizza"]
            // $commande["quantite"]
        }
        // echo json_encode("toDO: enregistrement panier");
        
    }
}
