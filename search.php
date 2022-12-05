<?php
session_start();
require_once('module/verification_session.php');
require('module/connexion.php');
require('./bibliotheque.php');

// On divise le nom et le prénom de manière "esthétique"
$nom = explode(" ", $_GET['search-perso']);

// On récupère les données de la personne
$sth0 = $db->prepare("SELECT * FROM client WHERE nom_client = ? AND prenom_client = ?");
$sth0->bindParam(1, $nom[1], PDO::PARAM_STR);
$sth0->bindParam(2, $nom[0], PDO::PARAM_STR);
$sth0->execute();
$result_client = $sth0->fetch(PDO::FETCH_ASSOC);
$_SESSION["test"] = $result_client["id_client"];
$sth0->closeCursor();

// On récupère les données des mouvements de l'utisateur ciblé
$sth = $db->prepare("SELECT * FROM mouvement WHERE id_client = ? ORDER BY id_mouvement ASC");
$sth->bindParam(1, $result_client["id_client"], PDO::PARAM_INT);
$sth->execute();
$result_mouvement = $sth->fetchAll(PDO::FETCH_ASSOC);
$sth->closeCursor();

// On récupère les données des comptes de l'utilisateur ciblé
$sth1 = $db->prepare("SELECT * FROM compte WHERE id_client = ? ORDER BY id_compte ASC");
$sth1->bindParam(1, $result_client["id_client"], PDO::PARAM_INT);
$sth1->execute();
$result_compte = $sth1->fetch(PDO::FETCH_ASSOC);
$sth1->closeCursor();

// En fonction des posts, on effectue l'update ou le delete avec des paramètres différents
if (isset($_POST['update'])) {
    update("client", "client1", $result_client);
} elseif (isset($_POST['update1'])) {
    update("compte", "compte1", $result_compte);
} elseif (isset($_POST['update2'])) {
    update("mouvement", "mouvement1", $result_mouvement);
} elseif (isset($_POST['delete'])) {
    delete("client");
} elseif (isset($_POST['delete1'])) {
    delete("compte");
} elseif (isset($_POST['delete2'])) {
    delete("mouvement");
}


$title = "Recherche";
?>
<!DOCTYPE html>
<html lang="fr">
<?php
require('header/header.php');

?>


