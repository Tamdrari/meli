
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="container text-center">
        <div class="card shadow-lg p-4">
            <h2 class="mb-3">Bienvenue, <span class="text-primary"><?= htmlspecialchars($_SESSION['user']); ?></span> !</h2>
            <p class="lead">Ravi de vous revoir.</p>
            <a href="logout.php" class="btn btn-danger mt-3">Se déconnecter</a>
        </div>
    </div>
</body>
</html>
