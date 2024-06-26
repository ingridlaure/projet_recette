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
$cp = new CompositionDB($cnx);


$recette= $rc->ajout_recette($_GET['nom_recette'], $_GET['description'], $_GET['nbre_part'],$_GET['temps'], $_GET['chef'], $_GET['niveau'], $_GET['categorie']);
print json_encode($recette);




