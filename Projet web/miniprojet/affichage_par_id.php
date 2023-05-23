<?php
require_once("connect.php");
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("location:erreur.php?msg=2");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Affichage de l'utilisateur</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
body {
    color: #566787;
    background: #f5f5f5;
    font-family: 'Roboto', sans-serif;
}
.table-responsive {
    margin: 30px 0;
}
.table-wrapper {
    min-width: 1000px;
    background: #fff;
    padding: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,.05);
}
.table-title {
    padding-bottom: 10px;
    margin: 0 0 10px;
    min-width: 100%;
}
.table-title h2 {
    margin: 8px 0 0;
    font-size: 22px;
}
.search-box {
    position: relative;        
    float: right;
}
.search-box input {
    height: 34px;
    border-radius: 20px;
    padding-left: 35px;
    border-color: #ddd;
    box-shadow: none;
}
.search-box input:focus {
    border-color: #3FBAE4;
}
.search-box i {
    color: #a0a5b1;
    position: absolute;
    font-size: 19px;
    top: 8px;
    left: 10px;
}
table.table tr th, table.table tr td {
    border-color: #e9e9e9;
}
table.table-striped tbody tr:nth-of-type(odd) {
    background-color: #fcfcfc;
}
table.table-striped.table-hover tbody tr:hover {
    background: #f5f5f5;
}
table.table th i {
    font-size: 13px;
    margin: 0 5px;
    cursor: pointer;
}
table.table td:last-child {
    width: 130px;
}
table.table td a {
    color: #a0a5b1;
    display: inline-block;
    margin: 0 5px;
}
table.table td a.view {
    color: #03A9F4;
}
table.table td a.edit {
    color: #FFC107;
}
table.table td a.delete {
    color: #E34724;

}
table.table td i {
    font-size: 19px;
}    
.pagination {
    float: right;
    margin: 0 0 5px;
}
.pagination li a {
    border: none;
    font-size: 95%;
    width: 30px;
    height: 30px;
    color: #999;
    margin: 0 2px;
    line-height: 30px;
    border-radius: 30px !important;
    text-align: center;
    padding: 0;
}
.pagination li a:hover {
    color: #666;
}	
.pagination li.active a {
    background: #03A9F4;
}
.pagination li.active a:hover {        
    background: #0397d6;
}
.pagination li.disabled i {
    color: #ccc;
}
.pagination li i {
    font-size: 16px;
    padding-top: 6px
}
.hint-text {
    float: left;
    margin-top: 6px;
    font-size: 95%;
}    
.table-responsive-md {
    margin: 30px auto; /* Center the table horizontally */
}

.table {
    font-size: 14px; /* Adjust the font size */
}

</style>
</head>
<body>
<?php
$id = $_GET['id_utilisateur'];

// connexion à la base de données et sélection de la table 'utilisateur'
//require 'connect.php';
$conn = connect();
$sql = 'SELECT * FROM utilisateur WHERE id_utilisateur = :id_utilisateur';
$statement = $conn->prepare($sql);
$statement->bindParam(':id_utilisateur', $id, PDO::PARAM_INT);
$statement->execute();
$apprenant = $statement->fetch(PDO::FETCH_ASSOC);

if ($apprenant) {
// Vérification du rôle de l'utilisateur
if ($apprenant['Role'] == 0) {
  $role = 'Apprenant(e)';
  // Affichage des résultats
  echo '<div class="container-fluid text-center">';
  echo '<table class="table table-striped table-hover table-bordered table-responsive-md">';
  echo '<thead><tr><th>ID</th><th>Prénom</th><th>Nom</th><th>Rôle</th></tr></thead>';
  echo '<tbody><tr><td>' . $apprenant['id_utilisateur'] . '</td><td>' . $apprenant['prenom'] . '</td><td>' . $apprenant['nom'] . '</td><td>' . $role . '</td></tr></tbody>';
  echo '</table>';
  echo '</div>';
} else if ($apprenant['Role'] == 1) {
  $role = 'Enseignant(e)';
  // Affichage des résultats
  echo '<div class="container-fluid text-center">';
  echo '<table class="table table-striped table-hover table-bordered table-responsive-md">';
  echo '<thead><tr><th>ID</th><th>Prénom</th><th>Nom</th><th>Rôle</th></tr></thead>';
  echo '<tbody><tr><td>' . $apprenant['id_utilisateur'] . '</td><td>' . $apprenant['prenom'] . '</td><td>' . $apprenant['nom'] . '</td><td>' . $role . '</td></tr></tbody>';
  echo '</table>';
  echo '</div>';
} else if ($apprenant['Role'] == 2) {
  $role = 'Etudiant(e)';
  // Affichage des résultats
  echo '<div class="container-fluid text-center">';
  echo '<table class="table table-striped table-hover table-bordered table-responsive-md">';
  echo '<thead><tr><th>ID</th><th>Prénom</th><th>Nom</th><th>Rôle</th></tr></thead>';
  echo '<tbody><tr><td>' . $apprenant['id_utilisateur'] . '</td><td>' . $apprenant['prenom'] . '</td><td>' . $apprenant['nom'] . '</td><td>' . $role . '</td></tr></tbody>';
  echo '</table>';
  echo '</div>';
}


}
?>
</body>
</html>