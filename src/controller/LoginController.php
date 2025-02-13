<?php

namespace App\controller;

use App\model\ClientDAO;
use App\model\ModelException;
use App\Router;

/**
 *  Contrôlleur responsable de l'authentification d'un utilisateur
 */
class LoginController implements ControllerInterface {

    /**
     * Instance de la classe UserDAO
     * @var ClientDAO $model
     */
    private ClientDAO $model;

    /**
     * Construit une nouvelle instance
     */
    public function __construct() {
        $this->model = new ClientDAO();
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode GET
     * @return void
     */
    public function doGET(): void {
        // affiche le formulaire de connexion
        $title = "Connexion";
        include("./src/view/login.php");
    }

    /**
     * Traite les requêtes HTTP envoyées par la méthode POST
     * @return void
     */
    public function doPOST(): void {
        $email = $_POST['email_client'] ?? null;
        $password = $_POST['mot_de_passe_client'] ?? null;

        if ($email && $password) {
            try {
                $client = $this->model->login($email, $password);
                if (password_verify($password, $client->getClientPassword())) {
                    $_SESSION['client'] = $client;
                    Router::redirect("home", 302);
                } else {
                    $error = "Identifiants incorrects";
                    include("./src/view/home.php");
                }
            } catch (ModelException $e) {
                $error = $e->getMessage();
                include("./src/view/home.php");
            }
        } else {
            $error = "Veuillez remplir tous les champs";
            include("./src/view/home.php");
        }
    }
}