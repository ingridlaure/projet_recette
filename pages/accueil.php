<?php
/*$recettes = new RecetteDB($cnx);
$liste = $recettes->getRecttes();
$nbr = count($liste);*/
?>

bienvenu sur le site des recette

<form>
    <div class="row">
        <div class="col">
            <label for="categorie">Recherche par categorie</label>
            <select  class="form-select" name="filtre_categorie" id="filtre_categorie">
                <option value="tous" selected>Tous</option>
                <option value="plat_chaud">Plat chaud</option>
                <option value="plat_froid">Plat froid</option>
                <option value="salade">Salade</option>
                <option value="patisserie">Patisserie</option>
                <option value="dessert">Dessert</option>
            </select>
        </div>
    </div>
</form>
<div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3  row-cols-md-4 g-4 " id="show_data"
        <!--<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3  row-cols-md-4 g-4 " id="show_data">-->
        </div>
    </div>
</div>



