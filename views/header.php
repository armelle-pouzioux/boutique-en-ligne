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
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
<header>
    <nav class="navbar">

        <a href="/boutique-en-ligne/index.php" aria-label="Accéder à l'accueil du site"><h1>Cornail&Vernis</h1></a>

        <article class="nav-link">
            <ul>
                <?php if (isset($_SESSION["username"])) : ?>
                    <li><a href="/boutique-en-ligne/views/user/editUser.php" 
                aria-label="Accéder à mon compte"><?php echo $_SESSION["username"] ?></a></li>
                <li class="login"><a href="?action=logout" 
                aria-label="Me déconnecter">Me déconnecter</a></li>
                <?php else: ?>
                    <li class="login"><a href="/boutique-en-ligne/views/user/login.php" 
                aria-label="Accéder à me connecter"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: msFilter"><path d="M7.5 6.5C7.5 8.981 9.519 11 12 11s4.5-2.019 4.5-4.5S14.481 2 12 2 7.5 4.019 7.5 6.5zM20 21h1v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h17z"></path></svg></a></li>
                <?php endif; ?>
            </ul>
        </article>

    </nav>
</header>