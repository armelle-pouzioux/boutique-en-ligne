<?php

require_once(__DIR__ . "/../core/Autoloader.php"); 
require_once(__DIR__. '/../model/User.php');



class UserController extends User
{
    public function __construct()
    {
        parent::__construct();
    }

    // login: Validates user credentials and returns user data if valid, or false otherwise
    public function login($email, $password)
    {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->getPdo()->prepare($query);
        $stmt->execute(["email" => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            return $user;
        } 
        return false;
    }

    // registerUser: Registers a new user after validating the input data
    public function registerUser($username, $email, $password, $verifyPassword)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["errorMessage"] = "L'adresse email n'est pas écrite dans un format valide.";
        }

        // Validate the password: at least 8 characters, includes at least one letter and one number
        if (strlen($password) < 8 || !preg_match("/[A-Za-z]/", $password) || !preg_match("/[0-9]/", 
        $password)) {
            $_SESSION["errorMessage"] = "Le mot de passe doit contenir au moins 8 caractères, 
            dont au moins une lettre et un chiffre.";
        }

        // Check if the password and its verification match
        if ($password !== $verifyPassword) {
            $_SESSION["errorMessage"] = "Les mots de passe ne correspondent pas.";
        }

        if (!isset($_SESSION["errorMessage"])) 
        {
            $user = new User;
            $result = $user->register($username, $email, $password);

            if ($result === true && !isset($_SESSION["errorMessage"])) {
                $_SESSION["successMessage"] = "Votre compte a été créé avec succès !";
                header("Location: login.php");
                exit();
            }
            else {
                return false;
            }
        }  
    }

    public function editUser(
        string $newEmail,
        string $newUsername,
        int    $user_id,
        string $oldPassword,
        string $newPassword,
        string $newVerifiedPassword
    ) {
        // 1) Validation e-mail
        if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL)) {
            $_SESSION["errorMessage"] = "L'adresse email n'est pas valide.";
            return false;
        }
    
        // 2) Récupérer l'utilisateur courant (pour le password hash)
        $userModel = new User();
        $current = $userModel->findById($user_id);
        if (!$current) {
            $_SESSION["errorMessage"] = "Utilisateur introuvable.";
            return false;
        }
    
        // 3) Vérifier l'ancien mot de passe
        if (!password_verify($oldPassword, $current['password'])) {
            $_SESSION["errorMessage"] = "Le mot de passe actuel est incorrect.";
            return false;
        }
    
        // 4) Si on veut changer de mot de passe, le valider
        if ($newPassword !== "" || $newVerifiedPassword !== "") {
            if ($newPassword !== $newVerifiedPassword) {
                $_SESSION["errorMessage"] = "Les nouveaux mots de passe ne correspondent pas.";
                return false;
            }
            if (strlen($newPassword) < 8 
                || !preg_match("/[A-Za-z]/", $newPassword) 
                || !preg_match("/[0-9]/", $newPassword)) {
                $_SESSION["errorMessage"] =
                    "Le mot de passe doit faire ≥ 8 caractères, dont une lettre et un chiffre.";
                return false;
            }
            // Hash uniquement si on change
            $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        } else {
            // pas de changement = conserver l'ancien hash
            $hashed = $current['password'];
        }
    
        // 5) On appelle le modèle pour la mise à jour
        $ok = $userModel->update(
            $user_id,
            $newEmail,
            $newUsername,
            $hashed
        );
    
        if ($ok) {
            $_SESSION["username"]       = $newUsername;
            $_SESSION["email"]          = $newEmail;
            $_SESSION["successMessage"] = "Profil mis à jour avec succès !";
            header("Location: /boutique-en-ligne/views/user/edit_profile.php");
            exit;
        } else {
            $_SESSION["errorMessage"] = "Erreur lors de la mise à jour en base.";
            return false;
        }
    }
    
    public function getUserById(int $user_id) {
        // On suppose que tu as un modèle User avec une méthode findById()
        $userModel = new User();
        return $userModel->findById($user_id);
    }
}