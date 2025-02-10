<?php

namespace App\model;

use App\model\AbstractEntity;

class CommandeEntity extends AbstractEntity {
    private int $id_pizza;
    private int $id_client;
    private int $quantite_commande;
    private string $date_commande;

    public function getPizzaId(): int {
        return $this->id_pizza;
    }

    public function setPizzaId(int $id): self {
        $this->id_pizza = $id;
        return $this;
    }
    
    public function getClientId(): int {
        return $this->id_client;
    }

    public function setClientId(int $id): self {
        $this->id_client = $id;
        return $this;
    }

    public function getCommandeQuantite(): int {
        return $this->quantite_commande;
    }

    public function setCommandeQuantite(int $quantite): self {
        $this->quantite_commande = $quantite;
        return $this;
    }

    public function getCommandeDate(): string {
        return $this->date_commande;
    }

    public function setCommandeDate(string $date): self {
        $this->date_commande = $date;
        return $this;
    }
    
}