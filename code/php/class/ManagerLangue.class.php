<?php


class ManagerLangue extends Manager {

	public function construct($mode='prod') {
		parent::__construct( $mode );
	}

	public function read($id){
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req = $this->db->prepare('SELECT * FROM langue WHERE id=:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$langue = new langue($array);

		return $langue;
	}

	public function add( $data) {
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		//bloc try/catch pour g�rer les exceptions
		//provenant de utilisateur
		try {
			$langue = new langue( $data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
		$req = $this->db->prepare('INSERT INTO langue (locale,originale) VALUES(:locale,:originale)');
		$req->bindValue('locale', $langue->getlocale(), PDO::PARAM_STR);
		$req->bindValue('originale', $langue->getOriginale(), PDO::PARAM_STR);
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$langue->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}
	}

	public function getLangueBy($orderBy = 'locale'){
		$stmt = $this->db->query("SELECT id, locale, originale FROM langue ORDER BY $orderBy");

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllLangue() {
		// debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$stmt = $this->db->query("SELECT * FROM langue");
		$listeObjetsLangue = array();
		while ($data =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$listeObjetsLangue[] = new Langue($data);
		}
		return $listeObjetsLangue;
	}

	public function getLangue($id) {
		$stm = "SELECT * FROM langue WHERE id=:id";
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
		$req = $this->db->prepare('UPDATE langue SET locale=:locale,originale=:originale WHERE id=:id');
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT);
		$req->bindValue('locale', $data->getLocale(), PDO::PARAM_STR);
		$req->bindValue('originale', $data->getOriginale(), PDO::PARAM_STR);
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}
	}

	public function delete($id) {
		// =>voir  getLivre(id) pour modele
		$req = "DELETE FROM langue WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}

	}



}