<?php
require 'src/php/utils/verifier_connexion.php';
?>
<h2 class="text-center">Gestion des Recettes</h2>

<button class="btn btn-danger"><i class="fa fa-plus"></i><a class="lien_button"
                                                            href="index.php?page=ajout_recette.php">Nouvelle
        recette</a>
</button><br>
<?php
$recettes = new RecetteDB($cnx);
$liste = $recettes->getRecttes('');
if ($liste != null) {
    $nbr = count($liste);

    ?>

    <table class="table table-striped table-bordered">
        <thead>

        <tr>
            <!--<th scope="col">Id</th>-->
            <th scope="col">Nom de le recette</th>
            <th scope="col">Categorie</th>
            <th scope="col">Temps de cuisson</th>
            <th scope="col">Nombre de part</th>

        </tr>

        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $nbr; $i++) {
            ?>
            <tr>
                <!--<th><?= $liste[$i]->id_recette; ?></th>-->
                <td id="<?= $liste[$i]->id_recette; ?>"
                    name="nom_chef"><?= $liste[$i]->nom_recette; ?></td>
                <td  id="<?= $liste[$i]->id_recette; ?>"
                    name="prenom_chef"><?= $liste[$i]->categorie; ?></td>
                <td  id="<?= $liste[$i]->id_recette; ?>"
                    name="annee_exp"><?= $liste[$i]->temp_cuiss; ?></td>
                <td  id="<?= $liste[$i]->id_recette; ?>"
                    name="telephone"><?= $liste[$i]->nbre_part; ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

    <?php
} else {
    print "<br>Aucune recette encodé<br>";
}
?>

