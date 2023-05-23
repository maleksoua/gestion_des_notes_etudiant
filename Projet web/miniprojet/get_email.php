<?php 
$conn = connect();
$id_utilisateur = $_SESSION['id_utilisateur']; 
    $req = "SELECT email FROM utilisateur WHERE id_utilisateur= :id_utilisateur ";
    $statement = $conn->prepare($req);
    $statement->bindParam(':id_utilisateur', $id_utilisateur, PDO::PARAM_INT);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
?>