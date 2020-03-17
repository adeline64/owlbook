<?php
//On va chercher TOUS les etats dans la base pour pouvoir en choisir un
$oManagerLangue = new ManagerLangue();
$oManagerLangue->setDb($db);
$listeLangue = $oManagerLangue->getAlllangue();
?>
<div class="form-group"><br>
    <label for="nom"> Dans quel langue avez vous ce livre ? : </label><br>
    <select name='langue' size='1'>
        <option value='-1' selected='selected'>Choisissez la langue pour ce livre</option>
		<?php
		foreach ($listeLangue AS $langue) {
			//Le livre poss�de d�j� un �tat => on le s�lectionne avec $_SESSION['livre']->getLangue()
			echo "<option value='".$langue->getId()."' ".((isset($_SESSION['livre']) && $langue->getId() == $_SESSION['livre']->getLangue()) ? "selected='selected'": "").">".$langue->getLocale()."</option>".PHP_EOL;
		}
		?>
    </select>
</div>