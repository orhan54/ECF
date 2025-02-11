<?php

namespace App\model;

use App\config\Database;
use App\model\AbstractEntity;
use App\model\ModelException;
use App\model\DAOInterface;

class ImageDAO implements DAOInterface {

    /**
     * Ajoute un client en BDD
     * @param AbstractEntity $entity Instance contenant les informations de l'image
     * @return AbstractEntity
     * @throws ModelException Dans le cas où l'enregistrement a rencontré une erreur
     */
    public function create(AbstractEntity $entity): AbstractEntity {
        /** @var ImageEntity $image */
        $image = $entity;
        try {
            $db = Database::getInstance();
            $req = $db->prepare("INSERT INTO `image` (chemin_image, description_image) VALUES (?, ?)");
            $req->execute([
                $image->getCheminImage(),
                $image->getDescriptionImage()
            ]);
            $image->setId($db->lastInsertId());
            return $image;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de l'ajout de l'image en BDD: " . $e->getMessage());
        }
    }

    /**
     * Lit les informations d'une image en BDD
     * @param int $id Identifiant de l'image
     * @return AbstractEntity
     * @throws ModelException
     */
    public function readOne(int $id): AbstractEntity {
        try {
            $db = Database::getInstance();
            $req = $db->prepare("SELECT * FROM `image` WHERE id_image = ?");
            $req->execute([$id]);
            $result = $req->fetch(\PDO::FETCH_ASSOC);
            if (!$result) {
                throw new ModelException("Aucune image trouvée avec l'identifiant $id");
            }
            $image = new ImageEntity();
            $image
                ->setId($result['id_image'])
                ->setCheminImage($result['chemin_image'])
                ->setDescriptionImage($result['description_image']);
            return $image;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture de l'image en BDD: " . $e->getMessage());
        }
    }

    /**
     * Lit toutes les images en BDD
     * @return array
     * @throws ModelException
     */
    public function readAll(): array {
        try {
            $db = Database::getInstance();
            $req = $db->query("SELECT * FROM `image`");
            $result = $req->fetchAll(\PDO::FETCH_ASSOC);
            $images = [];
            foreach ($result as $data) {
                $image = new ImageEntity();
                $image
                    ->setId($data['id_image'])
                    ->setCheminImage($data['chemin_image'])
                    ->setDescriptionImage($data['description_image']);
                $images[] = $image;
            }
            return $images;
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la lecture des images en BDD: " . $e->getMessage());
        }
    }

    /**
     * Met à jour les informations d'une image en BDD
     * @param AbstractEntity $entity Instance contenant les informations de l'image
     * @return bool
     * @throws ModelException
     */
    public function update(AbstractEntity $entity): bool {
        /** @var ImageEntity $image */
        $image = $entity;
        try {
            $db = Database::getInstance();
            $req = $db->prepare("UPDATE `image` SET 
                chemin_image = ?, 
                description_image = ?
                WHERE id_image = ?");
            return $req->execute([
                $image->getCheminImage(),
                $image->getDescriptionImage(),
                $image->getId()
            ]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la mise à jour de l'image en BDD: " . $e->getMessage());
        }   
    }

    /**
     * Supprime une image de la BDD
     * @param AbstractEntity $entity Instance contenant les informations de l'image
     * @return bool
     * @throws ModelException
     */
    public function delete(AbstractEntity $entity): bool {
        /** @var ImageEntity $image */
        $image = $entity;
        try {
            $db = Database::getInstance();
            $req = $db->prepare("DELETE FROM `image` WHERE id_image = ?");
            return $req->execute([$image->getId()]);
        } catch (\PDOException $e) {
            throw new ModelException("Erreur lors de la suppression de l'image en BDD: " . $e->getMessage());
        }
    }
}
