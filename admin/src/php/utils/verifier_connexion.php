<?php
//fichier à inclure en haut des pages d'admin
if(isset($_SESSION['user'])!=1){
    //si on n'est pas passé par le login et si on n'est pas reconnu admin
    ?>
    <meta http-equiv="refresh" content="0;URL=../index.php?page=accueil.php">
    <?php
}