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
                        <h5 class="modal-title" id="connexionModalLabel">Connexion<i class="bi bi-person p-2 h4"></i></h5>
                        <button type="button" class="btn btn-secondary ms-2" id="creerCompteBtn">Créer compte</button>
                        <button type="button" class="btn btn-danger ms-2" id="annulerBtn">Annuler</button>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="connexionForm" action="/?route=register" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Entrez votre email">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe">
                            </div>
                            <div id="creationCompte" style="display: none;">
                                <div class="mb-3">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom">
                                </div>
                                <div class="mb-3">
                                    <label for="prenom" class="form-label">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom">
                                </div>
                                <div class="mb-3">
                                    <label for="numero" class="form-label">Numéro</label>
                                    <input type="text" class="form-control" id="numero" placeholder="Entrez votre numéro">
                                </div>
                                <div class="mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" placeholder="Entrez votre adresse">
                                </div>
                                <div class="mb-3">
                                        <label for="ville" class="form-label">Ville</label>
                                        <input type="text" class="form-control" id="ville" placeholder="Entrez votre ville">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="button" class="btn btn-primary">Se connecter</button>
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
            <option value="1">Base crème</option>
            <option value="2">Base tomate</option>
            <!-- <option value="3">Végétarienne</option> -->
        </select>
    </div>
</header>

<section class="container d-flex flex-column mt-4">
    <div id="mon-contenu" class="row">
        <?php foreach ($pizzas as $pizza): ?>
            <div class="card mb-3">
                <img src="<?= $pizza['pizza_image'] ?>" class="card-img-top" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $pizza['pizza_nom'] ?></h5>
                    <p class="card-text"><?= $pizza['pizza_description'] ?></p>
                </div>
                <div class="card-footer row">
                    <a href="#" class="btn btn-secondary col-4">Ajouter</a>
                    <a href="#" class="col-2 offset-3 mb-4 mt-3"><i class="bi bi-dash-circle-fill col-2 text-danger h4"></i></a>
                    <span class="col-2 ms-3 mt-3">0</span>
                    <a href="#" class="col-2 mb-4 mt-3"><i class="bi bi-plus-circle-fill col-4 mb-3 mt-3 text-success h4"></i></a>
                    <p class="col-4 offset-4"><?= $pizza['pizza_prix'] ?>€</p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>



<?php
$content = ob_get_clean();
include("layout.php");
?>