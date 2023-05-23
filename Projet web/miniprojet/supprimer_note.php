<?php
$id_cours = $_GET['id_cours'];
$id_etudiant = $_GET['id_etudiant'];
// connect to the database and select the publisher
require 'connect.php';
$pdo = connect();

$sql = 'DELETE FROM examen WHERE id_cours = :id_cours and id_etudiant=:id_etudiant';
$statement = $pdo->prepare($sql);
$statement->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
$statement->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
$statement->execute();
header("Location: gerernote_by_etudiant.php?id_cours=".$id_cours."&id_utilisateur=".$id_etudiant);
?>