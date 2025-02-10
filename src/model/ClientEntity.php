<?php

namespace App\model;

class ClientEntity extends AbstractEntity {
    private int $id;
    private string $clientEmail;
    private string $password;
    private string $clientNom;
    private string $clientPrenom;
    private string $clientTelephone;
    private string $clientAdresse;
    private string $clientVille;

    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }

    public function getId() {
        return $this->id;
    }

    public function getClientEmail(): string {
        return $this->clientEmail;
    }

    public function setClientEmail(string $clientEmail): self {
        $this->clientEmail = $clientEmail;
        return $this;
    }

    public function getClientPassword(): string {
        return $this->password;
    }

    public function setClientPassword(string $password): self {
        $this->password = $password;
        return $this;
    }

    public function getClientNom(): string {
        return $this->clientNom;
    }

    public function setClientNom(string $clientNom): self {
        $this->clientNom = $clientNom;
        return $this;
    }

    public function getClientPrenom(): string {
        return $this->clientPrenom;
    }

    public function setClientPrenom(string $clientPrenom): self {
        $this->clientPrenom = $clientPrenom;
        return $this;
    }

    public function getClientTelephone(): string {
        return $this->clientTelephone;
    }

    public function setClientTelephone(string $clientTelephone): self {
        $this->clientTelephone = $clientTelephone;
        return $this;
    }

    public function getClientAdresse(): string {
        return $this->clientAdresse;
    }

    public function setClientAdresse(string $clientAdresse): self {
        $this->clientAdresse = $clientAdresse;
        return $this;
    }

    public function getClientVille(): string {
        return $this->clientVille;
    }

    public function setClientVille(string $clientVille): self {
        $this->clientVille = $clientVille;
        return $this;
    }
}