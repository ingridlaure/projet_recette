<?php
if(!isset($_GET['id_recette']))
{
header('Location: index.php');

}else{
$cp = new CompositionDB($cnx);
$liste = $cp->getIngredients($_GET['id_recette']);
$recette = $cp->getDetailRecette($_GET['id_recette']);

if ($liste == null) {
    echo " <h1>Il n'ya pas encore de recette pour ce plat </h1>";
} else {
    $nbr = count($liste);

    ?>
    <div class="container">

        <div class="row">
            <div class="col">
                <img src="./admin/public/images/recette<?=$_GET['id_recette'];?>.jpg" alt="" id="detail_image">
            </div>
            <div class="col" id="detail_ingredient">
                <h2 id="detaim_titre"><?= $recette[0]->nom_recette; ?></h2>
                <div class="row">
                    <div class="col"><i class="fa-solid fa-clock"></i></div>
                    <div class="col"><i class="fa-solid fa-chart-line"></i></div>
                    <div class="col"><i class="fa-solid fa-bars"></i></div>
                </div>
                <div class="row">
                    <div class="col"><b><?= $recette[0]->temp_cuiss ;?>min </b></div>
                    <div class="col"><b><?= $recette[0]->niveau ;?></b></div>
                    <div class="col"><b><?=  $recette[0]->nbre_part ;?> parts</b></div>
                </div>
                <br><br>
                <h3 class="text-danger">Ingrédient</h3>
                <ul>
                    <?php for ($i = 0; $i < $nbr; $i++) {
                        ?>

                        <li> &nbsp;<?= $liste[$i]->quantite; ?>&nbsp;&nbsp;<?= $liste[$i]->unite; ?>&nbsp;
                            de <?= $liste[$i]->ingredient; ?></li>

                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div id="detail_description">
            <h2 class="text-danger text-center">La préparation de la recette</h2>

            <?= $recette[0]->description; ?>
        </div>
    </div><br>
    <h4 class="text-center">Voulez vous Noter cette recette?<span class="text-danger" id="oui_noter">cliquez moi</span></h4>
    <form method="POST" action="" id="form_noter">
        <span id=""></span>
        <div class="form-group">
            <label for="note">Note /5</label>
            <input type="number" name="note" class="form-control" id="note"  placeholder="Entrez votre note">
        </div>
        <input id="id_recette_detail" name="id_recette_detail" type="hidden" value="<?=$_GET['id_recette'];?>" />
        <br>
        <button type="submit" name="submit_note" id="submit_note" class="btn btn-danger">Envoyer</button>
    </form>
    <?php

}
}
?>






