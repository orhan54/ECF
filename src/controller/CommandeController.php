<?php

namespace App\controller;

use App\model\CommandeDAO;
use App\model\CommandeEntity;
use App\Router;

class CommandeController implements ControllerInterface
{

    private CommandeDAO $model;

    public function __construct()
    {
        $this->model = new CommandeDAO();
    }

    public function doGET()
    {
        $title = "Commande";
        $commandes = $this->model->readAll();
        header('Content-Type: application/json');
        echo json_encode($commandes);
    }

    public function doPOST()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        $commandes = $data["commande"];

        foreach ($commandes as $commande) {
            $idPizza = $commande['id_pizza'];
            $idClient = $commande['id_client'];
            $quantite = $commande['quantite_commande'];
            $date = $commande['date_commande'];

            $newCommande = new CommandeEntity();
            $newCommande
                ->setPizzaId($idPizza)
                ->setClientId($idClient)
                ->setCommandeQuantite($quantite)
                ->setCommandeDate($date);
            $this->model->create($newCommande);
        }
    }
}