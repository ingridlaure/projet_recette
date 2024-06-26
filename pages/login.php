<?php
if (isset($_POST['submit_login'])) { //name du submit
    extract($_POST,EXTR_OVERWRITE);
    //var_dump($_POST);
    $ad = new UserDB($cnx);
    $user = $ad->getUser($login,$password);//$admin reçoit 1 ou 0
    $_SESSION['user']=$user;
    if($user==1){
        ?>
        <meta http-equiv="refresh" content="0;URL=./admin/index.php?page=accueil_admin.php">
        <?php
    }else {
        ?>
        <br>Accès réservé aux administrateurs;
        <meta http-equiv="refresh" content="2;URL=index.php?page=accueil.php">
        <?php
    }
}
?>


<div class="container login-form">
    <form method="POST" action="<?= $_SERVER['PHP_SELF'];?>">
        <h2 class="text-center">Connexion</h2>
        <div class="form-group">
            <label for="login">Nom d'utilisateur</label>
            <input type="text" name="login" class="form-control" id="login" aria-describedby="emailHelp" placeholder="Entrer le login">
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
        <br>
        <button type="submit" name="submit_login" class="btn btn-danger">Se connecter</button>
    </form>
</div>
