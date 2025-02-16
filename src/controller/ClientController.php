<?php

namespace App\controller;

use App\model\ClientDAO;
use App\model\ClientEntity;
use App\Router;

class ClientController implements ControllerInterface {

    private ClientDAO $model;

    public function __construct() {
        $this->model = new ClientDAO();
    }

    public function doGET()
    {
        $title = "home";
        include("./view/home.php");
    }

    public function doPOST() {
        try {
            $email = $_POST['email'];
            $password = hash("sha512", $_POST['password']);
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $telephone = $_POST['telephone'];
            $adresse = $_POST['adresse'];
            $ville = $_POST['ville'];
            $newClient = new ClientEntity();
            $newClient
                ->setClientEmail($email)
                ->setClientPassword($password)
                ->setClientNom($nom)
                ->setClientPrenom($prenom)
                ->setClientTelephone($telephone)
                ->setClientAdresse($adresse)
                ->setClientVille($ville);
            $this->model->create($newClient);
            Router::redirect("POST", "index.php?route=home");
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}