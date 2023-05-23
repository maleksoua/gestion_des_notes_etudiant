<?php
require_once("connect.php");
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("location:erreur.php?msg=2");
}
?>

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
    <title>Modifier utilisateur</title>
  </head>
  <body>
    <div class="container">
      
      <?php
      // Vérifier si l'ID de l'utilisateur est défini
      if (isset($_GET['id_utilisateur'])) {
        $id_utilisateur = $_GET['id_utilisateur'];

        // Connexion à la base de données
        $pdo = connect();

        // Récupération de l'utilisateur à modifier
        $sql = 'SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
        $statement->execute();
        $utilisateur = $statement->fetch(PDO::FETCH_ASSOC);

        // Affichage du formulaire de modification
        if ($utilisateur) {
          echo "<h2 class='mb-3'>Modifier un utilisateur</h2>";
          echo "<form action='edit_utilisateur.php' method='get'>";
          echo "<div class='form-group'><label>ID:</label><input type='text' class='form-control' name='id_utilisateur' value='" . $utilisateur['id_utilisateur'] . "' readonly></div>";
          echo "<div class='form-group'><label>Prenom:</label><input type='text' class='form-control' name='prenom' value='" . $utilisateur['prenom'] . "' required></div>";
          echo "<div class='form-group'><label>Nom:</label><input type='text' class='form-control' name='nom' value='" . $utilisateur['nom'] . "' required></div>";
          echo "<div class='form-group'><label>Email:</label><input type='email' class='form-control' name='email' value='" . $utilisateur['email'] . "' required></div>";
          echo "<div class='form-group'><label>Password:</label><input type='password' class='form-control' name='password' value='" . $utilisateur['mot_de_passe'] . "' required></div>";
          echo "<button type='submit' name='submit' class='btn btn-primary'>Enregistrer</button>";
          echo "</form>";
        }
        
        if (isset($_GET['submit'])) {
          $sql_update = "UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, mot_de_passe = :mot_de_passe WHERE id_utilisateur = :id_utilisateur";
          $statement_update = $pdo->prepare($sql_update);
          $statement_update->bindParam(':nom', $_GET['nom'], PDO::PARAM_STR);
          $statement_update->bindParam(':prenom', $_GET['prenom'], PDO::PARAM_STR);
          $statement_update->bindParam(':email', $_GET['email'], PDO::PARAM_STR);
          $statement_update->bindParam(':mot_de_passe', $_GET['password'], PDO::PARAM_STR);
          $statement_update->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
          $statement_update->execute();

          try {
            $n = $statement_update->rowCount();
            if ($n > 0) {
                echo "Mise à jour effectuée avec succès!";
                header("Location: Accueil_admin.php");
                exit();
            } else {
                echo "Aucune mise à jour effectuée.";
            }
          } catch (PDOException $e) {
              echo "Problème de requête: " . $e->getMessage();
          }
        }
      }
      ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  </body>
</html>
