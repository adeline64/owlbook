<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 20/10/2018
 * Time: 17:48
 */

class ManagerLivre extends Manager{

	public function __construct( $mode = 'prod' ) {
		// debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		parent::__construct( $mode );
	}

	public function read($id){
		debug("ID DEMANDE: ");
		debug($id);
		$req = "select li.*,ed.nom AS nom_publication, et.nom AS nom_etat,la.originale AS langue_originale";
		$req .= " from livre li left join edition ed ON ed.id = edition";
		$req .= " left join langue la ON la.id = langue";
		$req .= " left join etat et ON et.id = etat";
		$req .= " WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->bindValue('id', $id, PDO::PARAM_INT);
		$req->execute();
		$array = $req->fetch(PDO::FETCH_ASSOC);
		$livre = new Livre($array);
		return $livre;
	}

	/**
 * Commentaire documentant de la fonction recherche(parametre)
 * La fonction permet de rechercher un livre par une portion de son titre
 * @param recherche la chaine recherchée dans le titre
 * @return listeLivres le(s) livre(s) trouvé par la recherche dans la bibliothèque
 */
public function recherche($recherche){
	//appel de la focntion debug pour tracer ce qu'on fait
	// debug('<br>[debug]Dans "'.CLASS."::".FUNCTION.'" [/debug]');

	//on initialise un tabelau qui sera renvoyé
	$listeLivres = array();

	//requete SQL de recherche dans la table livre avec un titre contenant
	// au moins la chaine contenue dans le paramètre $recherche
	// pour sécuriser on pose un marqueur :recherche 
	$req = "SELECT * FROM livre WHERE titre LIKE :recherche";

	//on prepare la requete, la fonction retourne un objet PDOStatement (voir doc)
	$stm = $this->db->prepare($req);

	//on lie le marqueur de la requete à la valeur de recherche que va
	//attendre la fonction SQL LIKE dans notre cas "%<une_chaine>%"
	$stm->bindValue(':recherche',"%".$recherche."%");

	// Execution de la requete sur le serveur SQL
	$stm->execute();

	// Maintenant on va parcourir le résultat renvoyé, car on ne sais pas
	// d'avance combien de livre ont un titre contenant la chaine recherchée
	while ($data = $stm->fetch(PDO::FETCH_ASSOC)) {
		$listeLivres[] = new Livre($data);
	}

	//on renvoie au script appelant la liste du/des livre(s)
	// un tableau qui peut contenir 0 ... N objets livres
	return $listeLivres;
}


	public function add($data) {
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		//bloc try/catch pour gérer les exceptions
		//provenant de utilisateur
		try {
			$livre = new Livre($data);
		} catch (LengthException $lengthException) {
			// LengthException : Exception émise si une taille est invalide.
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}
		$req = $this->db->prepare("INSERT INTO livre (titre,sousTitre,resume,image,etat,edition,mot_cle,langue) VALUE (:titre,:sousTitre,:resume,:image,:etat,:edition,:mot_cle,:langue)");

		$req->bindValue('titre', $livre->getTitre(), PDO::PARAM_STR);
		$req->bindValue('sousTitre', $livre->getSousTitre(), PDO::PARAM_STR);
		$req->bindValue('resume', $livre->getResume(), PDO::PARAM_STR);
		$req->bindValue('image', $livre->getImage(), PDO::PARAM_STR);
		$req->bindValue('etat', $livre->getEtat(), PDO::PARAM_INT);
		$req->bindValue('edition', $livre->getEdition(), PDO::PARAM_INT);
		$req->bindValue('mot_cle', $livre->getMot_Cle(), PDO::PARAM_STR);
		$req->bindValue('langue', $livre->getLangue(), PDO::PARAM_INT);

		//execution de la requete sur le serveur SQL

		$executed = $req->execute();
		if ($executed) {
			$id = $this->db->lastInsertId();
			$livre->setId($id);
		} else {
			echo "<br>[debug] Erreur";
		}
	}

	public function getAllLivre() {
		$stmt = $this->db->query("SELECT * FROM livre ORDER BY titre ASC ");
		$livres = array();
		while ($data = $stmt->fetch()) {
		    $livre = new Livre($data);
		    $livres[$livre->getId()] = $livre;
		}
		return $livres;
	}

