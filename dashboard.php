<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5 text-center">
    <div class="card p-4 shadow-sm">
        <h2 class="mb-3 text-primary">Bonjour, <?php echo htmlspecialchars($_SESSION['username']); ?> !</h2>
        <p class="text-muted">Vous êtes connecté(e) à votre espace sécurisé.</p>
        <a href="logout.php" class="btn btn-warning">Se déconnecter</a>
    </div>
</body>
</html>
