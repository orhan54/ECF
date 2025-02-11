<?php

namespace App\model;

use App\config\Database;
use App\model\AbstractEntity;
use App\model\ModelException;
use App\model\DAOInterface;

class ClientDAO implements DAOInterface {  // Correction: implements DAOInterface au lieu de AbstractEntity

    /**
     * Ajoute un client en BDD
     * @param AbstractEntity $entity Instance contenant les informations du client
     * @return AbstractEntity
     * @throws ModelException Dans le cas où l'enregistrement a rencontré une erreur
     */
    public function create(AbstractEntity $entity): AbstractEntity {
        /** @var ClientEntity $client */
        $client = $entity;
        try {
            $db = Database::getInstance();
            $req = $db->prepare("INSERT INTO `client` (
                email_client, 
                mot_de_passe_client, 
                nom_client,
                prenom_client, 
                telephone_client,
                adresse_client, 
                ville_client
            ) VALUES (?, ?, ?, ?, ?, ?, ?)");
            
            $hashedPassword = password_hash($client->getClientPassword(), PASSWORD_DEFAULT);
            
            $done = $req->execute([
                $client->getClientEmail(),
                $hashedPassword,
                $client->getClientNom(),
                $client->getClientPrenom(),
                $client->getClientTelephone(),
                $client->getClientAdresse(),
                $client->getClientVille()
            ]);
            
            if (!$done) {
                throw new ModelException("Erreur lors de l'enregistrement du client en BDD");
            }
            
            $client->setId($db->lastInsertId());
            return $client;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de l'enregistrement du client en BDD: " . $e->getMessage());
        }
    }

    /**
     * Lit les informations d'un client en BDD
     * @param int $id Identifiant du client
     * @return AbstractEntity
     * @throws ModelException
     */
    public function readOne(int $id): AbstractEntity { 
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM `client` WHERE id_client = ?");
            $query->execute([$id]);
            $data = $query->fetch(\PDO::FETCH_ASSOC);
            
            if (!$data) {
                throw new ModelException("Aucun client ne correspond à l'identifiant fourni");
            }
            
            $client = new ClientEntity();
            $client
                ->setId($data['id_client'])
                ->setClientEmail($data['email_client'])
                ->setClientPassword($data['mot_de_passe_client'])
                ->setClientNom($data['nom_client'])
                ->setClientPrenom($data['prenom_client'])
                ->setClientTelephone($data['telephone_client'])
                ->setClientAdresse($data['adresse_client'])
                ->setClientVille($data['ville_client']);
                
            return $client;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture du client en BDD: " . $e->getMessage());
        }
    }

    /**
     * Récupère tous les clients
     * @return array
     * @throws ModelException
     */
    public function readAll(): array {  // Correction: arraay -> array
        try {
            $db = Database::getInstance();
            $query = $db->prepare("SELECT * FROM `client`
                                    JOIN commande
                                    ON client.id_client = commande.id_client
                                    JOIN pizza
                                    ON commande.id_pizza = pizza.id_pizza");
            $query->execute();
            
            return $query->fetchAll(\PDO::FETCH_CLASS, ClientEntity::class);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture des clients en BDD: " . $e->getMessage());
        }
    }

    /**
     * Met à jour un client
     * @param AbstractEntity $entity
     * @return bool
     * @throws ModelException
     */
    public function update(AbstractEntity $entity): bool {
        /** @var ClientEntity $client */
        $client = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("UPDATE `client` SET 
                email_client = ?,
                nom_client = ?,
                prenom_client = ?,
                telephone_client = ?,
                adresse_client = ?,
                ville_client = ?
                WHERE id_client = ?");
                
            return $query->execute([
                $client->getClientEmail(),
                $client->getClientNom(),
                $client->getClientPrenom(),
                $client->getClientTelephone(),
                $client->getClientAdresse(),
                $client->getClientVille(),
                $client->getId()
            ]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la mise à jour du client: " . $e->getMessage());
        }
    }

    /**
     * Supprime un client
     * @param AbstractEntity $entity
     * @return bool
     * @throws ModelException
     */
    public function delete(AbstractEntity $entity): bool {
        /** @var ClientEntity $client */
        $client = $entity;
        try {
            $db = Database::getInstance();
            $query = $db->prepare("DELETE FROM `client` WHERE id_client = ?");
            return $query->execute([$client->getId()]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la suppression du client: " . $e->getMessage());
        }
    }

    /**
     * Vérifie les identifiants de connexion d'un client
     * @param string $email Email du client
     * @param string $password Mot de passe du client
     * @return ClientEntity
     * @throws ModelException
     */
    public function login(string $email, string $password): ClientEntity {
        try {
            $db = Database::getInstance();
            $req = $db->prepare("SELECT * FROM `client` WHERE email_client = ?");
            $req->execute([$email]);
            $data = $req->fetch(\PDO::FETCH_ASSOC);
            
            if (!$data) {
                throw new ModelException("Identifiants incorrects");
            }
            
            if (!password_verify($password, $data['mot_de_passe_client'])) {
                throw new ModelException("Identifiants incorrects");
            }
            
            $client = new ClientEntity();
            $client
                ->setId($data['id_client'])
                ->setClientEmail($data['email_client'])
                ->setClientPassword($data['mot_de_passe_client'])
                ->setClientNom($data['nom_client'])
                ->setClientPrenom($data['prenom_client'])
                ->setClientTelephone($data['telephone_client'])
                ->setClientAdresse($data['adresse_client'])
                ->setClientVille($data['ville_client']);
                
            return $client;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la connexion du client: " . $e->getMessage());
        }
    }
}