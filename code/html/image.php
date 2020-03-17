<?php
//On va chercher TOUTES les edition dans la base pour pouvoir en choisir une
$oManagerImage = new ManagerImage();
$listeImages = $oManagerImage->getAllImage();

?>
<div class="form-group"><br>
    <label for="image">Nouvelle Image du livre : </label>
    <br>
    &Agrave; partir d'une image sur votre PC:
    <br>
    <input type="file" id="image_<?php echo $_SESSION['livre']->getImage(); ?>" name="image" />
    <br>
    <!-- &Agrave; partir d'une image d&eacute;j&agrave; charg&eacute;e:
    <br>
    <select id="image" name='image' size='1' onchange="change();">
        <option value='-1' selected='selected'>Choisissez une image pour ce livre</option>
		<?php
        // foreach ($listeImages AS $image) {
        //     debug($image);
        // 	echo "<option value='".$image->getNom()."'>".$image->getNom()."</option>".PHP_EOL;
        // 	debug($image);

        // }
        ?>
    </select> -->
</div>