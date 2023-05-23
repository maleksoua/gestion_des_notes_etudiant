<?php
if(isset($_GET["submit"]))
{
$email = $_GET['email'];
$password = $_GET['password'];
// connect to the database and select the publisher
require 'connect.php';
$pdo = connect();
$sql = 'SELECT * FROM utilisateur WHERE email = :email and mot_de_passe = :mot_de_passe and role=1';
$statement = $pdo->prepare($sql);
$statement->bindParam(':email', $email, PDO::PARAM_INT);
$statement->bindParam(':mot_de_passe', $password, PDO::PARAM_STR);
$statement->execute();
$apprenant = $statement->fetch(PDO::FETCH_ASSOC);
if ($apprenant) {
echo $apprenant['id_utilisateur'] . 'email:  ' . $apprenant['email'] . 'password:  ' . $apprenant['mot_de_passe'] . 'nom:  ' . $apprenant['nom'] . 'role:  ' . $apprenant['role'];

} else {
echo " utilisateur with id $id was not found.";
}}
?>