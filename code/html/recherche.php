<section class="row justify-content-center rechercher">
    <article class="col-12 col-md-10 col-lg-8">
        <h3 class="rechercher">Faite votre recherche</h3>
        <img src="image/rechercher.jpg" class="image_recherche">
        <form class="card card-sm" action="?page=recherche" method="post">
            <div class="card-body row no-gutters align-items-center">
                <div class="col-auto">
                    <i class="fas fa-search h4 text-body"></i>
                </div>
                <!--end of col-->
                <div class="col">
                    <input class="form-control form-control-lg form-control-borderless" name="search" type="search" placeholder="Rechercher un titre de livre">
                </div>
                <!--end of col-->
                <div class="col-auto">

                    <button class="btn btn-outline-info" type="submit">Rechercher</button>
                </div>
                <!--end of col-->
            </div>
        </form>
    </article>
    <!--end of col-->
</section>
<br>
<?php
// var_dump($_POST);

$managerLivre = new ManagerLivre();
$managerLivre->setDb($db);
if (isset($_POST["search"])) {
    unset($_SESSION["livre"]);
    $Arraylivre = $managerLivre->recherche($_POST["search"]);
    // var_dump($Arraylivre);
    foreach ($Arraylivre as $livre) : ?>
        <section class="recherche">
            <a href="?page=livre&id=<?= $livre->getId() ?>">
                <img src="image/<?php echo $livre->getImage(); ?>" class="livres" />
            </a><br />
            <h2>Titre : <?= $livre->getTitre() ?></h2>
            <h3>Sous Titre : <?= $livre->getSousTitre() ?></h3>
            <br>
        </section>


    <?php endforeach ?>

<?php
}
?>

<br>