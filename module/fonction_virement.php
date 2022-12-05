<?php
session_start();

function faire_virement()
{
    require_once('verification_session.php');
    require('connexion.php');
    // On assigne et securise les variables afin d'eviter les attaques XSS
    $prenom_virement = htmlspecialchars($_POST['grid-first-name']);
    $nom_virement = htmlspecialchars($_POST['grid-last-name']);
    $iban_virement = htmlspecialchars($_POST['grid-iban']);
    $montant_virement = htmlspecialchars($_POST['grid-montant']);
    $date = date("Y-m-d H:i:s");
    $id = 3;
    // On verifie si le compte existe
    if ($sth = $db->prepare("SELECT compte.id_compte FROM compte INNER JOIN client WHERE (client.nom_client = ? AND client.prenom_client = ?) AND (compte.id_compte=client.id_client) AND compte.iban_compte=?;")) {
        $sth->bindParam(1, $nom_virement, PDO::PARAM_STR);
        $sth->bindParam(2, $prenom_virement, PDO::PARAM_STR);
        $sth->bindParam(3, $iban_virement, PDO::PARAM_STR);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_ASSOC);
        // On verifie que ce n'est pas le même compte que celui de l'utilisateur
        if ($result['id_compte'] == $_SESSION['id']) {
            echo "Vous ne pouvez pas faire un virement à vous même";
        }
        // si il y a plus d'1 résultat 
        if ($sth->rowCount() > 0) {
            // On récupère le solde de l'utilisateur
            if ($sth1 = $db->prepare("SELECT solde_compte FROM compte WHERE id_compte= ?")) {
                $sth1->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $sth1->execute();
                $result1 = $sth1->fetch(PDO::FETCH_ASSOC);
                // Si le solde de l'émetteur est négatif on met le solde en positif pour 
                //eviter le - et - = +
                if ($resultat1['solde_compte'] < 0) {
                    $resultat1['solde_compte'] = $result1['solde_compte'] * -1;
                }
            } else {
                header('Location: ../virement.php?error=2');
                exit();
            }
            // On récupère le solde du destinataire
            if ($sth2 = $db->prepare("SELECT solde_compte FROM compte WHERE id_compte= ?")) {
                $sth2->bindParam(1, $result['id_compte'], PDO::PARAM_INT);
                $sth2->execute();
                $result2 = $sth2->fetch(PDO::FETCH_ASSOC);
                // Si le solde du destinataire est négatif on met le solde en positif pour
                // eviter le + et - = -
                if ($resultat2['solde_compte'] < 0) {
                    $resultat2['solde_compte'] = $result2['solde_compte'] * -1;
                }
            } else {
                header('Location: ../virement.php?error=3');
                exit();
            }
            // On laisse une trace de la transaction dans la table transaction
            if ($sth3 = $db->prepare("INSERT INTO transaction (id_compte_emetteur,id_compte_recepteur,montant_transaction,date_transaction) VALUES (?,?,?,?)")) {
                $sth3->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $sth3->bindParam(2, $result['id_compte'], PDO::PARAM_INT);
                $sth3->bindParam(3, $montant_virement, PDO::PARAM_INT);
                $sth3->bindParam(4, $date, PDO::PARAM_STR);
                $sth3->execute();
            } else {
                header('Location: ../virement.php?error=4');
                exit();
            }
            // on laisse un trace individuelle de la transaction dans la table mouvement
            if ($sth4 = $db->prepare("INSERT INTO mouvement (id_client,ancien_solde,nouveau_solde,date_mouvement) VALUES (?,?,?,?)")) {
                $sth4->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $sth4->bindParam(2, $result1['solde_compte'], PDO::PARAM_INT);
                $test = $result1['solde_compte'] - $montant_virement;
                $sth4->bindParam(3, $test, PDO::PARAM_INT);
                $sth4->bindParam(4, $date, PDO::PARAM_STR);
                $sth4->execute();
            } else {
                header('Location: ../virement.php?error=5');
                exit();
            }
            // on laisse un trace individuelle de la transaction dans la table mouvement
            if ($sth5 = $db->prepare("INSERT INTO mouvement (id_client,ancien_solde,nouveau_solde,date_mouvement) VALUES (?,?,?,?)")) {
                $sth5->bindParam(1, $result['id_compte'], PDO::PARAM_INT);
                $sth5->bindParam(2, $result2['solde_compte'], PDO::PARAM_INT);
                $test1 = $result2['solde_compte'] + $montant_virement;
                $sth5->bindParam(3, $test1, PDO::PARAM_INT);
                $sth5->bindParam(4, $date, PDO::PARAM_STR);
                $sth5->execute();
            } else {
                header('Location: ../virement.php?error=6');
                exit();
            }
            // On met à jour le solde de l'émetteur
            if ($sth6 = $db->prepare("UPDATE compte SET solde_compte = ? WHERE id_compte = ?")) {
                $test2 = $result1['solde_compte'] - $montant_virement;
                $sth6->bindParam(1, $test2, PDO::PARAM_INT);
                $sth6->bindParam(2, $_SESSION['id'], PDO::PARAM_INT);
                $sth6->execute();
            } else {
                header('Location: ../virement.php?error=7');
                exit();
            }
            // On met à jour le solde du destinataire
            if ($sth7 = $db->prepare("UPDATE compte SET solde_compte = ? WHERE id_compte = ?")) {
                $test3 = $result2['solde_compte'] + $montant_virement;
                $sth7->bindParam(1, $test3, PDO::PARAM_INT);
                $sth7->bindParam(2, $result['id_compte'], PDO::PARAM_INT);
                $sth7->execute();
            } else {
                header('Location: ../virement.php?error=8');
                exit();
            }
            header('Location: ../main/virement.php?success=1');
            exit();
            // cas ou il n'y pas de destinataire connu
        } else {
            // On récupère le solde de l'utilisateur
            if ($sth1 = $db->prepare("SELECT solde_compte FROM compte WHERE id_compte= ?")) {
                $sth1->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $sth1->execute();
                $result1 = $sth1->fetch(PDO::FETCH_ASSOC);
                //eviter le - et - = +
                if ($resultat1['solde_compte'] < 0) {
                    $resultat1['solde_compte'] = $result1['solde_compte'] * -1;
                }
            } else {
                header('Location: ../virement.php?error=2');
                exit();
            }
            // On récupère le solde du destinataire
            if ($sth2 = $db->prepare("SELECT solde_compte FROM compte WHERE id_compte= ?")) {
                $sth2->bindParam(1, $id, PDO::PARAM_INT);
                $sth2->execute();
                $result2 = $sth2->fetch(PDO::FETCH_ASSOC);
                //eviter le + et - = -
                if ($resultat2['solde_compte'] < 0) {
                    $resultat2['solde_compte'] = $result2['solde_compte'] * -1;
                }
            } else {
                header('Location: ../virement.php?error=3');
                exit();
            }
            // On laisse une trace de la transaction dans la table transaction avec comme destinataire la banque
            if ($sth3 = $db->prepare("INSERT INTO transaction (id_compte_emetteur,id_compte_recepteur,montant_transaction,date_transaction) VALUES (?,?,?,?)")) {
                $sth3->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $sth3->bindParam(2, $id, PDO::PARAM_INT);
                $sth3->bindParam(3, $montant_virement, PDO::PARAM_INT);
                $sth3->bindParam(4, $date, PDO::PARAM_STR);
                $sth3->execute();
            } else {
                header('Location: ../virement.php?error=4');
                exit();
            }
            // on laisse un trace individuelle de la transaction dans la table mouvement
            if ($sth4 = $db->prepare("INSERT INTO mouvement (id_client,ancien_solde,nouveau_solde,date_mouvement) VALUES (?,?,?,?)")) {
                $sth4->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
                $sth4->bindParam(2, $result1['solde_compte'], PDO::PARAM_INT);
                $test = $result1['solde_compte'] - $montant_virement;
                $sth4->bindParam(3, $test, PDO::PARAM_INT);
                $sth4->bindParam(4, $date, PDO::PARAM_STR);
                $sth4->execute();
            } else {
                header('Location: ../virement.php?error=5');
                exit();
            }
            // On laisse un trace individuelle de la transaction dans la table mouvement
            if ($sth5 = $db->prepare("INSERT INTO mouvement (id_client,ancien_solde,nouveau_solde,date_mouvement) VALUES (?,?,?,?)")) {
                $sth5->bindParam(1, $id, PDO::PARAM_INT);
                $sth5->bindParam(2, $result2['solde_compte'], PDO::PARAM_INT);
                $test1 = $result2['solde_compte'] + $montant_virement;
                $sth5->bindParam(3, $test1, PDO::PARAM_INT);
                $sth5->bindParam(4, $date, PDO::PARAM_STR);
                $sth5->execute();
            } else {
                header('Location: ../virement.php?error=6');
                exit();
            }
            // On met à jour le solde de l'émetteur
            if ($sth6 = $db->prepare("UPDATE compte SET solde_compte = ? WHERE id_compte = ?")) {
                $test2 = $result1['solde_compte'] - $montant_virement;
                $sth6->bindParam(1, $test2, PDO::PARAM_INT);
                $sth6->bindParam(2, $_SESSION['id'], PDO::PARAM_INT);
                $sth6->execute();
            } else {
                header('Location: ../virement.php?error=7');
                exit();
            }
            // On met à jour le solde du destinataire
            if ($sth7 = $db->prepare("UPDATE compte SET solde_compte = ? WHERE id_compte = ?")) {
                $test3 = $result2['solde_compte'] + $montant_virement;
                $sth7->bindParam(1, $test3, PDO::PARAM_INT);
                $sth7->bindParam(2, $id, PDO::PARAM_INT);
                $sth7->execute();
            } else {
                header('Location: ../virement.php?error=8');
                exit();
            }
            header('Location: ../main/virement.php?success=1');
            exit();
        }
    } else {
        header('Location: ../virement.php?error=0');
        exit();
    }
}
//on execute la fonction
faire_virement();
