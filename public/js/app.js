"use strict";

let tabJson = [];
let totalAPayer = 0;

// Creation des const pour mon html
const monContenu = document.getElementById('mon-contenu');
const monFiltre = document.getElementById('pizzaFiltreValue');
const votrePanier = document.getElementById('votrePanier');
const totalElement = document.getElementById('totalAPayer');
const creerCompteBtn = document.getElementById('creerCompteBtn');
const annulerBtn = document.getElementById('annulerBtn');
const additionalFields = document.getElementById('additionalFields');

// recuperation des donnees json en retour d'un tableau
(async function recuperDonnees() {
    let response = await fetch('PHP/ECF/ECF/src/index.php?route=pizzas');
    let dataJson = await response.json();
    tabJson = dataJson;
    afficherContenu(tabJson);
}());

// creation des cards avec les donnes recuperer de mon tableau de donnees json avec la function(async recupererDonnees)
function afficherContenu(dataJson) {
    monContenu.innerHTML = ""; // Vider le conteneur avant d'ajouter les nouvelles cartes

    for (let i = 0; i < dataJson.length; i++) {
        const maCard = document.createElement('div');
        let monImageCard = document.createElement('img');
        monImageCard.setAttribute("src", dataJson[i].pizza_image);
        monImageCard.setAttribute("alt", "Card image cap");
        let monCardBody = document.createElement('div'); //ma div de ma card avec le titre H5, son paragraphe et le boutton de ma card
        let monH5Card = document.createElement('h5');
        monH5Card.textContent = (dataJson[i].pizza_nom);
        let monParaCard = document.createElement('p');
        monParaCard.textContent = (dataJson[i].pizza_description);
        let monFooterCard = document.createElement('div');
        let monACard = document.createElement('a');
        monACard.setAttribute("href", "#");
        monACard.setAttribute("data-index", i);
        monACard.textContent = ('Ajouter');
        let moinsAPizza = document.createElement('a');
        let moinsCard = document.createElement('i');
        moinsAPizza.setAttribute("id", "compt-moins");
        let nombrePizza = document.createElement('span');
        nombrePizza.textContent = ('0');
        nombrePizza.setAttribute("id", `compteur-${i}`);
        let plusAPizza = document.createElement('a');
        plusAPizza.setAttribute("id", "compt-plus");
        let plusCard = document.createElement('i');
        let prixCard = document.createElement('p');
        prixCard.textContent = (dataJson[i].pizza_prix + "€");

        maCard.classList.add("card");
        maCard.classList.add("mb-3");
        monImageCard.classList.add("card-img-top");
        monCardBody.classList.add("card-body");
        monH5Card.classList.add("card-title");
        monParaCard.classList.add("card-text");
        monFooterCard.classList.add("card-footer", "row");
        monACard.classList.add("btn", "btn-secondary", "col-4");
        moinsAPizza.classList.add("col-2", "offset-3", "mb-4", "mt-3");
        moinsCard.classList.add("bi", "bi-dash-circle-fill", "col-2", "text-danger", "h4");
        nombrePizza.classList.add("col-2", "ms-3", "mt-3");
        plusAPizza.classList.add("col-2", "mb-4", "mt-3");
        plusCard.classList.add("bi", "bi-plus-circle-fill", "col-4", "mb-3", "mt-3", "text-success", "h4");
        prixCard.classList.add("col-4", "offset-4");

        monContenu.appendChild(maCard);
        maCard.appendChild(monImageCard);
        maCard.appendChild(monCardBody);
        monCardBody.appendChild(monH5Card);
        monCardBody.appendChild(monParaCard);
        maCard.appendChild(monFooterCard);
        monFooterCard.appendChild(moinsAPizza);
        moinsAPizza.appendChild(moinsCard);
        monFooterCard.appendChild(nombrePizza);
        monFooterCard.appendChild(plusAPizza);
        plusAPizza.appendChild(plusCard);
        monFooterCard.appendChild(monACard);
        monFooterCard.appendChild(prixCard);

        let count = 0;
        const counterElement = document.getElementById(`compteur-${i}`);

        moinsAPizza.addEventListener('click', () => {
            if (count > 0) {
                count--;
                updateCount(counterElement, count);
            }
        });

        plusCard.addEventListener('click', () => {
            count++;
            updateCount(counterElement, count);
        });

        monACard.addEventListener('click', (event) => {
            event.preventDefault();
            ajouterAuPanier(dataJson[i].pizza_nom, count, dataJson[i].pizza_prix);
        });
    }
}

function updateCount(counterElement, count) {
    counterElement.textContent = count;
}

function ajouterAuPanier(pizzaName, quantite, prix) {
    if (quantite > 0) {
        const li = document.createElement('li');
        li.textContent = `${pizzaName} x${quantite} - ${prix * quantite}€`;
        votrePanier.appendChild(li);

        totalAPayer += prix * quantite;
        totalElement.textContent = `Montant total à régler: ${totalAPayer.toFixed(2)}€`;
    }
}

// Ajout de l'événement change pour le filtre
monFiltre.addEventListener('change', filtrePizza);

// filtre option des choix de bases pizza
function filtrePizza(event) {
    let valuePizza = monFiltre.value;
    if (valuePizza === "all") {
        afficherContenu(tabJson);
    } else {
        let tabDonnees = tabJson.filter(pizza => pizza.base === valuePizza);
        afficherContenu(tabDonnees);
    }
}

// Ajout de l'événement click pour le bouton "Créer compte"
creerCompteBtn.addEventListener('click', () => {
    additionalFields.style.display = 'block';
    annulerBtn.style.display = 'inline-block';
});

// Ajout de l'événement click pour le bouton "Annuler"
annulerBtn.addEventListener('click', () => {
    additionalFields.style.display = 'none';
    creerCompteBtn.style.display = 'inline-block';
    document.getElementById('connexionForm').reset();
});