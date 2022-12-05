<?php
//On vérifie que le formulaire est vide

?>
<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<?php
$title = "Connexion";
include('header/header.php');

?>

<body class="h-full">

  <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-md space-y-8">
      <div>
        <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
        <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Votre espace bancaire</h2>
      </div>
      <form class="mt-8 space-y-6" action="module/auth.php" method="POST">
        <div class="-space-y-px rounded-md shadow-sm">
          <div>
            <label for="email" class="sr-only">Adresse Email</label>
            <!-- si le cookie existe, on affiche la valeur du cookie -->
            <?php if (isset($_COOKIE['email'])) { ?>
              <input id="email" name="email" type="email" value="<?php echo htmlspecialchars($_COOKIE["email"]); ?>" autocomplete=" email" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500" />
            <?php } else { ?>
              <input id="email" name="email" type="email" autocomplete="email" required class="relative block w-full appearance-none rounded-none rounded-t-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none invalid:border-pink-500 invalid:text-pink-600 focus:invalid:border-pink-500 focus:invalid:ring-pink-500" placeholder="exemple@exemple.com" />
            <?php } ?>
          </div>
          <div>
            <label for="password" class="sr-only">Mot de passe</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required class="relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm" placeholder="Mot de passe">
          </div>
        </div>

        <div class="flex items-center justify-center">
          <div class="text-sm">
            <div class="flex items-center justify-center">
              <div class="flex-grow w-3/4 pr-2">
                <a href="pb_mdp/mdp_oublie.php" class="font-medium text-indigo-600 hover:text-indigo-500 justify-center">Mot de passe oublié ?</a>
              </div>
              <div class="flex-grow">
                <a href="nouveau_user/nouveau_user.php" class="font-medium text-indigo-600 hover:text-indigo-500 justify-center">Inscription</a>
              </div>
              <?php if (isset($_GET['error'])) { ?>
                <p class="font-medium text-red-600 justify-center">Mdp ou id faux</p>
              <?php } ?>
            </div>
          </div>
        </div>
        <div>
          <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
              <!-- Heroicon name: mini/lock-closed -->
              <svg class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z" clip-rule="evenodd" />
              </svg>
            </span>
            Connexion
          </button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>