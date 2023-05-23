<?php
// SQL statement for creating new tables
$statements = [
    'CREATE TABLE utilisateur (
        id_utilisateur INT AUTO_INCREMENT,
        nom VARCHAR(100),
        prenom VARCHAR(100),
        email VARCHAR(100) UNIQUE,
        mot_de_passe VARCHAR(100),
        Role INT,
        PRIMARY KEY (id_utilisateur)
    )',
    'CREATE TABLE cours (
        id_cours INT AUTO_INCREMENT,
        nom_cours VARCHAR(100),
        id_utilisateur INT,
        PRIMARY KEY (id_cours),
        CONSTRAINT fk_Enseignant FOREIGN KEY (id_utilisateur)
        REFERENCES utilisateur (id_utilisateur)
        ON DELETE CASCADE
    )',
    'CREATE TABLE assister (
        id_etudiant INT,
        id_cours INT,
        PRIMARY KEY (id_cours, id_etudiant),
        CONSTRAINT fk_user FOREIGN KEY (id_etudiant)
        REFERENCES utilisateur (id_utilisateur)
        ON DELETE CASCADE,
        CONSTRAINT fk_cours FOREIGN KEY (id_cours)
        REFERENCES cours (id_cours)
        ON DELETE CASCADE
    )',
    'CREATE TABLE examen (
        id_etudiant INT,
        id_cours INT,
        note INT,
        PRIMARY KEY (id_cours, id_etudiant),
        CONSTRAINT fk_utilsateur FOREIGN KEY (id_etudiant)
        REFERENCES utilisateur (id_utilisateur)
        ON DELETE CASCADE,
        CONSTRAINT fk_Course FOREIGN KEY (id_cours)
        REFERENCES cours (id_cours)
        ON DELETE CASCADE
    )'
];

// connect to the database
require 'connect.php';
$pdo = connect();

// execute SQL statements
foreach ($statements as $statement) {
    $pdo->exec($statement);
}
?>
