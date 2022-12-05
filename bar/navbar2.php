<?php
?>
<nav class="
  relative
  w-full
  flex flex-wrap
  items-center
  justify-between
  py-4
  bg-gray-100
  text-gray-500
  hover:text-gray-700
  focus:text-gray-700
  shadow-lg
  navbar navbar-expand-lg navbar-light
  ">
    <!-- Right elements -->
    <div class="flex min-w-full justify-center items-center space-x-4">
        <form action="index.php" method="POST">
            <button type="submit" name="deconnexion" class="btn btn-outline-danger">déconnexion</button>
        </form>
        <form action='testadmin.php'>
            <button type="submit" name="retour" class="btn btn-outline-danger">retour</button>

        </form>

    </div>

</nav>