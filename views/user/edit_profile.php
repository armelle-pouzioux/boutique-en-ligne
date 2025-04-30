<?php

$pageTitle = "Modifier mon profil";
require_once(__DIR__ . "/../header.php");



$email = $password = "";
$error = "";

if (!isset($_SESSION['user_id'])) {
    header("Location: ./login.php");
    exit;
} else {$_SESSION["successMessage"] = "Bienvenue " . $_SESSION["username"] . " !";

}

// Pré-remplissage du formulaire avec les données actuelles
$currentUser = $userController->getUserById($_SESSION['user_id']);
$email = $currentUser["email"] ?? "";
$username = $currentUser["username"] ?? "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $username = htmlspecialchars(trim($_POST["username"]));
    $password = trim($_POST["password"]);
    $verifyPassword = trim($_POST["verifyPassword"]);

    $result = $userController->updateUserProfile($_SESSION["user_id"], $username, $email, $password, $verifyPassword);
}


?>

<main>
    <?php if (isset($_SESSION["successMessage"])) : ?>
        <p class="message-success"><?php echo $_SESSION["successMessage"] ; ?></p>
        <?php unset($_SESSION["successMessage"]); ?>
    <?php endif; ?>

    <?php if (!empty($error)) : ?>
        <p class="message error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (isset($_SESSION["errorMessage"])) : ?>
        <p class="message error"><?php echo $_SESSION["errorMessage"]; ?></p>
        <?php unset($_SESSION["errorMessage"]); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION["successMessage"])) : ?>
        <p class="message success"><?php echo $_SESSION["successMessage"]; ?></p>
        <?php unset($_SESSION["successMessage"]); ?>
    <?php endif; ?>

    <form action="" method="POST" class="form">
        <h2>Modifier mon profil</h2>

        <section class="formBody">
            <article class="formItem">
                <label for="email">Adresse email:</label>
                <input type="email" id="email" name="email" placeholder="Adresse email" required
                value="<?= htmlspecialchars($email); ?>">
            </article>

            <article class="formItem">
                <label for="username">Nom d'utilisateur: </label>
                <input type="text" id="username" name="username" placeholder="Nom d'utilisateur"
                required value="<?= htmlspecialchars($username); ?>">
            </article>

            <article class="formItem">
                <label for="password">Nouveau mot de passe (laisser vide si inchangé):</label>
                <input type="password" id="password" name="password"
                placeholder="8 caractères minimum dont une lettre et un chiffre">
            </article>

            <article class="formItem">
                <label for="verifyPassword">Confirmer le mot de passe:</label>
                <input type="password" id="verifyPassword" name="verifyPassword"
                placeholder="Vérifier le mot de passe">
            </article>

            <input type="submit" value="Mettre à jour" class="button jump">

            <a href="./dashboard.php" class="formLink" aria-label="Retour tableau de bord">Retour au tableau de bord
            <i class="fa-solid fa-arrow-left"></i>
        </section>
    </form>
</main>

</main>


<?php require_once(__DIR__ . "/../footer.php"); ?>