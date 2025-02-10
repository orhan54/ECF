<?php

namespace App\model;

use App\model\AbstractEntity;

class BaseEntity extends AbstractEntity {
    private int $id_base;
    private string $nom_base;
    private float $prix_base;

    public function getBaseId(): int {
        return $this->id_base;
    }

    public function setBaseId(int $id): self {
        $this->id_base = $id;
        return $this;
    }

    public function getBaseNom(): string {
        return $this->nom_base;
    }

    public function setBaseNom(string $nom): self {
        $this->nom_base = $nom;
        return $this;
    }

    public function getBasePrix(): float {
        return $this->prix_base;
    }

    public function setBasePrix(float $prix): self {
        $this->prix_base = $prix;
        return $this;
    }
}