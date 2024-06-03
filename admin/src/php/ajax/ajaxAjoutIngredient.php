<?php

header('Content-Type: application/json');
require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Recette.class.php';
require '../classes/RecetteDB.class.php';
require '../classes/Composition.class.php';
require '../classes/CompositionDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $password);

$cp = new CompositionDB($cnx);

$id=$cp->derniereRecette();
var_dump($id);

for ($count = 0; $count < $_GET['nombre']; $count++) {
    $data[] = $cp->ajout_ingredient($id[0], $_GET['ingredient'.$count], $_GET['quantity'.$count], $_GET['unit'.$count]);
}

print json_encode($data);






