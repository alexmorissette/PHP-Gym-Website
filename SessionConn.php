<?php
    session_start();

    $serverName = "localhost";
    $dbName = "gymdb";
    $dbUser = "gymdb";
    $dbPass = "gymdb";

    try {


        $cn = new PDO("mysql:host=$serverName;dbname=$dbName", $dbUser, $dbPass);

    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    ?>