<body class="h-full">
    <?php require_once('bar/navbar2.php');
    ?>
    <div class="flex min-h-full items-center justify-center py-9 px-4 sm:px-6 lg:px-8">

        <div class="w-full max-w-md space-y-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Que voulez-vous consulter</h2>
            </div>
            <form class="mt-8 space-y-6" method="POST">
                <div class="flex grid-flow-row gap-2 -space-y-px rounded-md shadow-sm justify-center">
                    <button name="client" class=" items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Client</button>
                    <button name="compte" class="items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Compte</button>
                    <button name="mouvement" class="items-center bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Mouvement</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Affichage des données du client -->
    <?php if (isset($_POST['client'])) { ?>
        <div class="flex float-left items-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="compteur">
                        nb formulaire
                    </label>
                    <input id="compteur" name="compteur" type="text" value="1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
        </div>
        <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_client">
                        Id du client
                    </label>
                    <input id="id_client" name="id_client" type="text" value=<?php echo $result_client["id_client"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nom_client">
                        Nom du client
                    </label>
                    <input id="nom_client" name="nom_client" type="text" value=<?php echo $result_client["nom_client"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="prenom_client">
                        Prénom du client
                    </label>
                    <input id="prenom_client" name="prenom_client" type="text" value=<?php echo $result_client["prenom_client"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="adresse_client">
                        Adresse client
                    </label>
                    <input id="adresse_client" name="adresse_client" type="text" value="<?php echo $result_client["adresse_client"] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="code_postal_client">
                        code postal client
                    </label>
                    <input id="code_postal_client" name="code_postal_client" type="text" value=<?php echo $result_client["code_postal_client"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="ville_client">
                        Ville du client
                    </label>
                    <input id="ville_client" name="ville_client" type="text" value=<?php echo $result_client["ville_client"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <input value="update" name="update" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    </input>
                    <input value="delete" name="delete" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" type="submit">
                    </input>
                </div>
            </form>
        </div>
        <!-- Affichage des données du compte -->
    <?php } elseif (isset($_POST["compte"])) { ?>
        <div class="flex float-left items-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="compteur">
                        nb formulaire
                    </label>
                    <input id="compteur" name="compteur" type="text" value="1" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
        </div>
        <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_compte">
                        id du compte
                    </label>
                    <input id="id_compte" name="id_compte" type="text" value=<?php echo $result_compte["id_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_client">
                        id du client
                    </label>
                    <input id="id_client" name="id_client" type="text" value=<?php echo $result_compte["id_client"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="id_banque">
                        id de la banque
                    </label>
                    <input id="id_banque" name="id_banque" type="text" value=<?php echo $result_compte["id_banque"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email_compte">
                        email du compte
                    </label>
                    <input id="email_compte" name="email_compte" type="text" value=<?php echo $result_compte["email_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="telephone_compte">
                        telephone du compte
                    </label>
                    <input id="telephone_compte" name="telephone_compte" type="text" value=<?php echo $result_compte["telephone_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="numero_compte">
                        Numéro compte
                    </label>
                    <input id="numero_compte" name="numero_compte" type="text" value=<?php echo $result_compte["numero_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="solde_compte">
                        solde du compte
                    </label>
                    <input id="solde_compte" name="solde_compte" type="text" value=<?php echo $result_compte["solde_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date_ouverture_compte">
                        date d'ouverture
                    </label>
                    <input id="date_ouverture_compte" name="date_ouverture_compte" type="text" value=<?php echo $result_compte["date_ouverture_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="date_fermeture_compte">
                        date de fermeture
                    </label>
                    <?php if ($result_compte["date_fermeture_compte"] == NULL) { ?>
                        <input id="date_fermeture_compte" name="date_fermeture_compte" type="text" value="NULL" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php } else { ?>
                        <input id="date_fermeture_compte" name="date_fermeture_compte" type="text" value=<?php echo $result_compte["date_fermeture_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    <?php } ?>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mot_de_passe_compte">
                        Mot de passe
                    </label>
                    <input id="mot_de_passe_compte" name="mot_de_passe_compte" type="text" value=<?php echo $result_compte["mot_de_passe_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="cle_compte">
                        Clé du compte
                    </label>
                    <input id="cle_compte" name="cle_compte" type="text" value=<?php echo $result_compte["cle_compte"] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="iban_compte">
                        Iban
                    </label>
                    <input id="iban_compte" name="iban_compte" type="text" value="<?php echo $result_compte["iban_compte"] ?>" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                <div class="flex items-center justify-between">
                    <input value="update" name="update1" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    </input>
                    <input value="delete" name="delete1" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" type="submit">
                    </input>
                </div>
            </form>
        </div>
        <!-- affiche les données des mouvements -->
        <?php } elseif (isset($_POST["mouvement"])) {
        $compteur = 0;
        while ($compteur < count($result_mouvement)) {
            foreach ($result_mouvement as $key => $row) { ?>
                <div class="flex float-left items-center py-12 px-4 sm:px-6 lg:px-8">
                    <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="compteur">
                                nb formulaire
                            </label>
                            <input id="compteur" name="compteur" type="text" value=<?php echo $compteur;
                                                                                    $compteur++; ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                    </div>
                </div>
                <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
                    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="id_mouvement">
                                Id du mouvement
                            </label>
                            <input id="id_mouvement" name="id_mouvement" type="text" value=<?php echo $row['id_mouvement'] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="id_client">
                                id du client
                            </label>
                            <input id="id_client" name="id_client" type="text" value=<?php echo $row['id_client'] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="ancien_solde">
                                Ancien solde
                            </label>
                            <input id="ancien_solde" name="ancien_solde" type="text" value=<?php echo $row['ancien_solde'] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="nouveau_solde">
                                Nouveau solde
                            </label>
                            <input id="nouveau_solde" name="nouveau_solde" type="text" value=<?php echo $row['nouveau_solde'] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="mb-6">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="date_mouvement">
                                date du mouvement
                            </label>
                            <input id="date_mouvement" name="date_mouvement" type="text" value=<?php echo $row['date_mouvement'] ?> class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        </div>
                        <div class="flex items-center justify-between">
                            <input value="update" name="update2" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                            </input>
                            <input value="delete" name="delete2" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" type="submit">
                            </input>
                        </div>
                    </form>
                </div>
        <?php }
        }  ?>
    <?php }
    ?>



</body>

</html>