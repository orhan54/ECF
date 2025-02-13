<?php

namespace App;

use App\controller\ControllerException;
use App\controller\ControllerInterface;

/**
 * La class Router implémente un routeur simple basé sur le paramètre GET nommé "route"
 */
class Router
{
    /**
     * Stocke le mapping entre nom de routes et contrôlleurs
     * @var array
     */
    private static array $routes = [];


    /**
     * Enregistre une route dans le système
     * @param string $route Nom de la route utilisé en paramètre GET dans l'URL
     * @param \App\controller\ControllerInterface $controller Instance du contrôlleur en charge de cette route
     * @return void
     */
    public static function addRoute(string $route, ControllerInterface $controller): void {
        self::$routes[$route] = $controller;
    }

    /**
     * Délegue le traitement de la requête au contrôlleur et à sa méthode appropriée
     * @throws ControllerException Si la route demandée n'existe pas
     * @return void
     */
    public static function delegate(): void {
        $route = $_GET['route'] ?? 'home';
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset(self::$routes[$route])) {
            throw new ControllerException("Route non trouvée");
        }

        $controller = self::$routes[$route];

        if ($method === 'GET') {
            $controller->doGET();
        } elseif ($method === 'POST') {
            $controller->doPOST();
        } else {
            throw new ControllerException("Méthode HTTP non supportée");
        }
    }

    /**
     * Redirige l'application vers une route avec la méthode spécifiée
     * @param string $method Méthode HTTP
     * @param string $route
     * @throws \App\controller\ControllerException
     * @return void
     */
    public static function redirect(string $method, string $route): void {
        if ($method === 'POST') {
            header("Location: index.php?route=$route");
            exit();
        } else {
            throw new ControllerException("Redirection non supportée pour la méthode $method");
        }
    }
}