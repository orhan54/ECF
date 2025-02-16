<?php

namespace App\controller;

use App\model\ClientDAO;
use App\model\ClientEntity;
use App\Router;

/**
 *  Contrôlleur responsable de l'inscription d'un nouvel utilisateur
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
    public function doPOST(): void {
        $email = $_POST['email_client'];
        $password = hash("sha512", $_POST['mot_de_passe_client']);
        $nom = $_POST['nom_client'];
        $prenom = $_POST['prenom_client'];
        $telephone = $_POST['telephone_client'];
        $adresse = $_POST['adresse_client'];
        $ville = $_POST['ville_client'];
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
        Router::redirect("POST", "home");
    }
}