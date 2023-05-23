<?php 
if (isset($_GET['id_cours']) && isset($_GET['id_etudiant']) && isset($_GET['note'])) {
    $id_cours = $_GET['id_cours'];
    $id_etudiant = $_GET['id_etudiant'];
    $note = $_GET['note'];

    session_start();
    require 'connect.php';
    $pdo = connect();

    // Requête d'insertion ou de mise à jour dans la table "examen"
    $query = "INSERT INTO examen (id_etudiant, id_cours, note) 
              VALUES (:id_etudiant, :id_cours, :note)
              ON DUPLICATE KEY UPDATE note = :note";
    $statement_insert = $pdo->prepare($query);
    $statement_insert->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
    $statement_insert->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
    $statement_insert->bindParam(':note', $note, PDO::PARAM_INT);
    $statement_insert->execute();

    if ($statement_insert->rowCount() > 0) {
        echo "Ajout effectué avec succès.";
        header("Location: gerernote_by_etudiant.php?id_utilisateur=$id_etudiant&id_cours=$id_cours");
    } else {
        echo "Erreur lors de l'ajout.";
    }
} else {
    echo "Paramètres manquants.";
}
?>
