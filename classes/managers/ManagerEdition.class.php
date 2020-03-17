<?php
	/*
	 * AUTO-GENERATED FILE BY ManagerGenerator.class.php
	 */

class ManagerEdition {
	/** Instance de la classe (managerEdition) */
	private static $_instance = null;

	/** Connexion a la base de donnees (database) */
	private static $_oConnexion = null;

	/** Liste des objet de la classe (Edition) */
	private static $_aListeEdition = array();

	protected function __construct() {
		//Generated by ManagerGenerator::generateConstruct() on 10/05/2019 12:52:19
	}

	public function __destruct() {
		//Generated by ManagerGenerator::generateDestruct() on 10/05/2019 12:52:19
		/* TODO ??*/
	}

	public static function getInstance() {
		//Generated by ManagerGenerator::generateGetInstance() on 10/05/2019 12:52:19
		if (is_null(self::$_instance)) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	public function __clone() {
		//Generated by ManagerGenerator::generateClone() on 10/05/2019 12:52:19
		throw new Exception(get_class($this).": Le clonage n'est pas autoris&eacute;", E_USER_ERROR);
	}

	public function setConnexion() {
		//Generated by ManagerGenerator::generateSetConnexion() on 10/05/2019 12:52:19
		self::$_oConnexion = database::getInstance();/* pas besoin de parametrer, un manager arrive apres la conf */
	}

	public function __set($name,$value) {
		//Generated by ManagerGenerator::generateSet() on 10/05/2019 12:52:19
		throw new Exception(get_class($this).": Le set 'noname' n'est pas autoris&eacute;", E_USER_ERROR);
	}

	public function __get($name) {
		//Generated by ManagerGenerator::generateGet() on 10/05/2019 12:52:19
		throw new Exception(get_class($this).": Le get 'noname' n'est pas autoris&eacute;", E_USER_ERROR);
	}

	public function getById($value=0) {
		//Generated by ManagerGenerator::generateGetById() on 10/05/2019 12:52:19
		return FactoryEdition::getFromTableEdition($value);
	}

	public function getByJoueurId($value) {
		//Generated by ManagerGenerator::generateGetByJoueurId() on 10/05/2019 12:52:19
		return FactoryEdition::getFromExtTableJoueur($value);
	}

	public function getFromExtTableLivre($idlivre=0) {
		//Generated by ManagerGenerator::generateGetFromTableFromFK() on 10/05/2019 12:52:19
		/* Appel de la methode de la Fabrique */
		return FactoryEdition::getFromExtTableLivre($idlivre);
	}

	public function deleteCompositeLinksFromLivre($idlivre) {
		//Generated by ManagerGenerator::generateDeleteCompositeLinks() on 10/05/2019 12:52:19
		$requete = 'DELETE FROM edition WHERE livre = '.$idlivre;
	}

	public function getFromExtTableLangue($idlangue=0) {
		//Generated by ManagerGenerator::generateGetFromTableFromFK() on 10/05/2019 12:52:19
		/* Appel de la methode de la Fabrique */
		return FactoryEdition::getFromExtTableLangue($idlangue);
	}

	public function deleteCompositeLinksFromLangue($idlangue) {
		//Generated by ManagerGenerator::generateDeleteCompositeLinks() on 10/05/2019 12:52:19
		$requete = 'DELETE FROM edition WHERE langue = '.$idlangue;
	}

	public function delete($object=array()) {
		//Generated by ManagerGenerator::generateDelete() on 10/05/2019 12:52:19
		/* Verification */
		if (empty($object)) {
			throw new Exception(get_class($this).": La suppression se fait sur un objet.", E_USER_ERROR);
		}
		/* si ce n'est pas une instance de la classe, on la cree */
		if (! $object instanceof Edition) {
			$oEdition = new Edition($object['id'],$object['date_publication'],$object['isbn'],$object['nb_page'],$object['couverture'],$object['livre'],$object['langue']);
		} else {
			$oEdition = $object;
		}
		/* Appel de la methode delete de l'objet */
		/* Tout se passe dans une transaction ouverte plus haut */
			/* Execution de la requete */
		if (database::getInstance()->executeRequete($oEdition->delete())) {
			/* Requete OK */
			return true;
		} else {
			/* Requete NOK lancement d'une exception PDO */
			throw new PDOException('Erreur sur delete (Edition)');
		}
	}

	public function update($object=array()) {
		//Generated by ManagerGenerator::generateUpdate() on 10/05/2019 12:52:19
		/* Verification */
		if (empty($object)) {
			throw new Exception(get_class($this).": la mise &agrave; jour se fait sur un objet.", E_USER_ERROR);
		}
		/* si ce n'est pas une instance de la classe, on la cree */
		if (! $object instanceof Edition) {
			$oEdition = new Edition($object['id'],$object['date_publication'],$object['isbn'],$object['nb_page'],$object['couverture'],$object['livre'],$object['langue']);
		} else {
			$oEdition = $object;
		}
		/* Maintenant on compare avec celle en session */
		if (!empty($_SESSION['edition']) && sizeof($_SESSION['edition']->compareTo($oEdition)) > 0) {
			$_SESSION['edition'] = $oEdition;
		}
		/* on update car les objets sont different */
		return database::getInstance()->executeRequete($oEdition->update());
	}

	public function save($object=array()) {
		//Generated by ManagerGenerator::generateSave() on 10/05/2019 12:52:19
		/* Verification */
		if (empty($object)) {
			throw new Exception(get_class($this).": la sauvegarde se fait sur un objet.", E_USER_ERROR);
		}
		/* si ce n'est pas une instance de la classe, on la cree */
		if (! $object instanceof Edition) {
			$oEdition = new Edition($object['id'],$object['date_publication'],$object['isbn'],$object['nb_page'],$object['couverture'],$object['livre'],$object['langue']);
		} else {
			$oEdition = $object;
		}
		/* Appel de la methode update de l'objet */
		return database::getInstance()->executeRequete($oEdition->save());
	}

	public function findBy($champ,$data='') {
		//Generated by ManagerGenerator::generateFindBy() on 10/05/2019 12:52:19
		/* creation d'un objet de base de la classe */
		$object = new Edition();
		$resultat = array();
		for ($i = 0; $i < sizeof($this -> _aListeEdition); $i++) {
			$object = $this -> _aListeEdition[$i];
			if ($object -> {'_'.strtolower($champ)} == $data) {
				$resultat[] = $object;
			}
		}
		if (sizeof($resultat) > 0) {
			//existe
			return $resultat;
		} else {
			//n'existe pas
			return "Pas de Edition de ".strtolower($champ)." '".$data."'";
		}
	}

	public function getEditionVide() {
		//Generated by ManagerGenerator::generateGetObjetVide() on 10/05/2019 12:52:19
		return new Edition();
	}


}
?>