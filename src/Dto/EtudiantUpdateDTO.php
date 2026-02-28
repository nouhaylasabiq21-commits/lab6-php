<?php

declare(strict_types = 1);

namespace App\Dto;

class EtudiantUpdateDTO {

    private $id;        // int
    private $nom;       // string
    private $prenom;    // string
    private $email;     // string
    private $filiereId; // int

    public function __construct(int $id, string $nom, string $prenom, string $email, int $filiereId) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->filiereId = $filiereId;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFiliereId() {
        return $this->filiereId;
    }

}
