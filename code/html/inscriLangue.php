<?php
debug($_POST);
if ( ! empty( $_POST ) ) {
	if ( ! isset(
		$_POST['locale'],
		$_POST['originale']
	))
	{
		echo "il manque une ou plusieurs donnees";
	} else {
		$managerLangue = new ManagerLangue();
		$managerLangue->setDb( $db );
		$managerLangue->add( $_POST );
	}
}
?>
<div class= "row align-items-start">

	<div class= "col-12 col-md-8 owl_pointsQR">
		<section class="page-section">

			<form action="?page=inscriLangue" method="post">

				<div class="form-group">
					<label for="locale"> Locale : </label><input type="text" class="form-control" aria-describedby="locale" id="locale" name="locale">
				</div>
				<div class="form-group">
					<label for="originale"> Originale : </label><input type="text" class="form-control" aria-describedby="originale" id="originale" name="originale">
				</div>

				<p>
					<input type="submit" class="btn-inscrit" value="enregistrer">
				</p>

			</form>
		</section>
	</div>
</div>
