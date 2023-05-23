<?php 
$id_cours = $_GET['id_cours'];
session_start();
require 'connect.php';
$pdo = connect();

$email_etudiant = $_GET['email_etudiant'];
$sql = "SELECT * FROM utilisateur WHERE email = :email_etudiant and Role=2";

$statement = $pdo->prepare($sql);
$statement->bindParam(':email_etudiant', $email_etudiant, PDO::PARAM_STR);
$statement->execute();
$apprenant = $statement->fetch(PDO::FETCH_ASSOC);

$id_utilisateur = $apprenant['id_utilisateur']; // Récupération de l'id de l'utilisateur trouvé

// Requête d'insertion dans la table "assister"
// Requête d'insertion dans la table "assister"
$query = "INSERT INTO assister (id_etudiant, id_cours) VALUES (:id_utilisateur, :id_cours)";
$statement_insert = $pdo->prepare($query);
$statement_insert->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
$statement_insert->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);

if (!empty($id_utilisateur)) {
    $statement_insert->execute();

    if ($statement_insert->rowCount() > 0) {
        echo "Ajout effectué avec succès.";
    } else {
        echo "Erreur lors de l'ajout.";
    }
} else {
    echo "Etudiant non trouvable.";
}

?>
