<?php

// importe le script de chargement automatique fournit par composer
// voir la configuration à la clé "autoload" dans le fichier composer.json
require_once('./vendor/autoload.php');

// utilise la dépendance phpdotenv pour charger le contenu du fichier .env
$dotenv = \Dotenv\Dotenv::createImmutable('./');
$dotenv->load();

session_start();

// raccourci vers les namespaces utilisés dans ce fichier
use App\Router;
use App\controller\HomeController;
use App\controller\RegisterController;
use App\controller\PizzaController;

// enregistre les routes qui pointent vers les classes de contrôleurs
Router::addRoute("home", new HomeController());
Router::addRoute("register", new RegisterController());
Router::addRoute("pizza", new PizzaController());

// une fois les routes enregistrées demande au routeur de déléguer la requête
Router::delegate();
