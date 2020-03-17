<?php
    try {
        $db = new PDO('mysql:host=localhost;dbname=owlbook;charset=utf8', 'root', 'toto',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        // $db = new PDO('mysql:host=localhost;dbname=owlbook;charset=utf8', 'root', 'root',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    } catch (Exception $e) {
    	echo 'Connexion impossible:<br>'.$e->getMessage();
    	exit;
    }