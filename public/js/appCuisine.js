"use strict";

const commandeRecu = document.getElementById('recu');
const commandeTerminer = document.getElementById('terminer');
const commandeLivrer = document.getElementById('livrer');

function createCommandeElement(pizzaName) {
    let monLi = document.createElement('li');
    let monP = document.createElement('p');
    monP.classList.add("mt-2", "d-flex", "justify-content-between");
    monP.textContent = pizzaName;

    let btnTerminer = document.createElement('button');
    btnTerminer.setAttribute("href", "#");
    btnTerminer.classList.add("btn", "btn-secondary", "ms-2");
    btnTerminer.textContent = ('Terminer');
    btnTerminer.addEventListener('click', () => {
        commandeTerminer.appendChild(monLi);
        btnTerminer.style.display = 'none';
        btnLivrer.style.display = 'inline-block';
    });

    let btnLivrer = document.createElement('button');
    btnLivrer.setAttribute("href", "#");
    btnLivrer.classList.add("btn", "btn-secondary", "ms-2");
    btnLivrer.textContent = ('Terminer');
    btnLivrer.style.display = 'none';
    btnLivrer.addEventListener('click', () => {
        commandeLivrer.appendChild(monLi);
        commandeTerminer.removeChild(monLi);
    });

    monLi.appendChild(monP);
    monP.appendChild(btnTerminer);
    monP.appendChild(btnLivrer);
    return monLi;
}

function afficherCommandeRecu() {
    let monLi1 = createCommandeElement('4 fromage');
    let monLi2 = createCommandeElement('margherita');
    let monLi3 = createCommandeElement('orientale');

    commandeRecu.appendChild(monLi1);
    commandeRecu.appendChild(monLi2);
    commandeRecu.appendChild(monLi3);
}

// Appel de la fonction pour afficher les commandes reçues
afficherCommandeRecu();
