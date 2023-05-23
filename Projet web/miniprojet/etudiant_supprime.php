
<?php
if (isset($_GET['id_cours']) && isset($_GET['id_utilisateur'])) {
  $id_cours = $_GET['id_cours'];
  $id_etudiant = $_GET['id_utilisateur'];


  // Connexion à la base de données
  require 'connect.php';
  $pdo = connect();

  $sql = 'DELETE FROM assister WHERE id_cours = :id_cours AND id_etudiant = :id_etudiant';
  $statement = $pdo->prepare($sql);
  $statement->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
  $statement->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
  $statement->execute();

  header("Location: afficherMescours.php");
  exit();
 
}


?>