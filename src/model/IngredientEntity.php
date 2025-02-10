<?php

namespace App\model;

use App\model\AbstractEntity;

class IngredientEntity extends AbstractEntity {
    private int $id_ingredient;
    private string $nom_ingredient;

    public function getIngredientId(): int {
        return $this->id_ingredient;
    }

    public function setIngredientId(int $id): self {
        $this->id_ingredient = $id;
        return $this;
    }

    public function getIngredientNom(): string {
        return $this->nom_ingredient;
    }

    public function setIngredientNom(string $nom): self {
        $this->nom_ingredient = $nom;
        return $this;
    }
}