<?php


class ManagerGenre extends Manager{

	public function __construct( $mode = 'prod' ) {
		// debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		parent::__construct( $mode );
	}

	public function read($id){
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req = $this->db->prepare('SELECT * FROM genre WHERE id=:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$genre = new genre($array);
		return $genre;
	}

	public function add( $data) {
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		try {
			$genre = new genre($data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}

		$req = $this->db->prepare("INSERT INTO genre(nom) VALUES (:nom)");
		$req->bindValue('nom', $genre->getNom(), PDO::PARAM_STR);

		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$genre->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}
	}


	public function getGenreBy($groupBy = 'nom'){
		$stmt = $this->db->query("SELECT id, nom FROM genre GROUP BY $groupBy");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllGenre() {
		// debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$stmt = $this->db->query("SELECT * FROM genre");
		$listeObjetsGenre = array();
		while ($data =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$listeObjetsGenre[] = new genre($data);
		}
		return $listeObjetsGenre;
	}

	public function getGenre($id) {
		$stm = "SELECT * FROM genre WHERE id=:id";
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
		$req = $this->db->prepare('UPDATE genre SET nom=:nom WHERE id=:id');
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT);
		$req->bindValue('nom', $data->getNom(), PDO::PARAM_STR);
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}
	}

	public function delete($id) {
		// =>voir  getLivre(id) pour modele
		$req = "DELETE FROM genre WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}

	}

}