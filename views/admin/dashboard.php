<?php

$pageTitle = "Dashboard - Cornail&Vernis";
require_once(__DIR__ . "/../header.php");

?>

<main class="admin-dashboard">
    <h1>Tableau de bord Admin</h1>
    
    <section class="dashboard-links">
        <a href="../product/addProduct.php" class="button">Ajouter un produit</a>
        <a href="../order/listOrders.php" class="button">Voir les commandes</a>
    </section>
</main>


<?php require_once(__DIR__ . "/../footer.php"); ?>