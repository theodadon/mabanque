<?php

// Cette page permet de consulter seulement, pas de modifier
session_start();
require_once('module/verification_session.php');
require('module/connexion.php');
$sth = $db->prepare("SELECT * FROM mouvement ORDER BY id_mouvement ASC");
$sth->execute();
$result_mouvement = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth = null;
$sth1 = $db->prepare("SELECT * FROM compte ORDER BY id_compte ASC");
$sth1->execute();
$result_compte = $sth1->fetchAll(PDO::FETCH_ASSOC);
$sth1 = null;
$sth2 = $db->prepare("SELECT * FROM client ORDER BY id_client ASC");
$sth2->execute();
$result_client = $sth2->fetchAll(PDO::FETCH_ASSOC);
$sth2 = null;
$sth3 = $db->prepare("SELECT * FROM banque");
$sth3->execute();
$result_banque = $sth3->fetchAll(PDO::FETCH_ASSOC);
$sth3 = null;
$sth4 = $db->prepare("SELECT * FROM transaction ORDER BY id_transaction ASC");
$sth4->execute();
$result_transaction = $sth4->fetchAll(PDO::FETCH_ASSOC);
$sth4 = null;

$title = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="fr">
<?php
require('header/header.php');
?>

<body class="h-full">
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Que voulez-vous consulter</h2>
            </div>
            <form class="mt-8 space-y-6" method="POST">
                <div class="flex grid-flow-row gap-2 -space-y-px rounded-md shadow-sm">
                    <button name="client" class=" items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Client</button>
                    <button name="compte" class="items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Compte</button>
                    <button name="mouvement" class="items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Mouvement</button>
                    <button name="transaction" class="items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Transaction</button>
                    <button name="banque" class="justify-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Banque</button>
                </div>
            </form>
            <div>
                <h5 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Rechercher par client</h2>
            </div>
            <form class="mt-8 space-y-6" action="search.php" method="GET">
                <div class="flex grid-flow-row gap-2 -space-y-px rounded-md shadow-sm items-center justify-center">
                    <input name="search-perso" placeholder="Paul Dupont" required type="text" class=" items-center bg-transparent hover:bg-blue-100 text-white-700 font-semibold hover:text-blue py-2 px-4 border border-blue-500 hover:border-transparent rounded"></input>
                </div>
            </form>
        </div>
    </div>
    <?php
    // affiche tous les clients de la base de données
    if (isset($_POST['client']) && !empty($result_client)) { ?>
        <div class="flex min-h-full items-center justify-center flex-col py-15 px-6 sm:px-6 lg:px-30">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden">
                        <!-- table client -->
                        <table class="min-w-full grid-flow-col-dense">
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Nom
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Prénom
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Adresse
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Code Postal
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Ville
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result_client as $key => $row) { ?>
                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_client']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['nom_client']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['prenom_client']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['adresse_client']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['code_postal_client']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['ville_client']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } elseif (isset($_POST['compte']) && !empty($result_compte)) {
        //affiche tous les comptes de la base de données
    ?>
        <div class="grid grid-t min-h-full items-center justify-center flex-col py-15 px-30 sm:px-6 lg:px-30 overflow-hidden-y overflow-scroll-x">
            <div class="overflow-x-auto">
                <div class="py-2 inline-block min-w-full">
                    <div>
                        <!-- table client -->
                        <table>
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id du compte
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id du client
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id de la banque
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        email
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        telephone
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        numero de compte
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        solde du compte
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        date de creation
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        date de fermeture </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        Mot de passe
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        clé de compte
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        iban
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result_compte as $row) { ?>
                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_compte']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_client']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_banque']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['email_compte']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['telephone_compte']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['numero_compte']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['solde_compte']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['date_ouverture_compte']; ?>
                                        </td>
                                        <td class='text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap'>
                                            <?php $row['date_fermeture_compte'];
                                            ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['mot_de_passe_compte']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['cle_compte']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['iban_compte']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } elseif (isset($_POST['mouvement']) && !empty($result_mouvement)) {
        //affiche tous les mouvements de la base de données
    ?>
        <div class="grid grid-t min-h-full items-center justify-center flex-col py-15 px-30 sm:px-6 lg:px-30 overflow-hidden-y overflow-scroll-x">
            <div class="overflow-x-auto">
                <div class="py-2 inline-block min-w-full">
                    <div>
                        <!-- table client -->
                        <table>
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id du mouvement
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id du client
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        ancien solde
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        nouveau solde
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        date & heure
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result_mouvement as $row) { ?>
                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_mouvement']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_client']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['ancien_solde']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['nouveau_solde']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['date_mouvement']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } elseif (isset($_POST['transaction']) && !empty($result_transaction)) {
        //affiche toutes les transactions de la base de données
    ?>
        <div class="grid grid-t min-h-full items-center justify-center flex-col py-15 px-30 sm:px-6 lg:px-30 overflow-hidden-y overflow-scroll-x">
            <div class="overflow-x-auto">
                <div class="py-2 inline-block min-w-full">
                    <div>
                        <!-- table client -->
                        <table>
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id de la transaction
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id de l'emetteur
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id du recepteur
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        montant
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        date & heure
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result_transaction as $row) { ?>
                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_transaction']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_compte_emetteur']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_compte_recepteur']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['montant_transaction']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['date_transaction']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } elseif (isset($_POST['banque']) && !empty($result_banque)) {
        //affiche les données de la banque 
    ?>

        <div class="grid grid-t min-h-full items-center justify-center flex-col py-15 px-30 sm:px-6 lg:px-30 overflow-hidden-y overflow-scroll-x">
            <div class="overflow-x-auto">
                <div class="py-2 inline-block min-w-full">
                    <div>
                        <!-- table client -->
                        <table>
                            <thead class="border-b">
                                <tr>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id de la banque
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        nom
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        adresse
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        telephone
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        email
                                    </th>
                                    <th scope="col" class="text-sm font-medium text-gray-900 px-6 py-4 text-left">
                                        id/guichet/BIC
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($result_banque as $row) { ?>
                                    <tr class="border-b">
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_banque']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['nom_banque']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['adresse_banque'] . ',' . $row['code_postal_banque'] . ' ' . $row['ville_banque']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['telephone_banque']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['email_banque']; ?>
                                        </td>
                                        <td class="text-sm text-gray-900 font-light px-6 py-4 whitespace-nowrap">
                                            <?php echo $row['id_inter_banque'] . '/' . $row['guichet_banque'] . '/' . $row['bic_banque']; ?>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } ?>
</body>

</html>