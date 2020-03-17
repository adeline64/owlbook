<?php
/*
 * Script inclus => pas besoin de cr�er une connexion
 */
//si la liste a deja ete chargee une fois, pas a peine de
//la recharger, sinon on la charge depuis la base
$oManagerLivre = new ManagerLivre();
$oManagerLivre->setDb($db);

// if (empty($_SESSION['livres'])) {
	if (isset($_GET['p'])) {
	    if (intval($_GET['p']) == 0) {
	        $_SESSION['livres'] = $oManagerLivre->getLivrePageAlpha($_GET['p'],_NB_LIVRE_PAGE_);
	    } else {
	        $_SESSION['livres'] = $oManagerLivre->getLivrePage(intval($_GET['p']),_NB_LIVRE_PAGE_);
	    }	    
	    $nbTotalLivres = $oManagerLivre->getNblivre();
	}else{
		$_SESSION['livres'] = $oManagerLivre->getAllLivre();
		$nbTotalLivres = $oManagerLivre->getNblivre();
	}
// } else {
	//dans ce second cas, on initialise la session['livre'] pour plus tard
// 	unset($_SESSION['livre']);
// 	$nbTotalLivres = $oManagerLivre->getNblivre();
// }


if (!empty($_SESSION['livres'])) {
	
// 	$nblivresPages = 12;
// 	$nbPage = $nbLivre/$nblivresPages;
	//CORRECTION
	//utilisation de CEIL => voir doc
    $nbPage = ceil($nbTotalLivres/_NB_LIVRE_PAGE_);
	
	// echo $nbPage;
	for ($i=1; $i <=$nbPage ; $i++) {
	    $aLiensPages[] = '<a href="?page=livres&p='.$i.'">'.$i.'</a>';
	}
	
	//page ALPHA
	$aAlpha = ["_0", "_1", "_2", "_3", "_4", "_5", "_6", "_7", "_8", "_9","A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","X","Y","Z"];
	foreach ($aAlpha AS $lettre) {
	    $aLiensPagesAlpha[] = '<a href="?page=livres&p='.$lettre.'">'.str_replace("_","",$lettre).'</a>';
	}
?>

	<h3 class="owl_livres">Les Livres</h3>
	<br>

	<?php
	    //Affichage des liens
	    foreach ($aLiensPages AS $lien) {
    	    echo $lien.'&nbsp;&nbsp;';
		}
		
		echo '<br/><br/>';
		
    	foreach ($aLiensPagesAlpha AS $lienAlpha) {
    	    echo $lienAlpha.'&nbsp;&nbsp;';
    	}
	?>

	<br><br>

	<section class="row align-items-start owl_book">
		<?php
		$compteur = 0;
		unset($_SESSION["livre"]);

		foreach ($_SESSION['livres'] as $livre) {
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
	}
} else {
	echo 'Aucun livre en base';
}

/*
if (!empty($_SESSION['livres'])) {
	
	foreach ($_SESSION['livres'] as $livre) {
?>
		<section class="row align-items-start owl_book">
			<article class="col-12 col-sm-12 col-md-12 owl_livre">
				<a href="?page=livre&id=<?= $livre->getId() ?>">
					<img src="image/<?php echo $livre->getImage(); ?>" class="livres" />
				</a><br />
				<?= $livre->getTitre() ?><br>
				<?= $livre->getSousTitre() ?>
			</article>
		</section>
<?php
	}
} else {
	echo 'Aucun lives en base';
}
*/

