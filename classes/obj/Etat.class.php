<?php
		//Generated by ObjectGenerator::generate() on 10/05/2019 12:52:19
class Etat {
	protected $id; /* int(11) */
	protected $nom; /* varchar(50) */
	protected $description; /* varchar(255) */
	protected $empty = true; // permet de savoir si l'objet est vide

	public function __construct($id=0,$nom='',$description='') {
		//Generated by ObjectGenerator::generateConstruct() on 10/05/2019 12:52:19
		$this->id = $id;
		$this->nom = $nom;
		$this->description = $description;

	}


	public function __clone() {
		//Generated by ObjectGenerator::generateClone() on 10/05/2019 12:52:19
		//Sur le clonage d'un objet on supprime l'identifiant
		$this->_description .= ' / Clone '.__CLASS__.' ID '.$this->_id;
		$this->_id = 0;
	}


	public function setId($nouvelleValeur) {
		//Generated by ObjectGenerator::generateSet() on 10/05/2019 12:52:19
		/* La modification de l'identifiant DB est interdite SAUF SI l'objet est vide au depart */
		if (!$this->getEmpty()) {
			return;
		}
		$this->id = $nouvelleValeur;
	}



	public function setNom($nouvelleValeur) {
		//Generated by ObjectGenerator::generateSet() on 10/05/2019 12:52:19
		$this->nom = $nouvelleValeur;
	}



	public function setDescription($nouvelleValeur) {
		//Generated by ObjectGenerator::generateSet() on 10/05/2019 12:52:19
		$this->description = $nouvelleValeur;
	}




	public function getId() {
		//Generated by ObjectGenerator::generateGet() on 10/05/2019 12:52:19
		return $this->id;
	}



	public function getNom() {
		//Generated by ObjectGenerator::generateGet() on 10/05/2019 12:52:19
		return $this->nom;
	}



	public function getDescription() {
		//Generated by ObjectGenerator::generateGet() on 10/05/2019 12:52:19
		return $this->description;
	}



	public function __toString() {
		//Generated by ObjectGenerator::generateToString() on 10/05/2019 12:52:19
		$chaine = 'Objet '.get_class($this).':<br/>';
		$chaine .= 'Le champ id vaut '.$this->getId().'<br/>';
		$chaine .= 'Le champ nom vaut '.$this->getNom().'<br/>';
		$chaine .= 'Le champ description vaut '.$this->getDescription().'<br/>';
		return $chaine;
	}

	public function save() {
		//Generated by ObjectGenerator::generateSave() on 10/05/2019 12:52:19
		if ($this->getId() > 0) {
			/* un identifiant superieur a 0 implique un ancien objet => UPDATE */
			return$this->update();
		} else {
			$requete = 'INSERT INTO etat (id,nom,description)';
			$requete .= ' VALUES ';
			$requete .= '(';
				$requete .= 'nom,';
				$requete .= 'description,';
			$requete = substr($requete,0,strlen($requete)-1);
			$requete .= ')';
			return $requete;
		}
	}

	public function update() {
		//Generated by ObjectGenerator::generateUpdate() on 10/05/2019 12:52:19
		if ($this->getId() == 0 || $this->getId() == null) {
			/* un identifiant 0 ou null implique un nouvel objet => INSERT */
			return$this->save();
		} else {
			$requete = 'UPDATE etat SET ';
			$requete .= 'nom = \''.$this->getNom().'\',';
			$requete .= 'description = \''.$this->getDescription().'\',';
			$requete = substr($requete,0,strlen($requete)-1);
			$requete .= ' WHERE id = '.$this->getId();
			return $requete;
		}
	}

	public function delete() {
		//Generated by ObjectGenerator::generateDelete() on 10/05/2019 12:52:19
		if ($this->getId() == 0 || $this->getId() == null) {
			throw new Exception(get_class($this).": aucun identifiant donn&eacute; pour supprimer");
		} else {
			return 'DELETE FROM etat WHERE id = '.$this->getId();
		}
	}

	public function getParent() {
		//Generated by ObjectGenerator::generateGetParent() on 10/05/2019 12:52:19
		return ('parent::__construct($id,$nom,$description);');
	}

	public function getAttributes() {
		//Generated by ObjectGenerator::generateGetAttributes() on 10/05/2019 12:52:19
		$result = array();
		$result2 = array();
		$reflection = new ReflectionClass($this);
		$result = $reflection->getdefaultProperties();
		$result = array_keys($result);
		foreach ($result AS $data) {
			$result2[] = substr($data,1);
		}
		return $result2;
	}

	public function compareTo($object) {
		//Generated by ObjectGenerator::generateCompareTo() on 10/05/2019 12:52:19
		$data = array();
		if ($object instanceof Etat) {
			if ($this->id != $object->getId()) {
				$data['id'] = $object->getId();
			}
			if ($this->nom != $object->getNom()) {
				$data['nom'] = $object->getNom();
			}
			if ($this->description != $object->getDescription()) {
				$data['description'] = $object->getDescription();
			}
		}
		return $data;
	}

	public function encodeDecodeJSON($json_str='') {
		//Generated by ObjectGenerator::generateEncodeDecodeJSON() on 10/05/2019 12:52:19
		if ($json_str == '') {
			// Objet standard a remplir
			$json= new stdClass();
			foreach ($this as $key => $value) {
				if (substr($key,0,1) == '_') {
					$key = substr($key,1);
					//on evite de faire sortir les objet fonctionnels
					if (strtolower(substr($key,0,1)) != 'o') {
						$json->$key = $value;
					}
				}
				$json->$key = $value;
			}
			return json_encode($json);
		} else {
			/* decodage et hydratation des datas JSON */
			$json = json_decode($json_str, 1);
			foreach ($json as $key => $value) {
				$method = 'set'.ucfirst($key);
				//Si la methode existe alors on l'utilise
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}
	}

	public function getClass() {
		//Generated by ObjectGenerator::generateGetClass() on 10/05/2019 12:52:19
		return get_class($this);
	}

	public function getEmpty() {
		//Generated by ObjectGenerator::generateIsEmpty() on 10/05/2019 12:52:19
		return $this->empty;
	}

	public function setEmpty($nouvelleValeurEmpty) {
		//Generated by ObjectGenerator::generateIsEmpty() on 10/05/2019 12:52:19
		if (is_bool($nouvelleValeurEmpty)) {
			$this->empty = $nouvelleValeurEmpty;
		}
	}

	public function affiche() {
		//Generated by ObjectGenerator::generateAffiche() on 10/05/2019 12:52:19
		/* Chargement de Smarty */
		require_once(_SMARTY_LOAD_);
		$smarty->assign('etat',$this);
		$smarty->assign('aListeMethodes',get_class_methods($this));
		$smarty->assign('urlVersMiniature',_URL_MINIATURES_.$this->getNom().'.jpg');
		/* Appel de l'affichage pour la classe en cour d'utilisation */
		$smarty->display(_TEMPLATES_BASE_.'classes/Etat.tpl');
	}

}
?>