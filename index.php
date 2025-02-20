
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se Connecter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Accès à votre compte</h2>
        
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error-message"><?= htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        
        <form action="login.php" method="POST">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" name="username" required>
            
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" required>
            
            <button type="submit" class="btn-login">Connexion</button>
        </form>

        <p>Vous n'avez pas encore de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
    </div>
</body>
</html>
