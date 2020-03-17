<?php

if (!isset($_SESSION['id'], $_SESSION['email'])) {
    //NON Co
?>
    <section class="row align-items-start">
        <article class="col-12 col-md-12 owl_accueil">
            <h1 class="presentation">
                Bienvenue
            </h1>

            <img src="image/bienvenue.jpg" class="bienvenue">

            <p class="premier">
                Vous &ecirc;tes sur la page d'accueil du site OwlBook. Ici, vous trouverez tous vos livres pr&eacute;f&eacute;r&eacute;s,
                des informations sur les auteurs que vous aimez et les maisons d'&eacute;ditions que vous adorez.
                C'est l'occasion r&ecirc;v&eacute;e de d&eacute;couvrir des nouveaut&eacute;s et de faire le plein de culture. Jetez vous dans
                le plaisir de la lecture et/ou revisitez les livres que vous avez d&eacute;ja lu.
            </p>

            <p class="second">
                En Devenant membre de notre site, d&eacute;couvrez toujours plus d'options, toujours plus de plaisir !
                En effet, possibilit&eacute; d'avoir acc&egrave;s &agrave; des options en plus. Vous pourrez par exemple s&eacute;lectionner les
                livres que vous poss&egrave;dez, choisir les prochains livres &agrave; mettre dans votre panier d'achat ... Et plein d'autre
                possibilit&eacute;s !
            </p>

            <p class="troisieme">
                Venez nombreux sur notre site ! Nous vous accueillerons toujours avec de nouveaux livres !
            </p>

        </article>
    </section>


<?php

} else {
    //conecte

?>

    <section class="row align-items-start">
        <article class="col-12 col-md-12 owl_accueil">

            <h1 class="presentation">
                Bienvenue
            </h1>

            <p class="premier">
                Vous êtes sur la page d'accueil du site OwlBook. Ici, vous trouverez tous vos livre préféré,
                des informations sur les auteurs que vous aimez et les maisons d'éditions que vous adorez.
                C'est l'occasion révé de découvrir des nouveauté et de faire le plein de culture. Jetter vous dans
                le plaisir de la lecture et revisiter les livres que vous avez déja lu.
            </p>

            <p class="second">
                Félicitation et merci pour être devenu membre de notre site ! Vous allez découvrir toujours plus
                d'options, toujours plus de plaisir !
                En effet, possibilité d'avoir accès à des options en plus. Maintenant, vous pouvez par exemple
                sélectionner les
                livres que vous possédez, choisir les prochains livres à mettre dans votre panier d'achat ... Et plein
                d'autre
                possibilité !

            </p>

            <p class="troisieme">
                Venez nombreux sur notre site ! On vous accueillera toujours avec des nouveaux livres !
            </p>

        </article>
    </section>

<?php

}

?>