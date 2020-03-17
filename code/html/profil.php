<?php
if (empty($_SESSION['utilisateur'])) {
	//NON Co



?>

	<div class="row align-items-start">
		<div class="col-12 col-md-4 owl">
			<p>Vous &ecirc;tes actuellement d&eacute;connect&eacute;, merci de vous reconnecter <a href="?page=connexion"> Connexion </a> </p>
			<p>Vous n'avez actuellement pas de compte ? Merci d'en cr&eacute;er un <a href="?page=inscription"> Inscription </a> </p>
		</div>
	</div>

<?php
} else {

	if (!empty($_POST)) {
		debug($_POST, true);
		$oManagerUtilisateur = new ManagerUtilisateur();
		$oManagerUtilisateur->setDb($db);

		//on va la jouer fine, comme POST contient les cl� correspondant aux nom de m�thodes set<CLE>
		// on appelle l'hydrate de Utilisateur :P
		debug("Utilisateur AVANT", true);
		debug($_SESSION['utilisateur'], true);
		$_SESSION['utilisateur']->hydrate($_POST);
		debug("Utilisateur APRES", true);
		debug($_SESSION['utilisateur'], true);

		//puis lon le sauve
		$oManagerUtilisateur->update($_SESSION['utilisateur']);
	}
?>
	<div class="row align-items-start owlprofil">
		<div class="col col-md col-lg ">
			<form action="?page=profil" method="post">

				<?php

				echo '<table>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label>Nom : </label> <input type="text" name="nom" id="nom" value="' . $_SESSION['utilisateur']->getNom() . '" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'nom\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label>Prénom : </label> <input type="text" name="prenom" id="prenom" value="' . $_SESSION['utilisateur']->getPrenom() . '" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'prenom\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label>adresse : </label> <input type="text" name="adresse" id="adresse" value="' . $_SESSION['utilisateur']->getAdresse() . '" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'adresse\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label> Code Postal : </label> <input type="text" name="codepostal" id="codePostal" value="' . $_SESSION['utilisateur']->getCodePostal() . '" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'codepostal\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label>Ville : </label> <input type="text" name="ville" id="ville" value="' . $_SESSION['utilisateur']->getVille() . '" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'ville\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '</table>' . PHP_EOL;
				echo '<hr>';
				echo '<table>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label>email : </label> <input type="text" name="email" value="' . $_SESSION['utilisateur']->getEmail() . '" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'nom\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label>vieux mot de passe : </label> <input type="text" name="oldPassword" value="Entrez l\'ancien mot de passe" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'nom\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label>Nouveau mot de passe : </label> <input type="text" name="newPassword1" placeholder="Entrez le nouveau mot de passe" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'nom\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '    <tr>' . PHP_EOL;
				echo '        <td><label>Nouveau mot de passe : </label> <input type="text" name="newPassword2" placeholder="Re-entrer le nouveau mot de passe" disabled/>&nbsp;<input type="checkbox" name="modifieNom" onclick="activeDesactiveInput(\'nom\');"/></td>' . PHP_EOL;
				echo '    </tr>' . PHP_EOL;
				echo '</table>' . PHP_EOL;

				?>

				<div class="btn-group" role="group" aria-label="Basic example">
					<input type="submit" class="btn btn-modifier" role="button" value="Modifier les informations" />
				</div>
			</form>
		</div>
	</div>
<?php
}
?>