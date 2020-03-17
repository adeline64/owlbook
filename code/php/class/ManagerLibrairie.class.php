<?php


class ManagerLibrairie extends Manager {

	public function construct($mode='prod') {
		parent::__construct( $mode );
	}

	public function read($id){
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req = $this->db->prepare('SELECT * FROM librairie WHERE id=:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$librairie = new librairie($array);

		return $librairie;
	}

	public function add( $data) {
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		//bloc try/catch pour gérer les exceptions
		//provenant de utilisateur
		try {
			$librairie = new librairie( $data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
		$req = $this->db->prepare('INSERT INTO librairie (nom) VALUES(:nom)');
		$req->bindValue('nom', $librairie->getNom(), PDO::PARAM_STR);
		$req->execute();
		$id = $this->db->lastInsertId();
		$librairie->setId($id);
	}

	public function getAllLibrairie() {

		$stmt = $this->db->query("SELECT * FROM librairie");

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getLibrairie($id) {
		$stm = "SELECT * FROM librairie WHERE id=:id";
		//preparation == protection des donn?es ? venir
		$stmt = $this->db->prepare($stm);
		//liaison des marqueur :toto aux donnees
		$stmt->bindValue('id',$id,PDO::PARAM_INT);
		//execution de la requete sur le serveur SQL
		$stmt->execute();
		return $stmt;
	}

	public function update($data){
		echo '<pre>'.print_r($data,true).'</pre>';

		echo '<br>[debug]SESSION';
		echo '<pre>'.print_r($_SESSION,true).'</pre>';
		$req = $this->db->prepare('UPDATE librairie SET nom=:nom WHERE id=:id');
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT);
		$req->bindValue('nom', $data->getNom(), PDO::PARAM_STR);
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}
	}

	public function delete($id) {
		// =>voir  getLivre(id) pour modele
		$req  = "DELETE FROM librairie WHERE id=:id";
		$stmt = $this->db->prepare( $req );
		$stmt->execute();
		if ( $stmt->rowCount() == 1 ) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}
	}


}