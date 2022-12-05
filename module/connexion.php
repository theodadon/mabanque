<?php

//connexion a la bdd mabanque en local avec pdo 
try {
    $db = new PDO('mysql:host=localhost;dbname=mabanque;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}



?>