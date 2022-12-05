<?php

// On requiere le fichier de connexion à la base de données
require_once('connexion.php');

$id_session = session_create_id();
session_id($id_session);
session_start();
// On assigne et securise les variables afin d'eviter les attaques XSS
$emailsecure = htmlspecialchars($_POST['email']);
$passwordsecure = htmlspecialchars($_POST['password']);
if ($sth = $db->prepare("SELECT id_compte,mot_de_passe_compte FROM compte WHERE email_compte = ?")) {
    // On precise que $email est une chaine de caractere
    $sth->bindParam(1, $emailsecure, PDO::PARAM_STR);
    //on execute la requete
    $sth->execute();
    // On verifie si la requete retourne un resultat
    if ($sth->rowCount() > 0) {
        // On recupere le resultat de la requete
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        // On verifie si le mot de passe correspond
        if (hash('sha512', $passwordsecure) == $result['mot_de_passe_compte']) {
            //on regenere l'id de la session pour eviter les attaques de fixation de session
            session_regenerate_id();
            // On assigne les variables de session
            $_SESSION['loggedin'] = $id_session;
            $_SESSION['id'] = $result['id_compte'];
            // On crée un cookie avec l'email de l'utilisateur
            setcookie('email', $_POST["email"], time() + 300000, '/');
            $sth = null;
            //si l'id de session est 3 c'est que c'est un admin
            if ($_SESSION['id'] == 3) {
                header('Location: ../testadmin.php');
            } else {
                // On redirige l'utilisateur vers la page dashboard.php
                header('Location: ../dashboard.php');
            }
        } else {
            $sth = null;
            // On redirige l'utilisateur vers la page de connexion
            header('Location: ../index.php?=error1');
        }
    } else {
        $sth = null;
        // On redirige l'utilisateur vers la page de connexion
        header('Location: ../index.php?=error2');
    }
} else {
    // On redirige l'utilisateur vers la page de connexion
    header('Location: ../index.php?=error3');
}
