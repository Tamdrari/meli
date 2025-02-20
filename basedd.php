<?php
$serveur = "localhost";
$baseDonnees = "auth_db";
$utilisateur = "admin";
$motDePasse = ""; 

try {
    $connexion = new PDO("mysql:host=$serveur;dbname=$baseDonnees;charset=utf8", $utilisateur, $motDePasse);
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erreur) {
    die("Erreur de connexion : " . $erreur->getMessage());
}
?>
