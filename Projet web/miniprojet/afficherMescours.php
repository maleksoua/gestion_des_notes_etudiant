<?php
require_once("connect.php");
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("location:erreur.php?msg=2");
}?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mes cours - Etudiant</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
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
    </style>
<header>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_page == 'accueil') ? 'active' : ''; ?>" href="bienvenue_ens.php">Accueil</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_page == 'mescours') ? 'active' : ''; ?>" href="afficherMescours.php">Afficher mes cours</a>
    </li>
    <li class="nav-item">
        <a class="nav-link <?php echo ($current_page == 'listecours') ? 'active' : ''; ?>" href="Accueil_etudiant.php">Liste des cours</a>
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

<div class="container-xl">
        <div class="table-responsive">
            <div class="table-wrapper">
                <div class="table-title">
                    
                    <h2>Mes cours</h2>
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>Nom du cours</th>
                                <th>Nom enseignant</th>
                                <th>Prénom enseignant</th>
                                <th>Email enseignant</th>
                                <th>Note attribuée</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Connect to the database
                            //require 'connect.php';
                            $pdo = connect();

                            // Get the logged-in student's ID
                            session_start();
                            $studentId = $_SESSION['id_utilisateur'];

                            // Retrieve the courses chosen by the student
                            $query = "SELECT c.nom_cours, u.nom, u.prenom, u.email, e.note
                                      FROM cours c
                                      INNER JOIN assister a ON c.id_cours = a.id_cours
                                      INNER JOIN utilisateur u ON c.id_utilisateur = u.id_utilisateur
                                      LEFT JOIN examen e ON c.id_cours = e.id_cours AND a.id_etudiant = e.id_etudiant
                                      WHERE a.id_etudiant = :studentId";
                            $stmt = $pdo->prepare($query);
                            $stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
                            $stmt->execute();

                            // Display the chosen courses
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . $row['nom_cours'] . "</td>";
                                echo "<td>" . $row['nom'] . "</td>";
                                echo "<td>" . $row['prenom'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . ($row['note'] ?? "N/A") . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
