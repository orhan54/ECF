<?php

namespace App\model;

use App\config\Database;
use App\model\AbstractEntity;
use App\model\ModelException;
use App\model\DAOInterface;
use App\model\ComposeEntity;

class ComposeDAO implements DAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function readAll(): array {
        $sql = 'SELECT * FROM compose';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readOne(int $id): ComposeEntity {
        $sql = 'SELECT * FROM compose WHERE id_pizza = ? AND id_ingredient = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $compose = new ComposeEntity();
        $compose
            ->setComposePizzaId($result['id_pizza'])
            ->setComposeIngredientId($result['id_ingredient']);
        return new ComposeEntity();
    }

    public function create(AbstractEntity $compose): ComposeEntity {
        if (!$compose instanceof ComposeEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'INSERT INTO compose (id_pizza, id_ingredient) VALUES (?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $compose->getComposePizzaId(),
            $compose->getComposeIngredientId()
        ]);
        
        $compose->setComposePizzaId($this->pdo->lastInsertId());
        return $compose;
    }

    public function update(AbstractEntity $entity): bool {
        if (!$entity instanceof ComposeEntity) {
            throw new ModelException("Type d'entité invalidee");
        }

        $sql = 'UPDATE compose SET id_pizza = ?, id_ingredient = ? WHERE id_pizza = ? AND id_ingredient = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $entity->getComposePizzaID(),
            $entity->getComposeIngredientID()
        ]);
    }

    public function delete(AbstractEntity $entity): bool {
        if (!$entity instanceof ComposeEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'DELETE FROM compose WHERE id_pizza = ? AND id_ingredient = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$entity->getComposePizzaId(), $entity->getComposeIngredientId()]);
    }
}