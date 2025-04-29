<?php

require_once(__DIR__ . "/../core/Autoloader.php"); 
require_once(__DIR__ . "/../controllers/UserController.php");

$userController = new UserController;

$session = new Session;
$session->startSession();
if (isset($_GET["action"]) && $_GET["action"] === "logout") {
    $session->logOut();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Cornail&Vernis.">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="author" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/boutique-en-ligne/assets/style.css?v=<?php echo time(); ?>">
    <script src="/boutique-en-ligne/assets/header.js" defer></script>
    <title><?php echo $pageTitle; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&family=Hubot+Sans:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">
</head>

<body>
    <header class="header">
        <div class="header-container">
            <h1 class="logo">Cornail&Vernis</h1>

            <div class="header-menu">

                <button class="search-icon" aria-label="Recherche">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: msFilter"><path d="M10 18a7.952 7.952 0 0 0 4.897-1.688l4.396 4.396 1.414-1.414-4.396-4.396A7.952 7.952 0 0 0 18 10c0-4.411-3.589-8-8-8s-8 3.589-8 8 3.589 8 8 8zm0-14c3.309 0 6 2.691 6 6s-2.691 6-6 6-6-2.691-6-6 2.691-6 6-6z"></path></svg>
                </button>

                <div class="search-container hidden">
                <input type="text" id="search-input" placeholder="Rechercher un produit...">
                <button id="search-btn">Rechercher</button>
                </div>

                <button class="burger-menu" aria-label="Menu">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: msFilter"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg>
                </button>

                <a href="/boutique-en-ligne/views/user/login.php" aria-label="Accéder à me connecter" class="login-burger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: msFilter"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg></a>
            </div>
        </div>

        <nav class="nav-menu hidden">
            <ul>
            <li><a href="#">Accueil</a></li>
            <li><a href="index.php?page=product&action=list">Boutique</a></li>
            <li><a href="index.php?page=cart&action=view">Panier</a></li>
            <li><a href="#">Contact</a></li>
            <li><a href="/boutique-en-ligne/views/user/login.php" aria-label="Accéder à me connecter" class="login-nav">Se connecter</a></li>
            </ul>
        </nav>
    </header>
</body>