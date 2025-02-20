<?php
$server = "localhost"; 
$dbName = "melissa_db"; 
$user = "admin"; 
$pass = "mdp"; 

try {
    $conn = new PDO("mysql:host=$server;dbname=$dbName;charset=utf8", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $exception) {
    die("Erreur de connexion : " . $exception->getMessage());
}
?>
