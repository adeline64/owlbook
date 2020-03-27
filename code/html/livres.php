<?php
/*
 * Script inclus => pas besoin de cr�er une connexion
 */
//si la liste a deja ete chargee une fois, pas a peine de
//la recharger, sinon on la charge depuis la base
$oManagerLivre = new ManagerLivre();
$oManagerLivre->setDb($db);

// if (empty($_SESSION['livres'])) {
if (isset($_GET['lettre'])) {
	$_SESSION['livres'] = $oManagerLivre->getLivrePageAlpha($_GET['lettre']);
	// if (intval($_GET['p']) == 0) {
	//     $_SESSION['livres'] = $oManagerLivre->getLivrePageAlpha($_GET['p'],_NB_LIVRE_PAGE_);
	// } else {
	//     $_SESSION['livres'] = $oManagerLivre->getLivrePage(intval($_GET['p']),_NB_LIVRE_PAGE_);
	// }	    
	// $nbTotalLivres = $oManagerLivre->getNblivre();
	// } else {
	// $_SESSION['livres'] = $oManagerLivre->getAllLivre();
	// $nbTotalLivres = $oManagerLivre->getNblivre();
}
if (empty($_SESSION['livres'])) {
	$_SESSION['livres'] = $oManagerLivre->getAllLivre();
	// $nbTotalLivres = $oManagerLivre->getNblivre();
}
// } else {
//dans ce second cas, on initialise la session['livre'] pour plus tard
// 	unset($_SESSION['livre']);
// 	$nbTotalLivres = $oManagerLivre->getNblivre();
// }

$nbTotalLivres = count($_SESSION['livres']);

if (!empty($_SESSION['livres'])) {



	//page ALPHA
	$aAlpha = ["_0", "_1", "_2", "_3", "_4", "_5", "_6", "_7", "_8", "_9", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "X", "Y", "Z"];
	foreach ($aAlpha as $lettre) {
		$aLiensPagesAlpha[] = '<a href="?page=livres&lettre=' . $lettre . '">' . str_replace("_", "", $lettre) . '</a>';
	}

	if (_NB_LIVRE_PAGE_ < $nbTotalLivres) {
		// 	$nblivresPages = 12;
		// 	$nbPage = $nbLivre/$nblivresPages;
		//CORRECTION
		//utilisation de CEIL => voir doc
		$nbPage = ceil($nbTotalLivres / _NB_LIVRE_PAGE_);

		// echo $nbPage;
		for ($i = 1; $i <= $nbPage; $i++) {
			$aLiensPages[] = '<a href="?page=livres&p=' . $i . '">' . $i . '</a>';
		}
	}

	$numeroLivreInitial = _NB_LIVRE_PAGE_ * ((isset($_GET["p"]) ? $_GET["p"] : 1) - 1);
	$numeroLivreFinal = $numeroLivreInitial + _NB_LIVRE_PAGE_;
	$_SESSION['livreAAfficher'] = [];
	$compteur = 0;
	foreach ($_SESSION['livres'] as $livre) {
		if ($compteur < $numeroLivreFinal & $compteur >= $numeroLivreInitial) {
			$_SESSION['livreAAfficher'][] = $livre;
		}
		$compteur = $compteur + 1;
	}
	// debug($_SESSION['livreAAfficher'],true);

?>

	<h3 class="owl_livres">Les Livres</h3>
	<br>
	<section class="row align-items-start owl_book">
		<?php

		foreach ($aLiensPagesAlpha as $lienAlpha) {
			// echo'</br>';

			echo $lienAlpha . '&nbsp;&nbsp;';
		}

		echo '</section>';
		echo '</br>';
		echo '<section class="row align-items-start owl_book">';

		//Affichage des liens
		if (!empty($aLiensPages)) {
			foreach ($aLiensPages as $lien) {

				echo $lien . '&nbsp;&nbsp;';
			}
		}
		?>
	</section>
	<br><br>

	<section class="row align-items-start owl_book">
		<?php
		$compteur = 0;
		$compteurLivre = 0;
		unset($_SESSION["livre"]);

		foreach ($_SESSION['livreAAfficher'] as $livre) {
			if ($compteurLivre == _NB_LIVRE_PAGE_) {
				break;
			}
			if ($compteur == 3) {

		?>
	</section>
	<section class="row align-items-start owl_book">
	<?php
				$compteur = 0;
			}
	?>
	<article class="col-4 col-sm-4 col-md-4 col-lg-4 owl_livre">
		<a href="?page=livre&id=<?= $livre->getId() ?>">
			<img src="image/<?php echo $livre->getImage(); ?>" class="livres" />
		</a><br />
		<?= $livre->getTitre() ?><br>
		<?= $livre->getSousTitre() ?>
		<br> <br>
	</article>


<?php
			$compteur = $compteur + 1;
			$compteurLivre = $compteurLivre + 1;
		}
	} else {
		echo 'Aucun livre en base';
	}
