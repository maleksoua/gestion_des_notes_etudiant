<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
</head>
<body>
    <?php 
        $msg = $_GET['msg'];
        if($msg == 1)
          echo "<h2>Erreur : login ou mot de passe incorrecte......</h2>";
        
          if($msg == 2 )
          echo "<h2>Acces interdit vous devez vous connectez....</h2>";
        
    ?>
    
    <hr>
    <a href="login.php">Login</a>
</body>
</html>

