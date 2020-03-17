<?php

if (!isset($_SESSION['id'],$_SESSION['email'])) {
//NON Co
?>

<div class="container">
    <div class= "row align-items-start" >
        <div class= "col-12 col-md-4 owl">
            <p>Vous �tes actuellement d�connecter, merci de vous reconnecter ici : <a href=?page=connexion> Connexion </a> </p>
            <p>Vous n'avez actuellement pas de compte ? Merci d'en cr�er un ici : <a href=?page=inscription> Inscription </a> </p>
        </div>
    </div>
</div>

	<?php

}else{


	?>
<div class= "row align-items-start">

    <div class= "col-12 col-md-8 owl">

        <section class="content">
            <section class="content">

                <div class="col-md-8 col-md-offset-2">

                    <div class="panel panel-default">
                        <div class="panel-body">

                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-filter" onclick="afficheCacheDiv('profil')">Mon compte</button>
                                    <button type="button" class="btn btn-warning btn-filter" onclick="afficheCacheDiv('Livre')">Les livres que je poss�de</button>
                                </div>
                            </div>
                            <div id="profil">
                                <table>
                                    <tr>
                                        <td>
                                            <div class="media">
                                                <div class="media-body">
                                                    <span class="media-meta pull-right"></span>
                                                    <h4 class="title">
                                                        Lorem Impsum
                                                        <span class="pull-right pagado"></span>
                                                    </h4>
                                                    <p class="summary">les infos sur le compte.</p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div id="Livre">
                                <table>
                                    <tr>
                                        <div class="media">
                                            <div>
                                                <p class="summary">livre posseder (image)...</p>

                                            </div>
                                        </div>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </div>
</div>


<?php

    }

?>
