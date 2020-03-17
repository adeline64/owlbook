<?php
debug($_POST);


//Traitement si on envoie le formulaire
if (!empty($_POST)) {
	//verification donnees
	if ( ! isset($_POST['nom'],$_POST['date_publication'],$_POST['isbn'],$_POST['nb_page'])) {
		//ERREUR
		echo "il manque une ou plusieurs donnees";
	} else {
		$managerEdition = new ManagerEdition();
		$managerEdition->setDb( $db );
		$managerEdition->add( $_POST );
	}
}
?>
<div class="row align-items-start">
    <div class="col-12 col-md-8 owl_pointsQR">
        <section class="page-section">
            <form action="?page=inscriEdition" method="post">
                <div class="form-group">
                    <label for="nom"> Nom : </label>
                    <input type="text" class="form-control" aria-describedby="Nom" id="nom" name="nom">
                </div>

                <div class="form-group">
                    <label for="date_publication"> Date de Publication : </label>
                    <input type="text" class="form-control" aria-describedby="date_publication" id="date_publication" name="date_publication">
                </div>

                <div class="form-group">
                    <label for="isbn"> ISBN : </label>
                    <input type="text" class="form-control" aria-describedby="isbn" id="isbn" name="isbn">
                </div>

                <div class="form-group">
                    <label for="nb_page"> Nombre de page : </label>
                    <input type="text" class="form-control" aria-describedby="nb_page" id="nb_page" name="nb_page">
                </div>

                <p>
                    <input type="submit" value="valider">
                </p>

            </form>
        </section>
    </div>
</div>
