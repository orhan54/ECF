<?php

namespace App\model;

use App\model\AbstractEntity;

class PizzaEntity extends AbstractEntity {
    private int $id_pizza;
    private string $nom_pizza;
    private float $prix_pizza;
    private string $id_base;

    public function getPizzaId(): int {
        return $this->id_pizza;
    }

    public function setPizzaId(int $id): self {
        $this->id_pizza = $id;
        return $this;
    }

    public function getPizzaNom(): string {
        return $this->nom_pizza;
    }

    public function setPizzaNom(string $nom): self {
        $this->nom_pizza = $nom;
        return $this;
    }

    public function getPizzaPrix(): float {
        return $this->prix_pizza;
    }

    public function setPizzaPrix(float $prix): self {
        $this->prix_pizza = $prix;
        return $this;
    }

    public function getPizzaBase(): string {
        return $this->id_base;
    }

    public function setPizzaBase(int $id_base): self {
        $this->id_base = $id_base;
        return $this;
    }
}