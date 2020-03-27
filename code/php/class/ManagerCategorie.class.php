<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 25/02/2019
 * Time: 21:45
 */

class ManagerCategorie extends Manager {

	public function __construct( $mode = 'prod' ) {
		//  debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		parent::__construct( $mode );
	}

	public function read($id){
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$req = $this->db->prepare('SELECT * FROM categorie WHERE id=:id');
		$req->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$categorie = new categorie($array);

		return $categorie;
	}

	public function add($data) {
		try {
			// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
			// debug($data,true);
			$categorie = new categorie($data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
		$req = $this->db->prepare( "INSERT INTO categorie(nom) VALUES (:nom)");
		//liaison des marqueur :toto aux donnees
		$req->bindValue('nom', $categorie->getNom(), PDO::PARAM_STR);
		//execution de la requete sur le serveur SQL

		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$categorie->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}
	}

	public function getAllCategorie() {

			$stmt = $this->db->query("SELECT * FROM categorie");
			$categories = array();
			while ($data = $stmt->fetch()) {
				$categorie = new categorie($data);
				$categories[$categorie->getId()] = $categorie;
			}
		}

	public function getCategorie($id) {
		$stm = "SELECT * FROM categorie WHERE id=:id";
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
		// echo '<pre>'.print_r($data,true).'</pre>';

		$req = $this->db->prepare('UPDATE categorie SET nom=:nom WHERE id=:id');
		$req->bindValue('id', $data->getId(), PDO::PARAM_INT);
		$req->bindValue('nom', $data->getNom(), PDO::PARAM_STR);
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}
	}

	public function delete($id) {
		// =>voir  getLivre(id) pour modele
		$req = "DELETE FROM categorie WHERE id=:id";
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