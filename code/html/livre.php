<?php
// A SUPPRIMER APRES
debug("DEBUG POST");
debug($_POST);
debug("DEBUG GET");
debug($_GET);
debug("DEBUG SESSION");
debug($_SESSION);
debug("DEBUG FILES");
debug($_FILES);
// A SUPPRIMER APRES



/*
 * Definition de la taille en pixel d'une image pour un livre
 */
define('_LARGEUR_PX_', 500);
define('_HAUTEUR_PX_', 500);

/*
 * Definition de la taille en octets d'une image pour un livre
 *     1024 ko == 1 Mo
 */
define('_POIDS_', 1000448); //1Mo




//Creation du manager
$oManagerLivre = new ManagerLivre();
$oManagerLivre->setDb($db);

if (empty($_SESSION['livre'])) {
	//la session est vide, on vient de la page livres
	if (!empty($_GET['id'])) {
		//on va chercher le livre dans la bibliotheques chargee dans la page livres
		$_SESSION['livre'] = $_SESSION['livres'][$_GET['id']];
	}
} else {
	//on est déjà venu depuis livres, et la session a charge le livre demande
	//on est en modification de ce livre
	if (!empty($_POST)) {
		/*
		 * C'est ici que l'astuce va etre:
		 *     - si le tableau FILES est vide => pas de changement d'image
		 *     - si le tableau FILES est non vide => modification de l'image
		 */
		if (empty($_FILES['image']['name'])) {
			//pas de modification de l'image => ajout dans $_POST du nom actuel
			if (empty($_POST['image'])) {
				$_POST['image'] = $_SESSION['livre']->getImage();
			}
		} else {
			//une nouvelle image est choisie depuis le pc client
			//=> il faut la telecharger et l'affecter au livre
			if ($_FILES['image']['size'] <= _POIDS_) {
				list($largeur, $hauteur) = getimagesize($_FILES['image']['tmp_name']);
				if ($largeur <= _LARGEUR_PX_) {
					//bonne largeur
					if ($hauteur <= _HAUTEUR_PX_) {
						// bonne hauteur
						//chemin vers l'image finale
						$chemin = realpath("image/") . "/" . $_FILES['image']['name'];

						// image de destination
						$destination = ImageCreateTrueColor(_LARGEUR_PX_, _HAUTEUR_PX_) or die("Erreur pour cr&eacute;er l'image");

						// L'enregistrement
						if (move_uploaded_file($_FILES['image']['tmp_name'], $chemin)) {
							echo '<br>Nouvelle image charg&eacute;e sur le serveur';
						} else {
							echo '<br>Nouvelle image non charg&eacute;e sur le serveur';
						}
					} else {
						echo '<br>La hauteur (' . $hauteur . 'px) est sup&eacute;rieure &agrave; ' . _HAUTEUR_PX_;
						echo '<br>Nouvelle image non charg&eacute;e sur le serveur';
					}
				} else {
					echo '<br>La largeur (' . $largeur . 'px) est sup&eacute;rieure &agrave; ' . _LARGEUR_PX_;
					echo '<br>Nouvelle image non charg&eacute;e sur le serveur';
				}
			} else {
				echo '<br>Le poids est sup&eacute;rieure &agrave; ' . _POIDS_;
				echo '<br>Nouvelle image non charg&eacute;e sur le serveur';
			}
		}

		//protection pour les listes
		if ($_POST['etat'] == -1) {
			$_POST['etat'] = $_SESSION['livre']->getEtat();
		}
		if ($_POST['edition'] == -1) {
			$_POST['edition'] = $_SESSION['livre']->getEdition();
		}
		if ($_POST['image'] == -1) {
			$_POST['image'] = $_SESSION['livre']->getImage();
		}
		if ($_POST['langue'] == -1) {
			$_POST['langue'] = $_SESSION['livre']->getLangue();
		}

		//modification du livre en base
		$oManagerLivre->update($_POST);

		//modification du livre en session
		$_SESSION['livre']->hydrate($_POST);

		//modification de la bibliothèque en session
		$_SESSION['livres'][$_SESSION['livre']->getId()] = $_SESSION['livre'];
	}
}

$oManagerEdition = new ManagerEdition();
$oManagerEdition->setDb($db);
$oEdition = $oManagerEdition->read($_SESSION['livre']->getEdition());

$oManagerLangue = new ManagerLangue();
$oManagerLangue->setDb($db);
$oLangue = $oManagerLangue->read($_SESSION['livre']->getLangue());

?>

		<?php
		/*
			 * 2 cas:
			 *      connecté => modification
			 *      non connecté => lecture
			 */
		if (!empty($_SESSION['utilisateur'])) {
			//modification possible
		?>
			<form action="?page=livre&id=<?= $_SESSION['livre']->getId() ?>" method="post" enctype="multipart/form-data">
				<!-- input hidden pour le formulaire afin de gÃ©rer l'identifiant du livre
				<input type='hidden' name='id' value='<?= $_SESSION['livre']->getId() ?>'/>
                    <input type="text" name="titre" value="<?= $_SESSION['livre']->getTitre() ?>"/>
                    -->
				<h1><?= $_SESSION['livre']->getTitre() ?></h1>
				<br>

				<img src="image/<?php echo $_SESSION['livre']->getImage(); ?>" style="width: 200px; height: 200px;" />
				<br>
				<?php
				include_once "image.php";
				?>
				<h2><?= $_SESSION['livre']->getSousTitre() ?></h2>

				<br>
				<?php
				include_once "edition.php";

				?>

				<p>Nombre de page : <?= $oEdition->getNb_Page() ?></p><br>
				<p>ISBN : <?= $oEdition->getIsbn() ?></p><br>

				<?php
				include_once "langue.php";
				?>

				<label for="Resume">Resume : </label><br>
				<p name="resume"><?= $_SESSION['livre']->getResume() ?></p>

				<?php
				include_once "etat.php";
				?>


				<input type="submit" role="button" value="Modifier le livre" />
			</form>





<?php

		} else {
			//lecture seule
			
?>
	<section class="row align-items-start owl_book">
		<article class="col-12 col-md-12 owl_livre">
			<h1 class="titre"><?= $_SESSION['livre']->getTitre() ?></h1><br>
			<img src='image/<?= $_SESSION['livre']->getImage() ?>' class="livres" /><br>
			<h2><?= $_SESSION['livre']->getSousTitre() ?></h2>
			<label for='edition'>Edition : </label><?= $oEdition->getNom() ?><br>
			<label for='edition'>Nombre de page : </label><?= $oEdition->getNb_Page() ?><br>
			<label for='edition'>ISBN : </label><?= $oEdition->getIsbn() ?><br>
			<label for='langue'>Langue : </label><?= $oLangue->getLocale() ?><br>
			<label for='Resume'>Resume : </label><br>
			<p disabled='disabled'><?= $_SESSION['livre']->getResume() ?></p>
		</article>
	</section>

<?php
		}
?>


<?php
//}
