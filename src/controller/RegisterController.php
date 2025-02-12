<?php

namespace App\controller;

use App\model\ClientDAO;
use App\model\ClientEntity;
use App\Router;

/**
 *  Contrôlleur responsable de l'inscription d'un nouvel utiilisateur
 */
class RegisterController implements ControllerInterface {

    /**
     * Instance de la classe UserDAO
     * @var ClientDAO $model
     */
    private ClientDAO $model;

    /**
     * Construit une nouvelle instance
     */
    public function __construct(){
        $this->model = new ClientDAO();
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode GET
     * @return void
     */
    public function doGET(): void {
        // affiche le formulaire d'inscription
        $title = "Inscription";
        include("./src/view/home.php");
    }
    
    /**
     * Traite les requêtes HTTP envoyées par la méthode POST
     * @return void
     */
    public function doPOST() {
        $email = $_POST['email'];
        $password = $_POST['password'];
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
        Router::redirect("GET", "/");
    }
}