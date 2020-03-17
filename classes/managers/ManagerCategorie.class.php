<?php
	/*
	 * AUTO-GENERATED FILE BY ManagerGenerator.class.php
	 */

class ManagerCategorie {
	/** Instance de la classe (managerCategorie) */
	private static $_instance = null;

	/** Connexion a la base de donnees (database) */
	private static $_oConnexion = null;

	/** Liste des objet de la classe (Categorie) */
	private static $_aListeCategorie = array();

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
		return FactoryCategorie::getFromTableCategorie($value);
	}

	public function getByJoueurId($value) {
		//Generated by ManagerGenerator::generateGetByJoueurId() on 10/05/2019 12:52:19
		return FactoryCategorie::getFromExtTableJoueur($value);
	}

	public function delete($object=array()) {
		//Generated by ManagerGenerator::generateDelete() on 10/05/2019 12:52:19
		/* Verification */
		if (empty($object)) {
			throw new Exception(get_class($this).": La suppression se fait sur un objet.", E_USER_ERROR);
		}
		/* si ce n'est pas une instance de la classe, on la cree */
		if (! $object instanceof Categorie) {
			$oCategorie = new Categorie($object['id'],$object['nom']);
		} else {
			$oCategorie = $object;
		}
		/* Appel de la methode delete de l'objet */
		/* Tout se passe dans une transaction ouverte plus haut */
			/* Execution de la requete */
		if (database::getInstance()->executeRequete($oCategorie->delete())) {
			/* Requete OK */
			return true;
		} else {
			/* Requete NOK lancement d'une exception PDO */
			throw new PDOException('Erreur sur delete (Categorie)');
		}
	}

	public function update($object=array()) {
		//Generated by ManagerGenerator::generateUpdate() on 10/05/2019 12:52:19
		/* Verification */
		if (empty($object)) {
			throw new Exception(get_class($this).": la mise &agrave; jour se fait sur un objet.", E_USER_ERROR);
		}
		/* si ce n'est pas une instance de la classe, on la cree */
		if (! $object instanceof Categorie) {
			$oCategorie = new Categorie($object['id'],$object['nom']);
		} else {
			$oCategorie = $object;
		}
		/* Maintenant on compare avec celle en session */
		if (!empty($_SESSION['categorie']) && sizeof($_SESSION['categorie']->compareTo($oCategorie)) > 0) {
			$_SESSION['categorie'] = $oCategorie;
		}
		/* on update car les objets sont different */
		return database::getInstance()->executeRequete($oCategorie->update());
	}

	public function save($object=array()) {
		//Generated by ManagerGenerator::generateSave() on 10/05/2019 12:52:19
		/* Verification */
		if (empty($object)) {
			throw new Exception(get_class($this).": la sauvegarde se fait sur un objet.", E_USER_ERROR);
		}
		/* si ce n'est pas une instance de la classe, on la cree */
		if (! $object instanceof Categorie) {
			$oCategorie = new Categorie($object['id'],$object['nom']);
		} else {
			$oCategorie = $object;
		}
		/* Appel de la methode update de l'objet */
		return database::getInstance()->executeRequete($oCategorie->save());
	}

	public function findBy($champ,$data='') {
		//Generated by ManagerGenerator::generateFindBy() on 10/05/2019 12:52:19
		/* creation d'un objet de base de la classe */
		$object = new Categorie();
		$resultat = array();
		for ($i = 0; $i < sizeof($this -> _aListeCategorie); $i++) {
			$object = $this -> _aListeCategorie[$i];
			if ($object -> {'_'.strtolower($champ)} == $data) {
				$resultat[] = $object;
			}
		}
		if (sizeof($resultat) > 0) {
			//existe
			return $resultat;
		} else {
			//n'existe pas
			return "Pas de Categorie de ".strtolower($champ)." '".$data."'";
		}
	}

	public function getCategorieVide() {
		//Generated by ManagerGenerator::generateGetObjetVide() on 10/05/2019 12:52:19
		return new Categorie();
	}


}
?>