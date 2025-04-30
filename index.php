<?php

$pageTitle = "Cornail&Vernis";
require_once(__DIR__ . "/views/header.php");

?>

<main>

    <?php if (isset($_SESSION["successMessage"])) : ?>
        <p class="message-success"><?php echo $_SESSION["successMessage"] ; ?></p>
        <?php unset($_SESSION["successMessage"]); ?>
    <?php endif; ?>
    
</main>

<?php require_once(__DIR__ . "/views/footer.php"); ?>