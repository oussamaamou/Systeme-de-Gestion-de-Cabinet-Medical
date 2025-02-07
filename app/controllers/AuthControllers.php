<?php

namespace App\Controllers;

use App\Models\Utilisateur;

class AuthController {
    public function index() {
        include __DIR__ . '/../views/auth/index.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $utilisateur = new Utilisateur();
            $user = $utilisateur->connecter($email, $password);

            if ($user) {

                session_start();
                $_SESSION['user'] = [
                    'nom' => $user->getNom(),
                    'prenom' => $user->getPrenom(),
                    'email' => $user->getEmail(),
                    'role' => $user->getRole()
                ];
                header('Location: index.php');
                exit();
            } else {
                echo "Email ou mot de passe incorrect.";
            }
        } else {
            include __DIR__ . '/../views/auth/login.php';
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($_POST['nom']);
            $utilisateur->setPrenom($_POST['prenom']);
            $utilisateur->setEmail($_POST['email']);
            $utilisateur->setMotDePasse($_POST['password']);
            $utilisateur->setTelephone($_POST['telephone']);
            $utilisateur->setRole($_POST['role']);
            $utilisateur->setPhoto('');
            $utilisateur->setEtat('Normal');

            if ($utilisateur->inscrire()) {
                header('Location: login.php');
                exit();
            } else {
                echo "Erreur lors de l'inscription.";
            }
        } else {
            include __DIR__ . '/../views/auth/inscription.php';
        }
    }
}