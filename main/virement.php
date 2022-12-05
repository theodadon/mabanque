<?php
session_start();

//page permettant de faire des virements
require_once('../module/verification_session.php');
require('../module/connexion.php');
$title = "Virement";
?>
<!DOCTYPE html>
<html lang="fr" class="h-full">
<?php require_once('../header/header.php'); ?>

<body class="h-full">
  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Virement</h2>
      </div>
      <form class="w-full max-w-lg border border-gray-300 px-3 rounded-xl" method="POST" action="../module/fonction_virement.php">
        <div class="flex flex-wrap -mx-4 mb-6">
          <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-first-name">
              Son prénom
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-first-name" name="grid-first-name" type="text" placeholder="Jane" required>
          </div>
          <div class="w-full md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-last-name">
              Son nom
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-last-name" name="grid-last-name" type="text" placeholder="Doe" required>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-iban">
              Son Iban
            </label>
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-iban" name="grid-iban" type="text" placeholder="FR7610101010100101001010010" required>
            <p class="text-gray-600 text-xs italic">Mettez les espaces</p>
          </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
          <div class="w-full px-3">
            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="grid-montant">
              Montant
            </label>
            <!-- input avec un pattern pour ne pas pouvoir mettre autre chose qu'un nombre -->
            <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-montant" name="grid-montant" type="text" placeholder="100" required pattern="[0-9]+">
          </div>
        </div>
        <div class="flex items-center justify-center">
          <button type="submit" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">effectuer</button>
        </div>
      </form>
      <form action="../dashboard.php">
        <div class="flex items-center justify-center">
          <button type="submit" class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">Retour</button>
        </div>
      </form>

    </div>
  </div>
</body>

</html>