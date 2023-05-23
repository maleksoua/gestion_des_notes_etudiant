<?php
$id_utilisateur = $_GET['id_utilisateur'];
// connect to the database and select the publisher
require 'connect.php';
$pdo = connect();

$sql = 'DELETE FROM utilisateur WHERE id_utilisateur = :id_utilisateur';
$statement = $pdo->prepare($sql);
$statement->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
$statement->execute();
header("Location: Accueil_admin.php");
?>