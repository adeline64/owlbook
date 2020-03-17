<?php
debug($_POST);
//chargement des langues pour laliste
$managerLangue = new ManagerLangue();
$managerLangue->setDb($db);
$listeLangues = $managerLangue->getLangueBy('originale');
$listeLanguesx2= $managerLangue->getLangueBy();

$managerEdition = new ManagerEdition();
$managerEdition->setDb( $db );
$listeEdition = $managerEdition->getEditionBy();

$managerEtat = new ManagerEtat();
$managerEtat->setDb( $db );
$listeEtat = $managerEtat->getEtatBy();

$managerGenre = new ManagerGenre();
$managerGenre->setDb( $db );
$listeGenre = $managerGenre->getGenreBy();

//Traitement si on envoie le formulaire
if (!empty($_POST)) {
	//verification donnees
	if ( ! isset(
		$_POST['titre'],
		$_POST['sousTitre'],
		$_POST['resume'],
		$_POST['image'],
		$_POST['mot_cle']
	))
	{
		//ERREUR
		echo "il manque une ou plusieurs donnees";
	} else {
		$managerLivre = new ManagerLivre();
		$managerLivre->setDb( $db );
		$managerLivre->add( $_POST );
	}
}
?>

<div class="row align-items-start">
    <div class="col-12 col-md-8 owl_pointsQR">
        <section class="page-section">
            <form action="?page=inscriLivre" method="post">
                <div class="form-group">
                    <label for="titre"> Titre : </label><br>
                    <input type="text" class="form-control" aria-describedby="titre" id="titre" name="titre">
                </div>

                <div class="form-group">
                    <label for="sousTitre"> Sous Titre </label><br>
                    <input type="text" class="form-control" aria-describedby="sousTitre" id="sousTitre" name="sousTitre">
                </div>

                <div class="form-group">
                    <label for="resume"> resume : </label><br>
                    <input type="text" class="form-control" aria-describedby="resume" id="resume" name="resume">
                </div>

                <div class="form-group">
                    <label for="image"> image (JPG)</label><br>
                    <input type="file" class="form-control" name="image" id="image" aria-describedby="image" /><br />
                </div>

                <div class="form-group">
                    <label for="mot_cle"> mot clé : </label><br>
                    <input type="text" class="form-control" aria-describedby="mot clé" id="mot_cle" name="mot_cle">
                </div>

                <div class="form-group">
                    <label for="edition"> Maison d'edition : </label><br>
                    <select name="edition">
                        <option value="-3">Choisissez une maison d'edition</option>
						<?php
						foreach ($listeEdition AS $edition) {
							?>
                            <option value="<?php echo $edition['id']; ?>"><?php echo $edition['nom']; ?></option>
							<?php
						}

						?>
                    </select>
                </div>


                <div class="form-group">
                    <label for="langue"> Langue : </label><br>
                    <select name="langue">
                        <option value="-1">Choisissez la langue <br>
                            dans lequel le livre est ecrit</option>
						<?php
						foreach ($listeLanguesx2 AS $langue) {
							?>
                            <option value="<?php echo $langue['id']; ?>"><?php echo $langue['locale']; ?></option>
							<?php
						}
						?>
                    </select><br>
                    <br>
                    <select name="langue">
                        <option value="-2">Choisissez la langue <br>
                            d'origine du livre</option>
						<?php
						foreach ($listeLangues AS $langue) {
							?>
                            <option value="<?php echo $langue['id']; ?>"><?php echo $langue['originale']; ?></option>
							<?php
						}
						?>
                    </select><br>
                </div><br>


                <div class="form-group">
                    <label for="etat"> Etat du livre : </label><br>
                    <select name="etat">
                        <option value="-3">Choisissez l'etat du livre </option>
						<?php
						foreach ($listeEtat AS $etat) {
							?>
                            <option value="<?php echo $etat['id']; ?>"><?php echo $etat['nom']; ?></option>
							<?php
						}
						?>


                    </select>
                </div>

                <div class="form-group">
                    <label for="genre"> Genre du livre : </label><br>
                    <p>Choisissez le genre du livre </p>
			            <?php
			            foreach ($listeGenre AS $genre) {
				            ?>
                            <input type="checkbox" value=""<?php echo $genre['id']; ?>"><?php echo $genre['nom']; ?><br>
				            <?php
			            }
			            ?>

                </div>

                <p>
                    <input type="submit" value="valider">
                </p>

            </form>
        </section>
    </div>
</div>


