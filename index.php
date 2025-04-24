<?php

$pageTitle = "QuizNight ! - Accueil";
require_once 'views/header.php';

if (isset($_SESSION['success'])) {
    echo '<p class="message success">' . htmlspecialchars($_SESSION['success']) . '</p>';
    unset($_SESSION['success']); 
}
?>

<?php require_once 'views\footer.php'; ?>