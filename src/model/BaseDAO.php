<?php

namespace App\model;

use App\config\Database;
use App\model\AbstractEntity;
use App\model\ModelException;
use App\model\DAOInterface;
use App\model\BaseEntity;

class BaseDAO implements DAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function readAll(): array {
        $sql = 'SELECT * FROM base';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readOne(int $id): BaseEntity {
        $sql = 'SELECT * FROM base WHERE id_base = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $base = new BaseEntity();
        $base
            ->setBaseId($result['id_base'])
            ->setBaseNom($result['nom_base'])
            ->setBasePrix($result['prix_base']);
        return new BaseEntity();
    }

    public function create(AbstractEntity $base): BaseEntity {
        if (!$base instanceof BaseEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'INSERT INTO base (nom_base, prix_base) VALUES (?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $base->getBaseNom(), 
            $base->getBasePrix()
        ]);
        
        $base->setBaseId($this->pdo->lastInsertId());
        return $base;
    }

    public function update(AbstractEntity $entity): bool {
        if (!$entity instanceof BaseEntity) {
            throw new ModelException("Type d'entité invalidee");
        }

        $sql = 'UPDATE base SET nom_base = ?, prix_base = ? WHERE id_base = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $entity->getBaseNom(),
            $entity->getBasePrix(),
            $entity->getBaseId()
        ]);
        return true;
    }

    public function delete(AbstractEntity $entity): bool {
        if (!$entity instanceof BaseEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'DELETE FROM base WHERE id_base = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$entity->getBaseId()]);
        return true;
    }
}