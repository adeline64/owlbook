<?php
//On va chercher TOUTES les edition dans la base pour pouvoir en choisir une
$oManagerEdition = new ManagerEdition();
$oManagerEdition->setDb($db);
$listeEdition = $oManagerEdition->getAllEdition();
?>
<section class="form-group"><br>
    <label for="nom"> &Eacute;dition du livre : </label><br>
    <select name='edition' size='1'>
        <option value='-1' selected='selected'>Choisissez un &eacute;dition pour ce livre</option>
		<?php
            foreach ($listeEdition AS $edition) {
                //Le livre poss�de d�j� un �tat => on le s�lectionne avec $livre->getEdition()
                echo "<option value='".$edition->getId()."' ".((isset($_SESSION['livre']) && $edition->getId() == $_SESSION['livre']->getEdition()) ? "selected='selected'": "").">".$edition->getNom()."</option>".PHP_EOL;
            }
		?>
    </select>

</section>