	public function getLivrePage($numPage=1,$limite=0){
// 		$page=intval($_GET['p']); //récupation du num de page
// 		$limit = 12;
		/*
		 * page 1 livre 1 => 12
		 * page 2 livre 13 => 24
		 * ...
		 * formule: offset = (numPage - 1 ) * limite
		 *  page 1: offset = (1-1)*limite = 0
		 *  page 2: offset = (2-1)*limite = 12
		 */
	    $offset = (($numPage - 1) * $limite);
	    
		$stmt = $this->db->prepare('SELECT * FROM livre ORDER BY titre ASC LIMIT :limite OFFSET :offset');
		$stmt->bindValue('limite',$limite,PDO::PARAM_INT);
		$stmt->bindValue('offset',$offset,PDO::PARAM_INT);
		$stmt->execute();
		
		$livres = array();
		while ($data = $stmt->fetch()) {
		    $livre = new Livre($data);
		    $livres[$livre->getId()] = $livre;
		}
		return $livres;
	}
	
	public function getLivrePageAlpha($numPageAlpha="A"){
	    // 		$page=intval($_GET['p']); //récupation du num de page
	    // 		$limit = 12;
	    /*
	     * page 1 livre 1 => 12
	     * page 2 livre 13 => 24
	     * ...
	     * formule: offset = (numPage - 1 ) * limite
	     *  page 1: offset = (1-1)*limite = 0
	     *  page 2: offset = (2-1)*limite = 12
	     */
// 	    $offset = (($numPage - 1) * $limite);
	    
	    $stmt = $this->db->prepare('SELECT * FROM livre WHERE titre like :like ORDER BY titre DESC');
	    $stmt->bindValue('like',str_replace("_","",$numPageAlpha) ."%");
// 	    $stmt->bindValue('limite',$limite,PDO::PARAM_INT);
// 	    $stmt->bindValue('offset',$offset,PDO::PARAM_INT);
	    $stmt->execute();
	    
	    $livres = array();
	    while ($data = $stmt->fetch()) {
	        $livre = new Livre($data);
	        $livres[$livre->getId()] = $livre;
	    }
	    return $livres;
	}

	public function getNblivre(){
		$stmt = $this->db->query("SELECT count(*) AS nbTotalLivres FROM livre");
		$nbTotalLivres = $stmt->fetch(PDO::FETCH_ASSOC);
		// var_dump(intval($nbLivre['nb']));
		return intval($nbTotalLivres['nbTotalLivres']);

	}

	

	public function getLivre($id) {
		$stm = "SELECT * FROM livre WHERE id=:id";
		//preparation == protection des donn�es � venir
		$stmt = $this->db->prepare($stm);
		//liaison des marqueur :toto aux donnees
		$stmt->bindValue('id',$id,PDO::PARAM_INT);
		//execution de la requete sur le serveur SQL
		$stmt->execute();
		return $stmt;
	}

	public function update($data) {
	    debug($data);
		try {
			$livre = new Livre($data);
		} catch (LengthException $lengthException) {
			//cas longueur == 0
			throw new Exception($lengthException->GetMessage(),$lengthException->GetCode());
		} catch (Exception $exception) {
			//autre cas (mais pour nous invalide)
			throw new Exception($exception->GetMessage(),$exception->GetCode());
		}

		// => voir addlivre pour modele
		$req = $this->db->prepare("UPDATE livre set titre=:titre,soustitre=:soustitre,resume=:resume,image=:image,etat=:etat,edition=:edition,mot_cle=:mot_cle,langue=:langue WHERE id=:id");
		$req->bindValue('id', $livre->getId(), PDO::PARAM_INT);
		$req->bindValue('titre', $livre->getTitre(), PDO::PARAM_STR);
		$req->bindValue('soustitre', $livre->getSousTitre(), PDO::PARAM_STR);
		$req->bindValue('resume', $livre->getResume(), PDO::PARAM_STR);
		$req->bindValue('image', $livre->getImage(), PDO::PARAM_STR);
		$req->bindValue('etat', $livre->getEtat(), PDO::PARAM_INT);
		$req->bindValue('edition', $livre->getEdition(), PDO::PARAM_INT);
		$req->bindValue('mot_cle', $livre->getMot_Cle(), PDO::PARAM_STR);
		$req->bindValue('langue', $livre->getLangue(), PDO::PARAM_INT);
		//execution de la requete sur le serveur SQL
		$req->execute();
		if (! $req->execute()) {
			echo "<br>[debug] Erreur";
		}

	}

	public function delete($id) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		// =>voir  getLivre(id) pour modele
		$req = "DELETE FROM livre WHERE id=:id";
		$stmt = $this->db->prepare($req);
		$stmt->execute();
		if ($stmt->rowCount() == 1) {
			echo '[debug]OK 1 ligne inseree';
		} else {
			echo 'Erreur insertion donnees';
		}

	}

}