<?php
require_once("connect.php");
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("location:erreur.php?msg=2");
}

require_once("get_email.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Page Admin</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script>$(document).ready(function(){
    $('[data-toggle="collapse"]').click(function(){
        $('.navbar-collapse').collapse('toggle');
    });
});</script>
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
<script>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
<header>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container-fluid">
<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarNav">
<ul class="navbar-nav">
    <li>
    <a class="nav-link" href="Accueil_etudiant.php">Accueil</a>
    </li>
<li class="nav-item">
<a class="nav-link" href="Accueil_admin_etudiant.php">Etudiant</a>
</li>
<li class="nav-item">
<a class="nav-link" href="Accueil_admin_enseignant.php">Enseignant</a>
</li>
<li class="nav-item">
<a class="nav-link" href="Accueil_admin_cours.php">Liste des cours</a>
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


</ul>
</div>
</div>
</nav>
</header>
   
<!---->
<div class="container-xl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Utilisateur <b>Details</b></h2></div>
                    <div class="col-sm-4"> 
                        <div class="search-box">
                        <form action="ajouter_utilisateur.php" method="get">
                            <button type="submit" class="btn btn-primary">
                                <i class="material-icons">add</i> Ajouter
                            </button>
                        </form>

 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <table class="table table-striped table-hover table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>PRENOM </th>
                        <th>ADRESSE_MAIL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
     require_once("connect.php");
    
    // Connexion a la base de donnees
     //$conn = connect();


    // preparer la requete
    $req = "select * from utilisateur ";
    // Executer la requete
try {
    $resultat = $conn->query($req);
    // Parcourir le resultat

    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>".$ligne["id_utilisateur"]."</td>";
        echo "<td>".$ligne["nom"]."</td>";
        echo "<td>".$ligne["prenom"]."</td>";
        echo "<td>".$ligne["email"]."</td>";
        echo" <td>
        
        <a href='affichage_par_id.php?id_utilisateur=".$ligne["id_utilisateur"]."' class='view' title='View' data-toggle='tooltip'><i class='material-icons'>&#xE417;</i></a>
        <a href='edit_utilisateur.php?id_utilisateur=".$ligne["id_utilisateur"]."' class='edit' title='Edit' data-toggle='tooltip'><i class='material-icons'>&#xE254;</i></a>
        <a href='supprimer_utilisateur.php?id_utilisateur=".$ligne["id_utilisateur"]."' class='delete' title='Delete' data-toggle='tooltip'><i class='material-icons'>&#xE872;</i></a>
    </td>";
        echo "<tr>";
    }
    echo "</table>";

    //fermer la connexion
    $conn = null;
}
catch(PDOException $e)
{
    echo "<br> Probleme de requete".$e->getMessage();
}

?>
      
                </tbody>
            </table>
            
        </div>
    </div>  
</div>  
<?php //require_once("deconnexion.php"); ?>
</body>
</html>