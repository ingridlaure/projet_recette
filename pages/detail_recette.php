<?php
$cp = new CompositionDB($cnx);
$liste = $cp->getIngredients($_GET['id_recette']);
$recette=$cp->getDetailRecette($_GET['id_recette']);

if ($liste == null) {
    echo " <h1>Il n'ya pas encore de recette pour ce plat </h1>";
} else {
    $nbr = count($liste);


    ?>
    <div class="container">
        <h2 class="text-center"><?= $recette[0]->nom_recette; ?></h2>
        <div class="row">
            <div class="col">
                <img src="./admin/public/images/recette.jpg" alt="">
            </div>
            <div class="col">
                <h3 class="text-danger">Ingrédient</h3>
                <ul>
                    <?php for ($i = 0; $i < $nbr; $i++) {
                        ?>

                        <li> &nbsp;<?= $liste[$i]->quantite; ?>&nbsp;&nbsp;<?= $liste[$i]->unite; ?>&nbsp;
                            de <?= $liste[$i]->ingredient; ?></li>

                        <?php
                    }
                    ?>
                    <!--<li>400 g de tomates pelées</li>
                    <li>350 g de boeuf haché</li>
                    <li>1 carotte</li>
                    <li>2 échalotes</li>
                    <li>3 branches de persil plat</li>
                    <li>1 branche de céleri</li>
                    <li>10 cl de vin blanc sec</li>
                    <li>2 feuilles de laurier</li>-->
                </ul>
            </div>
        </div>
        <h2 class="text-danger text-center">La préparation de la recette</h2>
        <?= $recette[0]->description; ?>
        <!--Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad deleniti dicta dignissimos eaque eos esse in ipsa
        nihil nostrum obcaecati optio possimus quae quasi quis sed sit tenetur, vitae voluptatem.
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Assumenda corporis libero molestiae quibusdam.
        Consectetur est nostrum sunt! Aliquid cum, debitis dignissimos dolore ea fugiat impedit inventore molestiae
        nihil nobis omnis perspiciatis provident, sapiente totam voluptas. Accusamus aliquam at atque aut commodi
        debitis delectus deserunt dolorum ducimus, excepturi, explicabo ipsa itaque modi natus optio porro provident sed
        ut! Ab accusamus architecto consectetur delectus dolores ea eaque earum esse, est harum hic ipsam itaque, magnam
        maxime neque nihil, nisi nostrum odio provident quisquam quod recusandae reprehenderit sed unde voluptate
        voluptatem voluptates voluptatum! A amet aperiam, aut cupiditate distinctio dolor dolores eligendi error esse
        illo incidunt ipsa iusto laboriosam modi, nemo neque omnis quae quibusdam repellendus similique, sit voluptas
        voluptatem. Accusantium amet aspernatur at atque, aut, cumque dolore doloremque dolorum earum fugiat harum
        illum, itaque iusto labore magnam nam nesciunt nihil non nulla omnis quae quisquam quos repellendus sunt tempore
        voluptatem voluptates. A accusantium ad aspernatur atque dignissimos eaque error est et eveniet fugit harum
        itaque iusto magni, modi mollitia nisi odio omnis quam, quis ratione reiciendis sequi voluptates. Aliquam animi
        culpa delectus deserunt dolore doloremque eaque error in incidunt ipsam, iure laudantium magnam natus nulla
        omnis, quis quisquam rerum sit, temporibus tenetur ut veniam voluptates. Atque autem consequuntur culpa
        distinctio dolore eaque est ex magni maiores nihil pariatur quae, quasi quo sed veniam? A, accusamus adipisci
        aliquid animi atque beatae consequuntur cupiditate debitis deleniti dignissimos doloremque ea exercitationem
        fugiat in laborum minus molestiae molestias mollitia necessitatibus nobis obcaecati odio porro possimus
        quibusdam quidem quis quisquam quod reprehenderit repudiandae sapiente similique, sint soluta suscipit ullam vel
        velit veniam? A accusantium aut impedit minima provident quia recusandae sunt. Architecto blanditiis, commodi
        ducimus, enim eos eveniet ex facere labore maiores maxime necessitatibus non numquam obcaecati perspiciatis
        possimus, tenetur vero! Deserunt est et nihil quidem quis!-->
    </div>
    <?php

}
?>





