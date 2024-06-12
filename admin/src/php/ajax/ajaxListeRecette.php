<?php
sleep(1);
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
        $note=$rc->getNote($liste[$i]->id_recette);
        //var_dump($note[0][0]);
        $final=round(doubleval($note[0][0]),0);
       // echo $final;
        echo '
        <div class="col fs-7" id="' . $liste[$i]->id_recette . '">
            <div class="card shadow-sm">
                <img src="./admin/public/images/recette' . $liste[$i]->id_recette . '.jpg" alt="" class="bd-placeholder-img card-img-top" width="100%" height="225">
                <div class="card-body">
                    <p class="text-danger"><b>' . $liste[$i]->nom_recette . '</b></p>
                    <p class="card-text"></p>';
        for($j=0;$j<=$final;$j++){
            echo '<i class="fa-solid fa-star"></i>';
        }
        echo'
                    <div class="row">
                        <div class="col"><i class="fa-solid fa-clock"></i></div>
                        <div class="col"><i class="fa-solid fa-chart-line"></i></div>
                        <div class="col"><i class="fa-solid fa-bars"></i></div>
                    </div>
                    <div class="row">
                        <div class="col"><b>' . $liste[$i]->temp_cuiss . 'min </b></div>
                        <div class="col"><b>' . $liste[$i]->niveau . '</b></div>
                        <div class="col"><b>' . $liste[$i]->nbre_part . ' parts</b></div>
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








