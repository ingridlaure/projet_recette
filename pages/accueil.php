bienvenu sur le site des recette
<form class="d-flex">
    <input class="form-control me-2" type="search" placeholder="Rechercher une recette" aria-label="Search">
    <button class="btn btn-danger" type="submit"> valider</button>
</form>

<h3>Filtrer par : </h3>
<form>
    <div class="row">
        <div class="col">
            <label for="categorie">categorie</label>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </div>
        <div class="col">
            <label for="niveau"> niveau</label>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </div>
        <div class="col">
            <label for="Nombre de part"> nombre de part</label>
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        </div>
    </div>
</form>

<div class="album py-5 bg-body-tertiary">
    <div class="container">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3  row-cols-md-4 g-4">
            <?php
            for ($i = 0; $i < 9; $i++) {
                ?>
                <div class="col fs-7">
                    <div class="card shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                             xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                             preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title>
                            <rect width="100%" height="100%" fill="#55595c"/>
                            <text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                        </svg>
                        <div class="card-body">
                            <p class="text-danger"><b>Titre de la recette</b></p>
                            <p class="card-text"><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>

                            <div class="row">

                                <div class="col"><i class="fa-solid fa-clock"></i></div>
                                <div class="col"><i class="fa-solid fa-chart-line"></i></div>
                                <div class="col"><i class="fa-solid fa-clock"></i></div>
                            </div>
                            <div class="row">
                                <div class="col"><b>45 min </b></div>
                                <div class="col"><b>facile</b></div>
                                <div class="col"><b>4</b></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="index.php?page=detail_recette.php" type="button"
                                       class="btn btn-sm btn-outline-secondary">Voir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
