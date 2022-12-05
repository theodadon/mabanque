<?php

//fonction qui affiche en vert toutes les rentrées d'argents
function transactionUp()
{
    require_once('module/verification_session.php');
    require('module/connexion.php');
    $sth = $db->prepare("SELECT client.nom_client,client.prenom_client,transaction.montant_transaction,transaction.date_transaction FROM client INNER JOIN transaction ON (client.id_client = transaction.id_compte_emetteur) AND transaction.id_compte_recepteur = ?");
    $sth->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $sth = null;

    //afficher tous les resultats de la requete dans un tableau
    foreach ($result as $row) {
?>
        <tr class="bg-green-50">
            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                <span class="font-semibold"><?php echo $row['nom_client'] . ' ' . $row['prenom_client']; ?></span>
            </td>
            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                <span class="font-semibold"><?php echo $row['date_transaction']; ?></span>
            </td>
            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                <span class="font-semibold"><?php echo "+" . $row['montant_transaction']; ?></span>
            </td>
        </tr>
    <?php
    }
}

//fonction qui affiche en rouge toutes les sorties d'argents
function transactionDown()
{
    require_once('module/verification_session.php');
    require('module/connexion.php');
    $sth = $db->prepare("SELECT client.nom_client,client.prenom_client,transaction.montant_transaction,transaction.date_transaction 
    FROM client 
    INNER JOIN transaction 
    ON (client.id_client = transaction.id_compte_recepteur) AND transaction.id_compte_emetteur = ?");
    $sth->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $sth = null;

    //afficher tous les resultats de la requete dans un tableau
    foreach ($result as $row) {
    ?>
        <tr class="bg-red-50">
            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-900">
                <span class="font-semibold"><?php echo $row['nom_client'] . ' ' . $row['prenom_client']; ?></span>
            </td>
            <td class="p-4 whitespace-nowrap text-sm font-normal text-gray-500">
                <span class="font-semibold"><?php echo $row['date_transaction']; ?></span>
            </td>
            <td class="p-4 whitespace-nowrap text-sm font-semibold text-gray-900">

                <span class="font-semibold"><?php echo "-" . $row['montant_transaction']; ?></span>
            </td>
        <?php
        echo "</tr>";
    }
}
//fonction qui affiche les informations du compte
function infoclient()
{
    require_once('module/verification_session.php');
    require('module/connexion.php');
    $sth = $db->prepare("SELECT * FROM client INNER JOIN compte ON client.id_client = compte.id_client AND client.id_client=?");
    $sth->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetch(PDO::FETCH_ASSOC);
    $sth = null;
    return $result;
}

//fonction qui affiche les informations de la banque
function infobank()
{
    require_once('module/verification_session.php');
    require('module/connexion.php');
    $sth = $db->prepare("SELECT * FROM banque INNER JOIN compte ON banque.id_banque = compte.id_banque AND compte.id_client=?");
    $sth->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
    $sth->execute();
    $resultbank = $sth->fetch(PDO::FETCH_ASSOC);
    $sth = null;
    return $resultbank;
}

//transforme les posts du formulaire dans une variables session
function post_to_session($i)
{
    $e = array();
    array_push($e, $_POST);
    $e = array_pop($e);
    $f = array_pop($e);
    $_SESSION[$i] = $e;
    return $_SESSION[$i];
}
//transforme tous les résultats de la requete en une variable session
function mettre_en_session($i, $o)
{
    $e = array();
    foreach ($o as $value) {
        array_push($e, $value);
    }
    $_SESSION[$i] = $o;
    return $_SESSION[$i];
}
//Sert à mettre à jour les informations 
function update($nom, $nom1, $result)
{
    require('module/connexion.php');
    $a = post_to_session($nom);
    $e = mettre_en_session($nom1, $result);
    //boucle qui compare les valeurs de la variable session et de la requete
    foreach ($a as $key => $value) {
        if ($value != $e[$key]) {
            if ($key == 'mot_de_passe_compte') {
                $z = $_SESSION["test"];
                $a = hash('sha512', $value);
                $sth = $db->prepare(" UPDATE $nom SET $key = '$a' WHERE id_client = $z ");
                $sth->execute();
            } else {
                $z = $_SESSION["test"];
                $sth = $db->prepare(" UPDATE $nom SET $key = '$value' WHERE id_client = $z ");
                $sth->execute();
            }
        }
    }
}
//fonction qui supprime les données d'un enregistrement
function delete($nom)
{
    require('module/connexion.php');
    $z = $_SESSION["test"];
    $sth = $db->prepare(" DELETE * FROM $nom WHERE id_client = $z ");
    $sth->execute();
}

//fonction qui permet le graphique montrant le graphique des transactions
function montantshow()
{
    require_once('module/verification_session.php');
    require('module/connexion.php');
    $sth = $db->prepare("SELECT nouveau_solde,date_mouvement FROM mouvement WHERE id_client = ? ORDER BY date_mouvement ASC");
    $sth->bindParam(1, $_SESSION['id'], PDO::PARAM_INT);
    $sth->execute();
    $result = $sth->fetchAll(PDO::FETCH_ASSOC);
    $sth = null;
    $dataPoints = array();
    foreach ($result as $row) {
        array_push($dataPoints, array("y" => $row['nouveau_solde'], "label" => $row['date_mouvement']));
    }
        ?>
        <script>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {

                    data: [{
                        type: "line",
                        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

            }
        </script>
        <div id="chartContainer" style="height: 370px; width: 100%;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <?php
}
    ?>