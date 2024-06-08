<?php
require 'src/php/utils/verifier_connexion.php';
$chefs = new ChefDB($cnx);
$liste = $chefs->getAllChefs();
//var_dump($liste);
$nbr = count($liste);

?>
<div class="container ajout_chef-form">
    <h1 class="statusMsg'">hhhhh</h1>
    <form id="form_ajout_recette" method="GET" action="" enctype="multipart/form-data">
        <h2 class="text-center">Ajout d'une recette</h2>
        <span id="error2"></span>
        <div class="form-group">
            <label for="nom_recette">Nom </label>
            <input type="text" name="nom_recette" class="form-control" id="nom_recette">
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="chef">Chef redacteur</label>
                    <select name="chef" id="chef" class="form-select W-100" >
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
                        <select name="difficulte" id="difficulte" class="form-select w-100">
                            <option value="facile">facile</option>
                            <option value="moyen">moyen</option>
                            <option value="difficile">difficile</option>
                        </select>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="categorie">Categorie</label>
                    <select name="categorie" id="categorie" class="form-select w-100">
                            <option value="plat_chaud">Plat chaud</option>
                            <option value="plat_froid">Plat froid</option>
                            <option value="salade">Salade</option>
                            <option value="patisserie">Patisserie</option>
                            <option value="dessert">Dessert</option>
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
                    <input type="text" name="temps_cuisson" class="form-control" id="temps_cuisson">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" id="description"> </textarea>
        </div>
        <h3>les ingredients</h3>
        <span id="error"></span>
        <table class="table table-striped table-bordered" id="ingredient_table">
            <tr>
                <th>#</th>
                <th>Nom ingredient</th>
                <th>quantite</th>
                <th>Unité de mesure</th>
                <th><button type="button" class="btn btn-success" id="ajout_ingredient"><i class="fa fa-plus"></i></button></th>
            </tr>
            <tbody id="tbody_ingredient">

            </tbody>
        </table>
        <br><br>
        <button type="submit" id="submit_ajout_recette" name="submit_ajout_recette" class="btn btn-danger">Enregistrer</button>
        <button type="reset" id="reset_ajout_recette" value="Annuler" class="btn btn-secondary">Annuler</button>
    </form>
</div>


