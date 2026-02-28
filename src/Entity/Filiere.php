<?php

declare(strict_types = 1);

namespace App\Entity;

class Filiere {

    private $id;      // int|null (auto)
    private $code;    // string unique
    private $libelle; // string

    public function __construct($id, string $code, string $libelle) {
        $this->id = $id;
        $this->setCode($code);
        $this->setLibelle($libelle);
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCode() {
        return $this->code;
    }

    public function setCode(string $code) {
        $code = trim($code);
        if ($code === '') {
            throw new \InvalidArgumentException('code requis');
        }
        $this->code = $code;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function setLibelle(string $libelle) {
        $libelle = trim($libelle);
        if ($libelle === '') {
            throw new \InvalidArgumentException('libellé requis');
        }
        $this->libelle = $libelle;
    }

}
