<?php
session_start();
require('../module/connexion.php');

// On assigne et securise les variables afin d'eviter les attaques XSS
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$email = htmlspecialchars($_POST['email']);
$tel = htmlspecialchars($_POST['telephone']);
$ville = htmlspecialchars($_POST['ville']);
$adresse = htmlspecialchars($_POST['adresse']);
$numero = htmlspecialchars($_POST['numero_compte']);



// On verifie si le compte existe
if ($sth = $db->prepare("SELECT id_client FROM client WHERE nom_client = ? AND prenom_client = ? AND ville_client = ? AND adresse_client = ?")) {
    $sth->bindParam(1, $nom, PDO::PARAM_STR);
    $sth->bindParam(2, $prenom, PDO::PARAM_STR);
    $sth->bindParam(3, $ville, PDO::PARAM_STR);
    $sth->bindParam(4, $adresse, PDO::PARAM_STR);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    $sth->closeCursor();
    // Si l'utilisateur existe
    if (!empty($result)) {
        // On verifie si le compte est valide
        if ($sth = $db->prepare("SELECT id_compte FROM compte WHERE email_compte = ? AND telephone_compte = ? AND numero_compte = ?")) {
            $sth->bindParam(1, $email, PDO::PARAM_STR);
            $sth->bindParam(2, $tel, PDO::PARAM_STR);
            $sth->bindParam(3, $numero, PDO::PARAM_INT);
            $sth->execute();
            $result1 = $sth->fetch(PDO::FETCH_ASSOC);
            $sth->closeCursor();
            if (!empty($result1)) {
                session_regenerate_id();
                $_SESSION['id_client'] = $result1["id_compte"];
                $_SESSION['loggedin'] = session_id();
                header('Location: nouveau_mdp.php');
            } else {
                header('Location: ../index.php?=error1');
                exit();
            }
        } else {
            header('Location: ../index.php?erreur');
            exit();
        }
    } else {
        header('Location: ../index.php?=error2');
        exit();
    }
} else {
    header('Location: ../index.php?erreurs');
    exit();
}
