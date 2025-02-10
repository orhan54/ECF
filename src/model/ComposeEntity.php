<?php

namespace App\model;

use App\model\AbstractEntity;

class ComposeEntity extends AbstractEntity {
    private int $id_pizza;
    private int $id_ingredient;

    public function getComposePizzaId(): int {
        return $this->id_pizza;
    }

    public function setComposePizzaId(int $id): self {
        $this->id_pizza = $id;
        return $this;
    }

    public function getComposeIngredientId(): int {
        return $this->id_ingredient;
    }

    public function setComposeIngredientId(int $id): self {
        $this->id_ingredient = $id;
        return $this;
    }
}