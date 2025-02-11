<?php

namespace App\model;

use App\config\Database;
use App\model\AbstractEntity;
use App\model\ModelException;
use App\model\DAOInterface;
use App\model\CommandeEntity;

class CommandeDAO implements DAOInterface {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getInstance();
    }

    public function readAll(): array {
        $sql = 'SELECT * FROM commande';
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function readOne(int $id): CommandeEntity {
        $sql = 'SELECT * FROM commande WHERE id_commande = ?';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        $commande = new CommandeEntity();
        $commande
            ->setId($result['id_commande'])
            ->setPizzaId($result['id_pizza'])
            ->setClientId($result['id_client'])
            ->setCommandeQuantite($result['quantite_commande'])
            ->setCommandeDate($result['date_commande']);
        return new CommandeEntity();
    }

    public function create(AbstractEntity $commande): CommandeEntity {
        if (!$commande instanceof CommandeEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'INSERT INTO commande (id_pizza, id_client, quantite_commande, date_commande, ) VALUES (?, ?, ?, ?)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $commande->getPizzaId(),
            $commande->getClientId(),
            $commande->getCommandeQuantite(),
            $commande->getCommandeDate()
        ]);
        
        $commande->setClientId($this->pdo->lastInsertId());
        return $commande;
    }

    public function update(AbstractEntity $entity): bool {
        if (!$entity instanceof CommandeEntity) {
            throw new ModelException("Type d'entité invalidee");
        }

        $sql = 'UPDATE commande SET quantite_commande = ?, date_commande = ? WHERE id_commande = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $entity->getId(),
            $entity->getCommandeQuantite(),
            $entity->getCommandeDate()
        ]);
    }

    public function delete(AbstractEntity $entity): bool {
        if (!$entity instanceof CommandeEntity) {
            throw new ModelException("Type d'entité invalide");
        }

        $sql = 'DELETE FROM commande WHERE id_commande = ?';
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$entity->getClientId()]);
    }
}