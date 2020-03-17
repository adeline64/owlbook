<?php
debug($_POST);
if ( ! empty( $_POST ) ) {
	if ( ! isset(
		$_POST['nom'] ) )
	{
		echo "il manque une ou plusieurs donnees";
	} else {
		$managerGenre = new ManagerGenre();
		$managerGenre->setDb( $db );
		$managerGenre->add( $_POST );
	}
}
?>
<div class="row align-items-start">
	<div class="col-12 col-md-8 owl_pointsQR">
		<section class="page-section">
			<form action="?page=inscriGenre" method="post">
				<div class="form-group">
					<label for="nom"> Genre </label>
					<input type="text" class="form-control" aria-describedby="Nom" id="nom" name="nom">
				</div>
				<p>
					<input type="submit" class="btn-inscrit" value="enregistrer">
				</p>
			</form>
		</section>
	</div>
</div>