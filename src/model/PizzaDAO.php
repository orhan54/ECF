<?php

namespace App\model;

use App\config\Database;
use App\model\AbstractEntity;
use App\model\ModelException;
use App\model\DAOInterface;
use App\model\PizzaEntity;

class PizzaDAO implements DAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function readAll(): array {
        $sql = 'SELECT * FROM pizza';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readOne(int $id): PizzaEntity {
        $sql = 'SELECT * FROM pizza WHERE id_pizza = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $pizza = new PizzaEntity();
        $pizza
            ->setPizzaId($result['id_pizza'])
            ->setPizzaNom($result['nom_pizza'])
            ->setPizzaPrix($result['prix_pizza'])
            ->setPizzaBase($result['id_base']);
        return new PizzaEntity();
    }

    public function create(AbstractEntity $pizza): PizzaEntity {
        if (!$pizza instanceof PizzaEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'INSERT INTO pizza (nom_pizza, prix_pizza, id_base) VALUES (?, ?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $pizza->getPizzaNom(), 
            $pizza->getPizzaPrix(), 
            $pizza->getPizzaBase()
        ]);
        
        $pizza->setPizzaId($this->pdo->lastInsertId());
        return $pizza;
    }

    public function update(AbstractEntity $entity): bool {
        if (!$entity instanceof PizzaEntity) {
            throw new ModelException("Type d'entité invalidee");
        }

        $sql = 'UPDATE pizza SET nom_pizza = ?, prix_pizza = ?, id_base = ? WHERE id_pizza = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $entity->getPizzaNom(), 
            $entity->getPizzaPrix(), 
            $entity->getPizzaBase(), 
            $entity->getPizzaId()
        ]);
    }

    public function delete(AbstractEntity $entity): bool {
        if (!$entity instanceof PizzaEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'DELETE FROM pizza WHERE id_pizza = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$entity->getPizzaId()]);
    }
}