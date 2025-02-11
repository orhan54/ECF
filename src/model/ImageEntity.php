<?php

namespace App\model;

class ImageEntity extends AbstractEntity {
    private int $id_image;
    private string $cheminImage;
    private string $descriptionImage;

    public function getId(): int {
        return $this->id_image;
    }

    public function setId(int $id): self {
        $this->id_image = $id;
        return $this;
    }

    public function getCheminImage(): string {
        return $this->cheminImage;
    }

    public function setCheminImage(string $chemin): self {
        $this->cheminImage = $chemin;
        return $this;
    }

    public function getDescriptionImage(): string {
        return $this->descriptionImage;
    }

    public function setDescriptionImage(string $description): self {
        $this->descriptionImage = $description;
        return $this;
    }
}