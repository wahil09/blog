<?php
    function sqlRequet() {
        // connexion to base de donnees
        $servername = "localhost";
        $user = "root";
        $pass = "";
        $dbname = "wahil";
        $table_name = "users";
        $conn = new PDO("mysql:host=$servername; dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    }
