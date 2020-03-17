<?php
debug($_POST);
if ( ! empty( $_POST ) ) {
	if ( ! isset(
		$_POST['nom'],
		$_POST['description'] ) )
	{
		echo "il manque une ou plusieurs donnees";
	} else {
		$managerEtat = new ManagerEtat();
		$managerEtat->setDb( $db );
		$managerEtat->add( $_POST );
	}
}
?>
	<div class="row align-items-start">
		<div class="col-12 col-md-8 owl_pointsQR">
			<section class="page-section">
				<form action="?page=inscriEtat" method="post">
					<div class="form-group">
						<label for="nom"> Etat </label>
						<input type="text" class="form-control" aria-describedby="Nom" id="nom" name="nom">
					</div>
					<div class="form-group">
						<label for="description"> Description </label>
						<input type="text" class="form-control" aria-describedby="description" id="description" name="description">
					</div>
                    <p>
                        <input type="submit" class="btn-inscrit" value="enregistrer">
                    </p>
				</form>
			</section>
		</div>
	</div>