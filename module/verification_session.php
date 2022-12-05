<?php
//s'il n'y a pas de session alors on redirige vers la page d'index
if (!isset($_SESSION['loggedin'])) {
    header('Location: ../index.php');
    exit;
}
?>