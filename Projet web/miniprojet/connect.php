<?php
function connect()
{
    require_once("config.php");
    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname",'oussama','oussama');
        //echo "Connexion etablie...<br>";
        return $conn;
    } catch(PDOException $e) {
        echo "Probleme de connexion :".$e->getMessage()."...<br>";
        die();
    }
}
//$test=connect();