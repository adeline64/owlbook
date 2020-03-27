<?php


class ManagerLocalisation extends ManagerLibrairie{

	public function construct($mode='prod') {
		parent::__construct( $mode );
	}

	public function read($id){
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req = $this->db->prepare('SELECT * FROM localisation WHERE id=:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$localisation = new localisation($array);

		return $localisation;
	}

	public function add( $data) {
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		//bloc try/catch pour g�rer les exceptions
		//provenant de utilisateur
		try {
			$localisation = new localisation( $data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
		$req = $this->db->prepare('INSERT INTO localisation (ville, codepostal, pays, librairie) VALUES(:ville,:codepostal,:pays,:librairie)');
		$req->bindValue('ville', $localisation->getVille(), PDO::PARAM_STR);
		$req->bindValue('codepostal', $localisation->getCodePostal(), PDO::PARAM_STR);
		$req->bindValue('pays', $localisation->getPays(), PDO::PARAM_STR);
		$req->bindValue('librairie', $localisation->getLibrairie(), PDO::PARAM_INT);
		$req->execute();
		$id = $this->db->lastInsertId();
		$localisation->setId($id);
	}

	public function getAllLocalisation() {

		$stmt = $this->db->query("SELECT * FROM localisation");

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getLocalisation($id) {
		$stm = "SELECT * FROM localisation WHERE id=:id";
		//preparation == protection des donn?es ? venir
		$stmt = $this->db->prepare($stm);
		//liaison des marqueur :toto aux donnees
		$stmt->bindValue('id',$id,PDO::PARAM_INT);
		//execution de la requete sur le serveur SQL
		$stmt->execute();
		return $stmt;
	}

	public function update($data){
		// echo '<pre>'.print_r($data,true).'</pre>';

		// echo '<br>[debug]SESSION';
		// echo '<pre>'.print_r($_SESSION,true).'</pre>';
		$req = $this->db->prepare('UPDATE localisation SET nom=:nom, prenom=:prenom, adresse=:adresse, codePostal=:codePostal,ville=:ville,email=:email WHERE id=:id');
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT);
		$req->bindValue('ville', $data->getVille(), PDO::PARAM_STR);
		$req->bindValue('codepostal', $data->getCodePostal(), PDO::PARAM_STR);
		$req->bindValue('pays', $data->getPays(), PDO::PARAM_STR);
		$req->bindValue('librairie', $data->getLibrairie(), PDO::PARAM_INT);
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}
	}

	public function delete($id) {
		// =>voir  getLivre(id) pour modele
		$req = "DELETE FROM localisation WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}

	}




}