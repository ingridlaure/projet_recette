<?php

require 'src/php/utils/verifier_connexion.php';
?>
<div class="container ajout_chef-form">
    <form id="form_ajout_chef" method="get" action="">
        <h2 class="text-center">Ajout d'un chef</h2>
        <div class="form-group">
            <label for="nom">Nom </label>
            <input type="text" name="nom" class="form-control" id="nom" >
        </div>
        <div class="form-group">
            <label for="prenom">Prénom</label>
            <input type="text" name="prenom" class="form-control" id="prenom">
        </div>
        <div class="form-group">
            <label for="experience">Nombre d'année d'xpérience</label>
            <input type="text" name="experience" class="form-control" id="experience">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" id="email">
        </div>
        <div class="form-group">
            <label for="telephone">Numéro de téléphone</label>
            <input type="text" name="telephone" class="form-control" id="telephone">
        </div>
        <div class="form-group">
            <label for="adresse">Adresse</label>
                <input type="text" name="adresse" class="form-control" id="adresse">
        </div>

        <br>
        <button type="submit" id="submit_ajout_chef" value="Ajouter" class="btn btn-danger">Ajouter</button>
    </form>
</div>

