<?php
header('Content-Type: application/json');
require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Recette.class.php';
require '../classes/RecetteDB.class.php';
require '../classes/Composition.class.php';
require '../classes/CompositionDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $password);

$rc = new RecetteDB($cnx);


$recette = $rc->noter($_GET['recette'], $_GET['note']);
print json_encode($recette);


