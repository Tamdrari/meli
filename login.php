
<?php
session_start();
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (!empty($username) && !empty($password)) {
        $stmt_user = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt_user->execute([$username]);
        $user = $stmt_user->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Vérifie si le mot de passe est en MD5 (ancien admin)
            if (strlen($user['password']) === 32 && $user['password'] === md5($password)) {
                $_SESSION['username'] = htmlspecialchars($user['username']);
                header("Location: welcome.php");
                exit();
            }
            
            // Vérifie si le mot de passe est en password_hash()
            if (password_verify($password, $user['password'])) {
                $_SESSION['username'] = htmlspecialchars($user['username']);
                header("Location: welcome.php");
                exit();
            }
        }
    }

    $_SESSION['error'] = "Identifiants incorrects.";
    header("Location: index.php");
    exit();
}
?>
