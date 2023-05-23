<?php
require_once("connect.php");
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("location:erreur.php?msg=2");
}?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
      body {
        background-color: #f8f9fa;
      }
      h1 {
        color: #007bff;
      }
    </style>
    <title>Modifier une note</title>
  </head>
  <body>
    <div class="container">
      <h1 class="mt-5 mb-3 text-center">Modifier une note</h1>
      <?php
      // Vérifier si l'ID de l'utilisateur est défini
      if (isset($_GET['id_etudiant']) && isset($_GET['id_cours'])) {
        $id_etudiant = $_GET['id_etudiant'];
        $id_cours = $_GET['id_cours'];
        
        // Connexion à la base de données
        //require 'connect.php';
        $pdo = connect();

        // Récupération de l'examen à modifier
        $sql = 'SELECT * FROM examen WHERE id_etudiant = :id_etudiant AND id_cours = :id_cours';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
        $statement->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
        $statement->execute();
        $examen = $statement->fetch(PDO::FETCH_ASSOC);

        // Affichage du formulaire de modification
        if ($examen) {
          echo "<h2 class='mb-3'>Modifier une note</h2>";
          echo "<form action='editer_note2.php' method='get'>";
          echo "<div class='form-group'><label>ID Etudiant</label><input type='text' class='form-control' name='id_etudiant' value='" . $examen['id_etudiant'] . "' readonly></div>";
          echo "<div class='form-group'><label>ID cours</label><input type='text' class='form-control' name='id_cours' value='" . $examen['id_cours'] . "' readonly></div>";
          echo "<div class='form-group'><label>Nouvelle note</label><input type='text' class='form-control' name='note' value='" . $examen['note'] . "' required></div>";
          echo "<button type='submit' name='submit' class='btn btn-primary'>Enregistrer</button>";
          echo "</form>";
        }

        if (isset($_GET['submit'])) {
          $note = $_GET['note'];

          // Mise à jour de la note dans la base
          $sql_update = "UPDATE examen SET note = :note WHERE id_etudiant = :id_etudiant AND id_cours = :id_cours";
          $statement_update = $pdo->prepare($sql_update);
          $statement_update->bindParam(':note', $note, PDO::PARAM_INT);
          $statement_update->bindParam(':id_etudiant', $id_etudiant, PDO::PARAM_INT);
          $statement_update->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
          $statement_update->execute();
                // Redirection vers la page gerernote_by_etudiant.php avec les paramètres id_etudiant et id_cours
      
                //header("Location: gerernote_by_etudiant.php?id_etudiant=$id_etudiant&id_cours=$id_cours");
                echo "Mise à jour effectuée avec succès.";
      exit();
    }
  }
  ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>