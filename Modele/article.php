<?php

class Article {
    // Propriétés de la classe
    private $id;
    private $nom;
    private $categorie;
    private $prix;
    private $description;
    private $stock;
    private $photo;

   

    // Getter pour la propriété id
    public function getId() {
        return $this->id;
    }

    // Setter pour la propriété id
    public function setId($id) {
        $this->id = $id;
    }

    // Getter pour la propriété nom
    public function getNom() {
        return $this->nom;
    }

    // Setter pour la propriété nom
    public function setNom($nom) {
        $this->nom = $nom;
    }

    // Getter pour la propriété categorie
    public function getCategorie() {
        return $this->categorie;
    }

    // Setter pour la propriété categorie
    public function setCategorie($categorie) {
        $this->categorie = $categorie;
    }

    // Getter pour la propriété prix
    public function getPrix() {
        return $this->prix;
    }

    // Setter pour la propriété prix
    public function setPrix($prix) {
        $this->prix = $prix;
    }

    // Getter pour la propriété description
    public function getDescription() {
        return $this->description;
    }

    // Setter pour la propriété description
    public function setDescription($description) {
        $this->description = $description;
    }

    // Getter pour la propriété stock
    public function getStock() {
        return $this->stock;
    }

    // Setter pour la propriété stock
    public function setStock($stock) {
        $this->stock = $stock;
    }

    // Getter pour la propriété photo
    public function getPhoto() {
        return $this->photo;
    }

    // Setter pour la propriété photo
    public function setPhoto($photo) {
        $this->photo = $photo;
    }
}
