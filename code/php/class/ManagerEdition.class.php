<?php


class ManagerEdition extends Manager {

    public function __construct( $mode = 'prod' ) {
      //  debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		parent::__construct( $mode );
	}

	public function read($id){
		// echo '<pre>'.print_r($id,true).'</pre>';

		// echo '<br>[debug]SESSION';
		// echo '<pre>'.print_r($id,true).'</pre>';
			$req = $this->db->prepare('SELECT * FROM edition WHERE id=:id');
			
			$req->bindValue('id', $id, PDO::PARAM_INT);
			$req->execute();
			$array = $req->fetch(PDO::FETCH_ASSOC);
        $edition = new edition($array);

        return $edition;
    }

	public function add($data) {

		try {
			$edition = new edition($data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
			
			$req = $this->db->prepare("INSERT INTO edition(nom,date_publication,isbn,nb_page) VALUES (:nom,:date_publication,:isbn,:nb_page)");
			$req->bindValue('nom', $edition->getNom(), PDO::PARAM_STR);
			$req->bindValue('date_publication', $edition->getDate_publication(), PDO::PARAM_STR);
			$req->bindValue('isbn', $edition->getIsbn(), PDO::PARAM_STR);
			$req->bindValue('nb_page', $edition->getNb_Page(), PDO::PARAM_STR);

			$executed = $req->execute();
			if ($executed) {
				$id = $this->db->lastInsertId();
				$edition->setId($id);
			} else {
				echo "<br>[debug] Erreur";
			}

	}

	public function getEditionBy($groupBy = 'nom'){
		$stmt = $this->db->query("SELECT id, nom, date_publication,nb_page FROM edition GROUP BY $groupBy");

		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getAllEdition() {
		// debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$stmt = $this->db->query("SELECT * FROM edition");
		$listeObjetsEdition = array();
		while ($data =  $stmt->fetch(PDO::FETCH_ASSOC)) {
			$listeObjetsEdition[] = new Edition($data);
		}
		return $listeObjetsEdition;
	}

	public function getEdition($id) {
		$stm = "SELECT * FROM edition WHERE id=:id";
		//preparation == protection des donn?es ? venir
		$stmt = $this->db->prepare($stm);
		//liaison des marqueur :toto aux donnees
		$stmt->bindValue('id',$id,PDO::PARAM_INT);
		//execution de la requete sur le serveur SQL
		$stmt->execute();
		return $stmt;
	}

	public function update($data) {

		// echo '<pre>'.print_r($data,true).'</pre>';

		// echo '<br>[debug]SESSION';
		// echo '<pre>'.print_r($data,true).'</pre>';

		// => voir addlivre pour modele
		$req = $this->db->prepare("UPDATE edition set nom=:nom,date_publication=:date_publication,isbn=:isbn,nb_page=:nb_page WHERE id=:id");
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT);
		$req->bindValue('nom', $data->getNom(), PDO::PARAM_STR);
		$req->bindValue('date_publication', $data->getDate_publication(), PDO::PARAM_STR);
		$req->bindValue('isbn', $data->getIsbn(), PDO::PARAM_STR);
		$req->bindValue('nb_page', $data->getNb_Page(), PDO::PARAM_STR);
		//execution de la requete sur le serveur SQL
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req->execute();
	}

	public function delete($id) {
		// =>voir  getLivre(id) pour modele
		$req = "DELETE FROM edition WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->bindValue('id',$id,PDO::PARAM_INT);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}

	}

}