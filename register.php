
<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Tous les champs sont obligatoires.";
        header("Location: register.php");
        exit();
    }

    // Vérification du format du mot de passe
    if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password)) {
        $_SESSION['error'] = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
        header("Location: register.php");
        exit();
    }

    // Vérification si l'utilisateur existe déjà
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Ce nom d'utilisateur est déjà pris.";
        header("Location: register.php");
        exit();
    }

    // Hachage sécurisé du mot de passe
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertion dans la base de données
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($stmt->execute([$username, $hashedPassword])) {
        $_SESSION['success'] = "Inscription réussie ! Vous pouvez vous connecter.";
        header("Location: index.php");
        exit();
    } else {
        $_SESSION['error'] = "Une erreur est survenue lors de l'inscription.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Créer un compte</h2>
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['success'])): ?>
            <p class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        <form action="register.php" method="POST" onsubmit="return validatePassword()">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>
            <small id="password-error" class="error-text"></small>

            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà membre ? <a href="index.php">Connectez-vous ici</a></p>
    </div>

    <script>
    function validatePassword() {
        let password = document.getElementById("password").value;
        let errorMsg = document.getElementById("password-error");
        let regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!regex.test(password)) {
            errorMsg.textContent = "Le mot de passe doit contenir au moins 8 caractères, une majuscule, une minuscule, un chiffre et un caractère spécial.";
            return false;
        }
        errorMsg.textContent = "";
        return true;
    }
    </script>
</body>
</html>
