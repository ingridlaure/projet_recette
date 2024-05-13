<?php
header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Chef.class.php';
require '../classes/ChefDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $password);

$cl = new ChefDB($cnx);
$data[] = $cl->ajout_chef($_GET['nom'],$_GET['prenom'],$_GET['experience'],$_GET['email'],$_GET['telephone'],$_GET['adresse']);
print json_encode($data);


