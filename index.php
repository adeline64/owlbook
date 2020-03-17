<?php

// error_reporting(E_ALL);

//Autoload charg� AVANT la session pour cr�er les objets stock�s en session
require_once 'include/autoload.php';

/*
     * MODE DEBUG:
     *      - 1: actif
     *      - 0: inactif
     */
define('_DEBUG_', 0);
define('_NB_LIVRE_PAGE_',12);

//Les fonctions communes
require_once 'include/functions.php';

// On demarre la session
session_start();

//la connexion � la base
require_once 'include/DBConnexion.php';

// if (!empty($_SESSION)) {
//     debug($_SESSION);
// }

if (array_key_exists("initsession", $_POST)) {
    $_SESSION = array();
    debug($_SESSION);
}
?>

<!-- header -->

<?php

include_once "code/html/header.php"

?>

<body>

    <form method="post">
        <input type="hidden" name="initsession" value="1" />
        <input type="submit" value="Init Session" />
    </form>

    <!-- contenu -->


    <?php
    include_once "code/html/navbar2.php";
    ?>

    <section class="container">

        <?php

        include_once "include/route.php"

        ?>

    </section>

    <?php

    include_once "code/html/footer.php"

    ?>



</body>

</html>