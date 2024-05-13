<?php

header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Chef.class.php';
require '../classes/ChefDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $password);

$cl = new ChefDB($cnx);
$data[] = $cl->updateChef($_GET['id'],$_GET['name'],$_GET['valeur']);
print json_encode($data);


