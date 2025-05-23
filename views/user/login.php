<?php

$pageTitle = "Se connecter";
require_once(__DIR__ . "/../header.php");

$email = $password = "";
$error = "";

if (isset($_SESSION["username"])) {
    $_SESSION["successMessage"] = "Bienvenue " . $_SESSION["username"] . " !";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    $loggedInUser = $userController->login($email, $password);

    if ($loggedInUser) {
        $_SESSION["id"] = $loggedInUser["id"];
        $_SESSION["username"] = $loggedInUser["username"];
        $_SESSION["email"] = $loggedInUser["email"];
        $_SESSION["role"] = $loggedInUser["role"]; 
        $_SESSION["successMessage"] = "Bienvenue " . $_SESSION["username"] . " !";
        
        if ($loggedInUser["role"] === "admin") {
            header("Location: ../admin/dashboard.php"); 
        } else {
            header("Location: ../index.php"); 
        }

        exit();
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
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

    <form action="" method="POST" class="form">

        <h2>Se connecter</h2>
        
        <section class="formBody">
            <article class="formItem">
                <label for="email">Adresse email:</label>
                <input type="email" id="email" name="email" placeholder="Adresse email" required
                value="<?= htmlspecialchars($email); ?>">
            </article>

            <article class="formItem">
                <label for="password">Mot de passe:</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" 
                required>
            </article>

            <input type="submit" value="Me connecter" class="button jump">
        </section>
        <a href="./register.php" class="formLink"
            aria-label="Accéder à la création de compte">Pas encore de compte ? 
            <i class="fa-solid fa-right-to-bracket fa-beat-fade"></i></i><button>C'est par ici</button></a>
    </form>
    
</main>

<?php require_once(__DIR__ . "/../footer.php"); ?>