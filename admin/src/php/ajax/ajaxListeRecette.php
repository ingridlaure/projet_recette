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
$liste = null;


/*if (isset($_GET['categorie'])) {
    $liste = $rc->getRecettesCategorie(['categorie']);
}
if (isset($_GET['nom'])) {
    $liste = $rc->getRecettesNom($_GET['nom']);
}
if (isset($_GET['nom']) && isset($_GET['categorie'])){
    $liste = $rc->getRecettesNomCategorie($_GET['nom'], ['categorie']);
}
if (isset($_GET['nom']) && isset($_GET['categorie'])) {
    $liste = $rc->getRecttes($cond);
}*/
$cat = $_POST['categorie'];
if ($cat != "tous") {
    $cond = " where categorie='" . $cat . "'";
} else {
    $cond = '';
}
$liste = $rc->getRecttes($cond);
if ($liste != null) {
    $nbre = count($liste);
    for ($i = 0; $i < $nbre; $i++) {
        echo '
        <div class="col fs-7" id="' . $liste[$i]->id_recette . '">
            <div class="card shadow-sm">
                <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                     xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                     preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                    <rect width="100%" height="100%" fill="#55595c"/>
                    <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                </svg>
                <div class="card-body">
                    <p class="text-danger"><b>' . $liste[$i]->nom_recette . '</b></p>
                    <p class="card-text"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i
                                class="fa-solid fa-star"></i>

                    <div class="row">

                        <div class="col"><i class="fa-solid fa-clock"></i></div>
                        <div class="col"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="col"><i class="fa-solid fa-clock"></i></div>
                    </div>
                    <div class="row">
                        <div class="col"><b>' . $liste[$i]->temp_cuiss . 'min </b></div>
                        <div class="col"><b>' . $liste[$i]->niveau . '</b></div>
                        <div class="col"><b>' . $liste[$i]->nbre_part . '</b></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="btn-group">
                            <a href="index.php?page=detail_recette.php&id_recette=' . $liste[$i]->id_recette . '"
                               type="button"
                               class="btn btn-sm btn-outline-secondary">Voir</a>
                        </div>
                    </div>
                </div>
                </div>
                </div>
                
            ';

    }
} else {
    echo '<h1>Pas de recette pour cette categorie</h1>';
}
?>








