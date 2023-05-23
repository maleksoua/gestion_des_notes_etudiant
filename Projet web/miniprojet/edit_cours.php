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
    <title>modifier cours</title>
  </head>
  <body>
  <header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
    <li>
    <a class="nav-link" href="bienvenue_ens.php">Accueil</a>
    </li>
<li class="nav-item">
<a class="nav-link" href="accueil_ens.php">Vos cours</a>
</li>
</ul>
<ul class="navbar-nav ml-auto">
<li class="nav-item">
<a class="nav-link"><?php echo $user['email']; ?></a>

</li>
<li class="nav-item">
<a class="nav-link" href="deconnexion.php">Déconnexion</a>
</li>
</ul>
</div>
</div>
</nav>
</header>
    <div class="container">
      <?php
      // Vérifier si l'ID de cours est défini
      if (isset($_GET['id_cours'])) {
        $id_cours = $_GET['id_cours'];

        // Connexion à la base de données
        $pdo = connect();

        // Récupération du cours à modifier
        $sql = 'SELECT * FROM cours WHERE id_cours = :id_cours';
        $statement = $pdo->prepare($sql);
        $statement->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
        $statement->execute();
        $cours = $statement->fetch(PDO::FETCH_ASSOC);

        // Affichage du formulaire de modification
        if ($cours) {
          echo "<h2 class='mb-3'>Modifier un cours</h2>";
          echo "<form action='edit_cours.php' method='get'>";
          echo "<div class='form-group'><label>ID:</label><input type='text' class='form-control' name='id_cours' value='" . $cours['id_cours'] . "' readonly></div>";
          echo "<div class='form-group'><label>Nom_cours:</label><input type='text' class='form-control' name='nom_cours' value='" . $cours['nom_cours'] . "' required></div>";
          echo "<button type='submit' name='submit' class='btn btn-primary'>Enregistrer</button>";
          echo "</form>";
        }

        if (isset($_GET['submit'])) {
          $sql_update = "UPDATE cours SET nom_cours = :nom_cours WHERE id_cours = :id_cours";
          $statement_update = $pdo->prepare($sql_update);
          $statement_update->bindParam(':nom_cours', $_GET['nom_cours'], PDO::PARAM_STR);
          $statement_update->bindParam(':id_cours', $id_cours, PDO::PARAM_INT);
          $statement_update->execute();

          try {
            $n = $statement_update->rowCount();
            echo "<br>n = $n";
            if ($n > 0) {
                echo "Mise à jour effectuée avec succès!";
                header("Location: accueil_ens.php");
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
