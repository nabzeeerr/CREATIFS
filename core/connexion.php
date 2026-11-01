<?php
// CONNEXION 

try {
    $connexion = new PDO('mysql:host=localhost;port=3306;dbname=' . DB_NAME, DB_USER, DB_PASSWORD);

} catch (PDOException $e) {
    echo $e;
}