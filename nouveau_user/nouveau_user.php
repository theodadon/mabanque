<?php
session_start();
$title = "Mot de passe oublié";
?>
<!DOCTYPE html>
<html lang="fr">

<?php include("../header/header.php"); ?>

<body>

    <div class="flex h-screen bg-gray-100">
        <div class="m-auto">
            <div>
                <div class="mt-5 bg-white rounded-lg shadow">
                    <!-- formulaire d'inscription -->
                    <form method="POST" action="traitement_inscription.php">
                        <div class="flex">
                            <div class="flex-1 py-5 pl-5 overflow-hidden">
                                <h1 class="inline text-2xl font-semibold leading-none">Bienvenue !</h1>
                                <h3 class="inline text-2xl font-semibold leading-none">Remplissez ce formulaire :)</h3>
                            </div>
                        </div>
                        <div class="px-5 pb-5">
                            <div class="flex">
                                <div class="flex-grow w-2/4 pr-2">
                                    <input placeholder="Nom" name="nom" type="text" required class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-200 dark:focus:text-black focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                </div>
                                <div class="flex-grow">
                                    <input placeholder="Prénom" name="prenom" type="text" required class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-200 dark:focus:text-black focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                </div>
                            </div>
                            <div class="flex">
                                <div class="flex-grow w-2/4 pr-2">
                                    <input placeholder="Adresse" name="adresse" required class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-200 focus:outline-none dark:focus:text-black focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                </div>
                                <div class="flex-grow">
                                    <input placeholder="Ville" name="ville" required class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-200 focus:outline-none dark:focus:text-black focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                                </div>
                            </div>
                            <input placeholder="Téléphone" name="telephone" required type="tel" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-200 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <input placeholder="Email" name="email" type="email" required class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-200 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <input placeholder="Mot de passe" required name="mdp" type="password" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-200 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">
                            <input placeholder="Code Postal" name="cp" required type="num" class=" text-black placeholder-gray-600 w-full px-4 py-2.5 mt-2 text-base   transition duration-500 ease-in-out transform border-transparent rounded-lg bg-gray-200  focus:border-blueGray-500 focus:bg-white dark:focus:bg-gray-200 focus:outline-none focus:shadow-outline focus:ring-2 ring-offset-current ring-offset-2 ring-gray-400">

                        </div>
                        <input type="submit" value="Fini !" class="w-full px-4 py-2.5 mt-2 text-base font-semibold text-white transition duration-500 ease-in-out transform bg-blue-600 rounded-lg hover:bg-blue-700 focus:shadow-outline focus:outline-none focus:ring-2 ring-offset-current ring-offset-2">
                        <hr class="mt-4">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>