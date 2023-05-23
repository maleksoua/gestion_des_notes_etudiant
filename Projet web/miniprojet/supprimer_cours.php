<?php
$id_cours = $_GET['id_cours'];
// connect to the database and select the publisher
require 'connect.php';
$pdo = connect();

$sql = 'DELETE FROM cours WHERE id_cours = :id_cours';
$statement = $pdo->prepare($sql);
$statement->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
$statement->execute();
header("Location: accueil_ens.php");
?>