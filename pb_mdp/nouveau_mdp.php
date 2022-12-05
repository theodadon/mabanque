<?php
session_start();
require('../module/connexion.php');
require('../module/verification_session.php');



if (isset($_POST['password']) and isset($_POST['confirm'])) {
    $password = htmlspecialchars($_POST['password']);
    $confirm = htmlspecialchars($_POST['confirm']);
    if ($password == $confirm) {

        if ($sth = $db->prepare("UPDATE compte SET mot_de_passe_compte = SHA2(?,512) WHERE id_compte = ?")) {
            $sth->bindParam(1, $password, PDO::PARAM_STR);
            $sth->bindParam(2, $_SESSION['id_client'], PDO::PARAM_INT);
            $sth->execute();
            $sth->closeCursor();
            header('Location: ../index.php?success');
            exit();
        } else {
            header('Location: ../index.php?erreur');
            exit();
        }
    } else {
        header('Location: nouveau_mdp?erreur=2');
        exit();
    }
}
$title = "Nouveau mot de passe";
?>
<!DOCTYPE html>
<html lang="fr">
<?php include('../header/header.php'); ?>

<body>
    <div class="relative flex min-h-screen text-gray-800 antialiased flex-col justify-center overflow-hidden bg-gray-50 py-6 sm:py-12">
        <div class="relative py-3 sm:w-96 mx-auto text-center">
            <span class="text-2xl font-light ">Changement de mdp</span>
            <div class="mt-4 bg-white shadow-md rounded-lg text-left">
                <div class="h-2 bg-blue-400 rounded-t-md">

                </div>
                <form method="POST">
                    <div class="px-8 py-6 ">
                        <label class="block font-semibold"> Nouveau mot de passe</label>
                        <input type="password" name="password" required placeholder="Mot de passe" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md">
                        <label class="block mt-3 font-semibold"> Confirmer mot de passe</label>
                        <input type="password" name="confirm" required placeholder="Mot de passe" class="border w-full h-5 px-3 py-5 mt-2 hover:outline-none focus:outline-none focus:ring-indigo-500 focus:ring-1 rounded-md">
                        <?php if (isset($_GET['erreur'])) {
                            if ($_GET['erreur'] == 2) {
                                echo "<p class='text-red-500'>Les mots de passe ne correspondent pas</p>";
                            }
                        } ?>
                        <div class="flex justify-center items-baseline">
                            <button type="submit" class="mt-4 bg-blue-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 ">Confirmer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
</body>


</html>