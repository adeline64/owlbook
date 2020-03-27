<?php


class ManagerEtat extends Manager {

	public function __construct( $mode = 'prod' ) {
		// debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		parent::__construct( $mode );
	}


	public function read($id){
	    // debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$req = $this->db->prepare('SELECT * FROM etat WHERE id=:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$etat = new etat($array);
		return $etat;
	}

	public function add($data) {
	    // debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		try {
			$etat = new etat($data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}

		$req = $this->db->prepare("INSERT INTO etat(nom,description) VALUES (:nom,:description)");

		$req->bindValue('nom', $etat->getNom(), PDO::PARAM_STR);

		$req->bindValue('description', $etat->getDescription(), PDO::PARAM_STR);

		$executed = $req->execute();

		if ($executed) {

			$id = $this->db->lastInsertId();

			$etat->setId($id);
			
		} else {
			echo "<br>[debug] Erreur";
		}

	}

	public function getEtatBy($groupBy = 'nom'){
		$stmt = $this->db->query("SELECT id, nom, description FROM etat GROUP BY $groupBy");

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllEtat() {
		// debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$stmt = $this->db->query("SELECT * FROM etat");
		$listeObjetsEtat = array();
		while ($data =  $stmt->fetch(PDO::FETCH_ASSOC)) {
		    $listeObjetsEtat[] = new etat($data);
		}
		return $listeObjetsEtat;
	}

	public function getEtat($id) {
		$stm = "SELECT * FROM etat WHERE id=:id";
		//preparation == protection des donn?es ? venir
		$stmt = $this->db->prepare($stm);
		//liaison des marqueur :toto aux donnees
		$stmt->bindValue('id',$id,PDO::PARAM_INT);
		//execution de la requete sur le serveur SQL
		$stmt->execute();
		return $stmt;
	}

	public function update($data) {
	    // debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		// => voir addlivre pour modele
		$req = $this->db->prepare("UPDATE etat set nom=:nom,description=:description WHERE id=:id");
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT);
		$req->bindValue('nom', $data->getNom(), PDO::PARAM_STR);
		$req->bindValue('description', $data->getDecription(), PDO::PARAM_STR);
		$req->execute();
	}

	public function delete($id) {
		// =>voir  getLivre(id) pour modele
		$req = "DELETE FROM etat WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}
	}
}