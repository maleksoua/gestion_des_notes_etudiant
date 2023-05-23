<?php
require_once("connect.php");
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("location:erreur.php?msg=2");
}?>
<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>ajouter de nouveaux utilisateurs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{ width: 350px; padding: 20px; }
    </style>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="wrapper">
    <h2>ajouter un nouveau étudiant</h2>
   
                    <form action="ajouter_utilisateur.php" method="GET">
                    <div class="form-group">
                            <label>Nom</label>
                            <input type="text" name="lastname" class="form-control" required>
                        </div>    
                        <div class="form-group">
                            <label>Prénom</label>
                            <input type="text" name="firstname" class="form-control" required>
                        </div>    
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" required>
                        </div>    
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Quel est votre rôle?</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="student" value="student" required checked>
                                <label class="form-check-label" for="student">
                                    Etudiant
                                </label>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Ajouter">
                        </div>
      

    </form>
  <?php
     // var_dump($_GET);
      //phpinfo();
      if(isset($_GET["submit"]))
      {
        $firstname = $_GET["firstname"];
        $lastname = $_GET["lastname"];    
        $email = $_GET["email"];
        $password = $_GET["password"];
        $Role=$_GET["role"];
        
        require_once("connect.php");
        // Connexion a la base de donnees
         $conn = connect();
         if ($Role=="teacher"){
            $req = "INSERT INTO utilisateur VALUES (null,'$lastname', '$firstname', '$email', '$password',1)";
           }else if($Role=="student"){
             $req = "INSERT INTO utilisateur VALUES (null,'$lastname', '$firstname', '$email', '$password',2)";
           }else if($Role=="Admin"){
             $req = "INSERT INTO utilisateur VALUES (null,'$lastname', '$firstname', '$email', '$password',0)";
           }else{
             echo "erreur de saisie";
           }

         //echo $req;
try {
    $n = $conn->exec($req);
    echo "<br>n = $n";
    if($n>0) {
        echo "Ajout effectuee avec succes... :)";
        header("Location: Accueil_admin.php");
       
    }
}
catch(PDOException $e)
{
    echo "Email existe déja";
}
      }

?>


  </body>
</html>
