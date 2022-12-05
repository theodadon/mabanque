<?php
session_start();
require('../module/connexion.php');
// On sécurise les variables afin d'éviter les attaques XSS
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlspecialchars($_POST['prenom']);
$adresse = htmlspecialchars($_POST['adresse']);
$ville = htmlspecialchars($_POST['ville']);
$code_postal = htmlspecialchars($_POST['cp']);
$telephone = htmlspecialchars($_POST['telephone']);
$mdp = htmlspecialchars($_POST['mdp']);
$mdp = hash('sha512', $mdp);
$mail = htmlspecialchars($_POST['email']);

// on insère les données du formulaire dans la table client
if ($sth = $db->prepare("INSERT INTO client (nom_client,prenom_client,adresse_client,code_postal_client,ville_client) VALUES (?,?,?,?,?)")) {
    $sth->bindParam(1, $nom, PDO::PARAM_STR);
    $sth->bindParam(2, $prenom, PDO::PARAM_STR);
    $sth->bindParam(3, $adresse, PDO::PARAM_STR);
    $sth->bindParam(4, $code_postal, PDO::PARAM_STR);
    $sth->bindParam(5, $ville, PDO::PARAM_STR);
    $sth->execute();
    $sth->closeCursor();
    //on récupère l'id du client crée
    if ($sth = $db->prepare("SELECT id_client FROM client WHERE nom_client = ? AND prenom_client = ?")) {
        $sth->bindParam(1, $nom, PDO::PARAM_STR);
        $sth->bindParam(2, $prenom, PDO::PARAM_STR);
        $sth->execute();
        $id_client = $sth->fetch();
        $sth->closeCursor();
        $numero_compte = rand(55500000000, 55599999999);
        // on vérifie que le numéro de compte n'existe pas déjà
        if ($sth = $db->prepare("SELECT numero_compte FROM compte where numero_compte = ?")) {
            $sth->bindParam(1, $numero_compte, PDO::PARAM_INT);
            $sth->execute();
            $result = $sth->fetch();
            $sth->closeCursor();
            // s'il n'existe pas on l'utilise pour le client
            if (empty($result)) {
                $cle = 32;
                $iban = "FR 1028 0372 7" . $numero_compte . $cle;
                if ($sth = $db->prepare("INSERT INTO compte (id_client,mot_de_passe_compte,email_compte,numero_compte,cle_compte,date_ouverture_compte,telephone_compte,iban_compte,id_banque) VALUES (?,?,?,?,?,?,?,?,1)")) {
                    $sth->bindParam(1, $id_client['id_client'], PDO::PARAM_INT);
                    $sth->bindParam(2, $mdp, PDO::PARAM_STR);
                    $sth->bindParam(3, $mail, PDO::PARAM_STR);
                    $sth->bindParam(4, $numero_compte, PDO::PARAM_INT);
                    $sth->bindParam(5, $cle, PDO::PARAM_INT);
                    $sth->bindParam(6, date("Y-m-d"), PDO::PARAM_STR);
                    $sth->bindParam(7, $telephone, PDO::PARAM_INT);
                    $sth->bindParam(8, $iban, PDO::PARAM_STR);
                    $sth->execute();
                    $sth->closeCursor();
                    header('Location: ../index.php');
                } else {
                    echo "Erreur lors de l'insertion du compte";
                }
                // sinon on recommence avec un nouveau numéro de compte
            } else {
                $numero_compte = rand(55550000000, 55599999999);
                $cle = 32;
                $iban = "FR 1028 0372 7" . $numero_compte . $cle;
                if ($sth = $db->prepare("INSERT INTO compte (id_client,mot_de_passe_compte,email_compte,numero_compte,cle_compte,date_ouverture_compte,telephone_compte,iban_compte,id_banque) VALUES (?,?,?,?,?,?,?,?,1)")) {
                    $sth->bindParam(1, $id_client["id_client"], PDO::PARAM_INT);
                    $sth->bindParam(2, $mdp, PDO::PARAM_STR);
                    $sth->bindParam(3, $mail, PDO::PARAM_STR);
                    $sth->bindParam(4, $numero_compte, PDO::PARAM_INT);
                    $sth->bindParam(5, 33, PDO::PARAM_INT);
                    $sth->bindParam(6, date("Y-m-d"), PDO::PARAM_STR);
                    $sth->bindParam(7, $telephone, PDO::PARAM_STR);
                    $sth->bindParam(8, $iban, PDO::PARAM_STR);
                    $sth->execute();
                    $sth->closeCursor();
                    header('Location: ../index.php');
                } else {
                    echo "Erreur lors de l'insertion du compte";
                }
            }
        } else {
            echo "Erreur de requête";
        }
    }
} else {
    echo "Erreur";
}
