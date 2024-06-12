<?php
require 'src/php/utils/verifier_connexion.php';
//récupération des clients et affichage dans table bootstrap
$chefs = new ChefDB($cnx);
$liste = $chefs->getAllChefs();;
$nbr = count($liste);
?>
<h2 class="text-center">Gestion des chefs</h2>

<button class="btn btn-danger"><i class="fa fa-plus"></i><a class="lien_button" href="index.php?page=ajout_chef.php">Nouveau chef</a>
</button><br>
<?php
if ($nbr == 0) {
    print "<br>Aucun chef encodé<br>";
} else {
    ?>
    <table class="table table-striped table-bordered">
        <thead>

        <tr>
            <!--<th scope="col">Id</th>-->
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Année d'expérience</th>
            <th scope="col">Email</th>
            <th scope="col">Numéro</th>
            <th scope="col">Adresse</th>
            <th scope="col">Action</th>
        </tr>

        </thead>
        <tbody>
        <?php
        for ($i = 0; $i < $nbr; $i++) {
            ?>
            <tr>
                <!--<th><?= $liste[$i]->id_client; ?></th>-->
                <td contenteditable="true" id="<?= $liste[$i]->id_chef; ?>"
                    name="nom_chef"><?= $liste[$i]->nom_chef; ?></td>
                <td contenteditable="true" id="<?= $liste[$i]->id_chef; ?>"
                    name="prenom_chef"><?= $liste[$i]->prenom_chef; ?></td>
                <td contenteditable="true" id="<?= $liste[$i]->id_chef; ?>"
                    name="annee_exp"><?= $liste[$i]->annee_exp; ?></td>
                <td contenteditable="true" id="<?= $liste[$i]->id_chef; ?>" name="email"><?= $liste[$i]->email; ?></td>
                <td contenteditable="true" id="<?= $liste[$i]->id_chef; ?>"
                    name="telephone"><?= $liste[$i]->telephone; ?></td>
                <td contenteditable="true" id="<?= $liste[$i]->id_cheft; ?>"
                    name="adresse"><?= $liste[$i]->adresse; ?></td>
                <td>&nbsp;
                    <i id="<?= $liste[$i]->id_chef; ?>" class="fa fa-trash"></i></td>

                <!--<td contenteditable="true"><img src="public/images/delete.jpg" alt="Effacer" id="delete"></td>-->
            </tr>
            <?php
        }
        ?>

        </tbody>
    </table>
    <?php
}
?>
<div class="modal" tabindex="-1" role="dialog" id="confirm">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Suppression</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Voulez vous vraiment supprimer ce chef?</p>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit_delete_chef" class="btn btn-danger">Confirmer</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            </div>
        </div>
    </div>
</div>
