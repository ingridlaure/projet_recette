<?php
header('Content-Type: application/json');
//chemin d'accès depuis le fichier ajax php
require '../db/dbPgConnect.php';
require '../classes/Connexion.class.php';
require '../classes/Recette.class.php';
require '../classes/RecetteDB.class.php';
require '../classes/Composition.class.php';
require '../classes/CompositionDB.class.php';
$cnx = Connexion::getInstance($dsn, $user, $password);

$rc = new RecetteDB($cnx);
$cp = new CompositionDB($cnx);

extract($_POST, EXTR_OVERWRITE);
if (isset($_FILES['image_recette'])) {
    $image = $_FILES['image_recette']['name'];
    $image2 = $_FILES['image_recette']['tmp_name'];
    $ext = $_FILES['image_recette']['type'];
    $error = $_FILES['image_recette']['error'];
    $extension_upload = strtolower(substr(strrchr($ext, '.'), 1));
    var_dump($_FILES);
}
$path = "./public/images/" . $image . "." . $extension_upload;
if (!file_exists($path)) {
    $resultat = move_uploaded_file($image2, $path);
}
$recette[] = $rc->ajout_recette($_POST['nom_recette'], $_POST['description'], $_POST['nombre_part'], $image, $_POST['temps_cuisson'], $_POST['chef'], $_POST['difficulte'], $_POST['categorie']);
for ($count = 0; $count < count($_POST['ingredient_name']); $count++) {
    $data[] = $cp->ajout_ingredient($recette['id_recette'], $_POST['ingredient_name'][$count], $_POST['ingredient_quantity'][$count], $_POST['ingredient_unit'][$count]);
}

/*$data[] = $cl->ajout_chef($_POST['nom'],$_GET['prenom'],$_GET['experience'],$_GET['email'],$_GET['telephone'],$_GET['adresse']);
print json_encode($data);*/


