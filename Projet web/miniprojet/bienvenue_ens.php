<?php
require_once("connect.php");
session_start();
if (!isset($_SESSION['id_utilisateur'])) {
    header("location:erreur.php?msg=2");
}

$conn = connect();
$id_utilisateur = $_SESSION['id_utilisateur']; 
    $req = "SELECT nom, prenom, Role FROM utilisateur WHERE id_utilisateur= :id_utilisateur ";
    $statement = $conn->prepare($req);
    $statement->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST["suivant"])) {
    

    if ($user) {
        if ($user['Role'] == 0) {
            header("Location: Accueil_admin.php");
            exit();
        } elseif ($user['Role'] == 2) {
            header("Location: Accueil_etudiant.php");
            exit();
        } elseif ($user['Role'] == 1) {
            header("Location: accueil_ens.php");
            exit();
        } else {
            echo "Rôle invalide.";
        }
    } else {
        header("location:erreur.php?msg=1");
    }
}
?>

<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <style>
        body {
            background-image: url('images/backgr5.jpeg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        h1 {
            text-align: center;
            color: blue;
        }

        .center-button {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
        }

        .center-button input[type="submit"] {
            background-color: blue;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        }
    </style>
    <title>Bienvenue</title>
</head>
<body>
    <h1>Bienvenue <?php echo $user['nom']; ?></h1>
    <div class="center-button">
        <form action="" method="post">
            <input type="submit" name="suivant" value="Suivant">
        </form>
    </div>
</body>
</html>
