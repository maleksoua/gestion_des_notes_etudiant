<?php

if(isset($_POST["submit"])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connexion à la base de données et sélection de l'utilisateur
    require 'connect.php';
    $pdo = connect();
    $sql = 'SELECT * FROM utilisateur WHERE email = :email and mot_de_passe = :mot_de_passe';

    $statement = $pdo->prepare($sql);
    $statement->bindParam(':email', $email, PDO::PARAM_INT);
    $statement->bindParam(':mot_de_passe', $password, PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    session_start();
       $_SESSION['id_utilisateur']=$user['id_utilisateur'];
    // Vérification du rôle de l'utilisateur et redirection vers la page appropriée
    header ("location:bienvenue_ens.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
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
                    <h2>Login</h2>
                    <p>Veuillez remplir vos informations.</p>
                    <form action="" method="post">   
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>    
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Se connecter">
                        </div>
                        <p>Vous n'avez pas de compte? <a href="register.php">S'inscrir ici</a>.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
