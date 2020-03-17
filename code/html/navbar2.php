<?php
/*
 * Ce fichier est la fusion des deux nav_bar (connecte / non_connecte) il prend en compte
 * la session et la donn�e utilisateur => qui est un objet cr�� lors de la connexion de l'utilisateur
 */

if (!empty($_SESSION['utilisateur'])) {
	/*
	 * Nous sommes dans le cas d'un utilsateur connect�
	 */
	?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark OwlBook_NavBarre">
  <a class="navbar-brand navbar_o" >OwlBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="?page=accueil">Accueil </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=profil">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=livres&p=1">Livres</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=recherche">Recherche</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=deconnexion">D&eacute;connexion</a>
      </li>
    </ul>
  </div>
  <div class="utilisateur">
			<?php
			echo strtoupper($_SESSION['utilisateur']->getNom()) . ' ' . $_SESSION['utilisateur']->getPrenom();
			?>
            <a class="navbar-brand" href="?page=profil">
                <img src="image/owl_mini.png" alt="photo_utilisateur" class="chouette" data-toggle="modal" a href="#infos">
            </a>
        </div>
</nav>
	<?php
}else{
	/*
	 * Nous sommes un utilisateur NON CONNECTE
	 */
	?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark OwlBook_NavBarre">
  <a class="navbar-brand navbar_o" >OwlBook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item ">
        <a class="nav-link" href="?page=accueil">Accueil </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=livres&p=1">Livres</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=recherche">Recherche</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=connexion">Connexion</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="?page=inscription">Inscription</a>
      </li>
    </ul>
  </div>
</nav>
    <?php
}


