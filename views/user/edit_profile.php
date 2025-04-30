<?php
$pageTitle = "Modifier mon profil";
require_once(__DIR__ . "/../header.php");

// redirection si non connecté
if (!isset($_SESSION['id'])) {
    header("Location: ./login.php");
    exit;
}

// récupération des données pour pré-remplir
$currentUser = $userController->getUserById($_SESSION['id']);
$email    = $currentUser["email"];
$username = $currentUser["username"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email            = trim($_POST["email"]);
    $username         = htmlspecialchars(trim($_POST["username"]));
    $oldPassword      = trim($_POST["oldPassword"]);
    $newPassword      = trim($_POST["password"]);
    $verifyPassword   = trim($_POST["verifyPassword"]);

    $userController->editUser(
        $email,
        $username,
        $_SESSION["id"],
        $oldPassword,
        $newPassword,
        $verifyPassword
    );
}
?>

<main>
    <?php if (isset($_SESSION["successMessage"])): ?>
      <p class="message-success"><?= $_SESSION["successMessage"]; unset($_SESSION["successMessage"]); ?></p>
    <?php endif; ?>
    <?php if (isset($_SESSION["errorMessage"])): ?>
      <p class="message-error"><?= $_SESSION["errorMessage"]; unset($_SESSION["errorMessage"]); ?></p>
    <?php endif; ?>

    <form method="POST" class="form">
      <!-- email & username -->
      <article class="formItem">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required>
      </article>
      <article class="formItem">
        <label for="username">Nom d'utilisateur</label>
        <input type="text" name="username" id="username"
               value="<?= htmlspecialchars($username) ?>" required>
      </article>

      <!-- ancien mot de passe -->
      <article class="formItem">
        <label for="oldPassword">Mot de passe actuel</label>
        <input type="password" name="oldPassword" id="oldPassword" required>
      </article>

      <!-- nouveau mot de passe optionnel -->
      <article class="formItem">
        <label for="password">Nouveau mot de passe (laisser vide si inchangé)</label>
        <input type="password" name="password" id="password">
      </article>
      <article class="formItem">
        <label for="verifyPassword">Confirmer le mot de passe</label>
        <input type="password" name="verifyPassword" id="verifyPassword">
      </article>

      <input type="submit" value="Mettre à jour" class="button jump">
    </form>
</main>

<?php require_once(__DIR__ . "/../footer.php"); ?>
