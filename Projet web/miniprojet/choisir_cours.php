<?php
// Connect to the database
require 'connect.php';
$pdo = connect();

// Get the logged-in student's ID
session_start();
$studentId = $_SESSION['id_utilisateur'];

// Get the selected course ID from the URL parameter
$courseId = $_GET['courseId'];

// Check if the student has already chosen the course
$query = "SELECT COUNT(*) FROM assister WHERE id_etudiant = :studentId AND id_cours = :courseId";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
$stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count > 0) {
    // The student has already chosen the course
    // You can handle this case accordingly, e.g., display an error message or redirect back to the page
    echo "Vous avez déjà choisi ce cours.";
    exit();
}

// Insert the selected course into the "assister" table
$query = "INSERT INTO assister (id_etudiant, id_cours) VALUES (:studentId, :courseId)";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':studentId', $studentId, PDO::PARAM_INT);
$stmt->bindParam(':courseId', $courseId, PDO::PARAM_INT);
$stmt->execute();

// Redirect the student back to the "etudiant.php" page
header("Location: Accueil_etudiant.php");
exit();
?>
