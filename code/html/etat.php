<?php
//On va chercher TOUS les etats dans la base pour pouvoir en choisir un
$oManagerEtat = new ManagerEtat();
$oManagerEtat->setDb($db);
$listeEtat = $oManagerEtat->getAllEtat();
?>
<div class="form-group"><br>
    <label for="nom"> &Eacute;tat du livre : </label><br>
    <select name='etat' size='1'>
        <option value='-1' selected='selected'>Choisissez un &eacute;tat pour ce livre</option>
		<?php
		foreach ($listeEtat AS $etat) {
			//Le livre possède déjà un état => on le sélectionne avec $_SESSION['livre']->getEtat()
			echo "<option value='".$etat->getId()."' ".((isset($_SESSION['livre']) && $etat->getId() == $_SESSION['livre']->getEtat()) ? "selected='selected'": "").">".$etat->getNom()."</option>".PHP_EOL;
		}
		?>
    </select>
</div>