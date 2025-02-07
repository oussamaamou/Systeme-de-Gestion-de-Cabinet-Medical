<?php

namespace App\Models;

use Core\Database;

class Utilisateur {
    private $db;
    private $nom;
    private $prenom;
    private $email;
    private $mot_de_passe;
    private $telephone;
    private $role;
    private $photo;
    private $etat;

    public function __construct() {
        $this->db = Database::getInstance();
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

    public function getTelephone() {
        return $this->telephone;
    }

    public function getRole() {
        return $this->role;
    }

    public function getPhoto() {
        return $this->photo;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMotDePasse($mot_de_passe) {
        $this->mot_de_passe = password_hash($mot_de_passe, PASSWORD_DEFAULT); 
    }

    public function setTelephone($telephone) {
        $this->telephone = $telephone;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function inscrire() {
        $sql = "INSERT INTO utilisateurs (Nom, Prenom, Email, Mot_de_passe, Telephone, Role, Photo, Etat)
                VALUES (:nom, :prenom, :email, :mot_de_passe, :telephone, :role, :photo, :etat)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':nom' => $this->nom,
            ':prenom' => $this->prenom,
            ':email' => $this->email,
            ':mot_de_passe' => $this->mot_de_passe,
            ':telephone' => $this->telephone,
            ':role' => $this->role,
            ':photo' => $this->photo,
            ':etat' => $this->etat
        ]);
        return $stmt->rowCount() > 0;
    }

    public function connecter($email, $mot_de_passe) {
        $sql = "SELECT * FROM utilisateurs WHERE Email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();

        if ($user && password_verify($mot_de_passe, $user['Mot_de_passe'])) {
            
            $this->nom = $user['Nom'];
            $this->prenom = $user['Prenom'];
            $this->email = $user['Email'];
            $this->telephone = $user['Telephone'];
            $this->role = $user['Role'];
            $this->photo = $user['Photo'];
            $this->etat = $user['Etat'];
            return $this; 
        }
        return false; 
    }
}