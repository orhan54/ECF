<?php
$user = isset($_SESSION["user"]) ? $_SESSION["user"] : false;
ob_start();
?>

<nav class="navbar bg-dark">
    <div class="container-fluid bg-dark">
        <a id="enseigne" class="navbar-brand fs-2" href="#">Nos Pizzas</a>
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <button class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#connexionModal">Connexion<i
                            class="bi bi-person p-2 h4"></i></button>
                </li>
                <li class="nav-item">
                    <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#panierModal">Panier<i
                            class="bi bi-cart4 ms-5 h4"></i></button>
                </li>
            </ul>
        </div>

        <!-- Modal de connexion -->
        <div class="modal fade" id="connexionModal" tabindex="-1" aria-labelledby="connexionModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><span id="connexionModalLabel">Connexion</span><i class="bi bi-person p-2 h4"></i></h5>
                        <button type="button" class="btn btn-secondary ms-2" id="creerCompteBtn">Créer compte</button>
                        <button type="button" class="btn btn-danger ms-2" id="annulerBtn" style="display: none;">Annuler</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="connexion">
                            <form action="index.php?route=login" method="POST">
                                <div class="mb-3">
                                    <label for="emailConnect" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="emailConnect" placeholder="Entrez votre email">
                                </div>
                                <div class="mb-3">
                                    <label for="passwordConnect" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="passwordConnect" placeholder="Entrez votre mot de passe">
                                </div>
                                <button type="submit" class="btn btn-primary">Se connecter</button>
                            </form>
                        </div>
                        <div id="creationCompte" style="display: none;">
                            <form id="connexionForm" action="index.php?route=register" method="POST">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Entrez votre email">
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Mot de passe</label>
                                    <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe">
                                </div>
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom">
                                </div>
                                <div class="mb-3">
                                    <label for="telephone" class="form-label">Numéro</label>
                                    <input type="text" class="form-control" id="telephone" placeholder="Entrez votre numéro">
                                </div>
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" placeholder="Entrez votre adresse">
                                </div>
                                <div class="mb-3">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" class="form-control" id="ville" placeholder="Entrez votre ville">
                                </div>
                                <button type="submit" class="btn btn-success">s'enregister</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal du Panier -->
        <div class="modal fade" id="panierModal" tabindex="-1" aria-labelledby="panierModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="panierModalLabel">Panier<i class="bi bi-cart4 ms-5 h4"></i></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <ul id="votrePanier">

                        </ul>
                    </div>
                    <div class="modal-footer">
                        <p><strong id="totalAPayer">Montant total à régler: 0€</strong></p>
                        <button type="button" class="btn btn-primary">Payer</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<header>
    <div class="input-group mb-3">
        <label class="input-group-text ms-5 mt-3" for="filtre-pizza">Options</label>
        <select id="pizzaFiltreValue" class="form-select me-5 mt-3">
            <option value="all" selected>Toutes les pizzas</option>
            <option value="crême">Base crème</option>
            <option value="tomate">Base tomate</option>
            <!-- <option value="3">Végétarienne</option> -->
        </select>
    </div>
</header>

<section class="container d-flex flex-column mt-4">
    <div id="mon-contenu" class="row">

        <!-- Ici seront affichées les pizzas -->

    </div>
</section>



<?php
$content = ob_get_clean();
include("layout.php");
?>