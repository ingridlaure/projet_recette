<?php
require 'src/php/utils/verifier_connexion.php';
$chefs = new ChefDB($cnx);
$liste = $chefs->getAllChefs();
//var_dump($liste);
$nbr = count($liste);
?>
<div class="container ajout_chef-form">
    <form id="form_ajout_recette" method="get" action="">
        <h2 class="text-center">Ajout d'une recette</h2>
        <div class="form-group">
            <label for="nom_recette">Nom </label>
            <input type="text" name="nom_recette" class="form-control" id="nom_recette">
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="chef">Chef redacteur</label>
                    <select name="chef" id="chef" class="form-select w-100 selectpicker" data-live-search="true">
                        <?php
                        for ($i = 0; $i < $nbr; $i++) {
                            ?>
                            <option value="<?= $liste[$i]->id_chef; ?>"><?= $liste[$i]->nom_chef . " " . $liste[$i]->prenom_chef; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="difficulte">Niveau de difficulté</label>
                    <div class="search_select_box">
                        <!--<select name="difficulte" id="difficulte" class="form-select selectpicker" data-live-search="true">-->
                        <select name="difficulte" id="difficulte" class="form-select w-100">
                            <option value="facile">facile</option>
                            <option value="moyen">moyen</option>
                            <option value="difficile">difficile</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="categorie">Categorie</label>
                    <select name="caegorie" id="categorie" class="form-select w-100">
                        <option value="plat_chaud">Plat chaud</option>
                    </select>
                </div>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="nombre_part">Nombre de part </label>
                    <input type="text" name="nombre_part" class="form-control" id="nombre_part">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="temps_cuisson">Temps de cuisson</label>
                    <input type="text" name="temps-cuisson" class="form-control" id="temps_cuisson">
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="image_recette" class="form-label">Choisissez une image pour la recette</label>
                    <input class="form-control" type="file" id="image-recette">
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="prenom">Description</label>
            <textarea name="description" class="form-control" id="prenom"> </textarea>
        </div>
        <h3>les ingredients</h3>
        <button class="btn btn-danger"><i class="fa fa-plus"></i><a class="lien_button">Ajouter un ingredient</a>
        </button>
        <br><br>
        <button type="submit" id="submit_ajout_chef" value="Ajouter" class="btn btn-danger">Engegistrer</button>
        <button type="reset" id="reset_ajout_chef" value="Annuler" class="btn btn-secondary">Annuler</button>

    </form>
</div>
