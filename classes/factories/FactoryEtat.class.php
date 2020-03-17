<?php
		//Generated by FactoryGenerator::generate() on 10/05/2019 12:52:19
abstract class FactoryEtat {

	public static function getFromTableEtat($id=0) {
		//Generated by FactoryGenerator::generateGetAllFromTable() on 10/05/2019 12:52:19
		$listeObjet = array();
		// Lancement de la requete
		if (empty(self::$_requete)) {
			$requete = 'SELECT * FROM `etat`';
		} else {
			$requete = self::$_requete;
		}
		if (!is_array($id)) {
			if ($id > 0) {
				$requete .= ' WHERE id = :id';
				//Il faut que le parametre soit dans un array pour le BIND
				$id = array(':id' => $id);
			} else {
				/* Tous les objets ==> il faut les ordonner */
				$requete .= ' ORDER BY id ASC';
			}
		} else {
			$requete .= ' WHERE id IN ('.implode(",",$id).') ORDER BY id ASC';
		}
		database::getInstance() -> prepareRequete($requete);
		if (is_array($id) || $id > 0) {
			database::getInstance() -> bind($id);
		}
		if (! database::getInstance() -> executeRequete()) {
			throw new Exception(__CLASS__.'::'.__FUNCTION__.'(): Impossible de lire la table etat');
		}
		// Recuperation des donnees
		$datas = database::getInstance() -> getTableauResultat();
		/* Traitement des donnees */
		foreach ($datas AS $data) {
			/* objet par defaut */
			$listeObjet[] = new Etat($data['id'],$data['nom'],$data['description']);
		}
		if (!empty($listeObjet) && sizeof($listeObjet) == 1) {
			$listeObjet = $listeObjet[0];
		}
		return $listeObjet;
	}


}
?>