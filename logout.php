
<?php
session_start();

if (session_status() === PHP_SESSION_ACTIVE) {
    $_SESSION = [];  // Vide toutes les variables de session
    session_unset(); // Supprime les variables de session
    session_destroy(); // Détruit la session
}

header("Location: index.php");
exit();
?>
