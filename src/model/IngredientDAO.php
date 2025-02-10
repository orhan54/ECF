<?php

namespace App\model;

use App\config\Database;
use App\model\AbstractEntity;
use App\model\ModelException;
use App\model\DAOInterface;
use App\model\IngredientEntity;

class IngredientDAO implements DAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function readAll(): array {
        $sql = 'SELECT * FROM ingredient';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readOne(int $id): IngredientEntity {
        $sql = 'SELECT * FROM ingredient WHERE id_ingredient = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $ingredient = new IngredientEntity();
        $ingredient
            ->setIngredientId($result['id_ingredient'])
            ->setIngredientNom($result['nom_ingredient']);
        return new IngredientEntity();
    }

    public function create(AbstractEntity $ingredient): IngredientEntity {
        if (!$ingredient instanceof IngredientEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'INSERT INTO ingredient (nom_ingredient, prix_ingredient) VALUES (?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $ingredient->getIngredientNom()
        ]);
        
        $ingredient->setIngredientId($this->pdo->lastInsertId());
        return $ingredient;
    }

    public function update(AbstractEntity $entity): bool {
        if (!$entity instanceof IngredientEntity) {
            throw new ModelException("Type d'entité invalidee");
        }

        $sql = 'UPDATE ingredient SET nom_ingredient = ?, prix_ingredient = ? WHERE id_ingredient = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $entity->getIngredientId(),
            $entity->getIngredientNom()
        ]);
        return true;
    }

    public function delete(AbstractEntity $entity): bool {
        if (!$entity instanceof IngredientEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'DELETE FROM ingredient WHERE id_ingredient = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$entity->getIngredientId()]);
        return true;
    }
}