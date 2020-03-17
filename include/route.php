<?php

if (empty($_SESSION['utilisateur'])) {
    // NON co
    // penser afficher connexion/inscription
    // par defaut == accueil

    if (!empty($_GET['page']) && $_GET['page'] == 'categorie') {
        include_once "code/html/categorie.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'connexion') {
        include_once "code/html/connexion.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'edition') {
        include_once "code/html/edition.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'image') {
        include_once "code/html/image.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'inscription') {
        include_once "code/html/inscription.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'langue') {
        include_once "code/html/langue.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'livre') {
        include_once "code/html/livre.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'livres') {
        include_once "code/html/livres.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'recherche') {
        include_once "code/html/recherche.php";
    } else {
        //par defaut accueil
        include_once "code/html/accueil.php";
    }
} elseif (!empty($_SESSION['utilisateur']) && $_SESSION['utilisateur']->getROle() == "admin") {
    if (!empty($_GET['page']) && $_GET['page'] == 'inscriEdition') {
        include_once "code/html/inscriEdition.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'inscriEtat') {
        include_once "code/html/inscriEtat.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'inscriGenre') {
        include_once "code/html/inscriGenre.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'inscriLangue') {
        include_once "code/html/inscriLangue.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'inscriLivre') {
        include_once "code/html/inscriLivre.php";
    }
} else {
    //connecte
    if (!empty($_GET['page']) && $_GET['page'] == 'deconnexion') {
        include_once "code/html/deconnexion.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'edition') {
        include_once "code/html/edition.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'etat') {
        include_once "code/html/etat.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'image') {
        include_once "code/html/image.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'langue') {
        include_once "code/html/langue.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'livre') {
        include_once "code/html/livre.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'livres') {
        include_once "code/html/livres.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'modif') {
        include_once "code/html/modif.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'profil') {
        include_once "code/html/profil.php";
    } else if (!empty($_GET['page']) && $_GET['page'] == 'recherche') {
        include_once "code/html/recherche.php";
    } else {
        //par defaut accueil
        include_once "code/html/accueil.php";
    }
}
