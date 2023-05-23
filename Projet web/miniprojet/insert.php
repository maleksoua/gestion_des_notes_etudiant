<?php 


if(isset($_GET["submit"]))
{
  
    $lastname = $_GET["lastname"];
    $firstname = $_GET["firstname"];
    $email = $_GET["email"];
    $password = $_GET["password"];
    $Role = $_GET["role"];
    
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
}
}
catch(PDOException $e)
{
echo "Probleme de requete... : ".$e->getMessage();
}
}
header("Location: register.php");

?>