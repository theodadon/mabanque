<?php
session_start();
require('connexion.php');
// On detruit la session et la connexion a la base de donnees
$db = null;
session_destroy();
header("Location: ../index.php");
exit();
