<?php
session_start();
// on utilise le script verification_session.php
require_once('module/verification_session.php');
require('module/connexion.php');
// on fait une requete pour recuperer les informations de l'utilisateur dans toutes les tables
require './bibliotheque.php';
$result = infoclient();
$resultbank = infobank();
//affichage des informations de l'utilisateur
$title = 'Dashboard';
?>
<!DOCTYPE html>
<html lang="fr">
<?php require_once('header/header.php');
?>

<body>
     <div>

          <head>
               <?php require_once('bar/navbar.php'); ?>
          </head>
          <main>
               <div class="flex overflow-hidden bg-white pt-16">

                    <?php require_once('bar/sidebar.php'); ?>
                    <div class="bg-gray-900 opacity-50 hidden fixed inset-0 z-10" id="sidebarBackdrop">
                    </div>
                    <?php require_once('main/main.php'); ?>
               </div>

          </main>
          <script async defer src="https://buttons.github.io/buttons.js"></script>
          <script src="https://demo.themesberg.com/windster/app.bundle.js"></script>
     </div>
</body>

</html>