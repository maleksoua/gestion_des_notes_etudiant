<!-- ajouter_cours.php -->

<?php
    session_start();
    require 'connect.php';
    $pdo = connect();
    $id_utilisateur = $_SESSION['id_utilisateur'];
    $nom_cours = $_GET['nom_cours'];
    $query = "INSERT INTO cours (nom_cours, id_utilisateur) VALUES ('$nom_cours', $id_utilisateur)";
    $pdo->query($query);
    //header("Location: Accueil_enseignant.php");
    header("Location: accueil_ens.php");
?>
