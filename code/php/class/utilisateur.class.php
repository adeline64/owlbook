<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 23/02/2019
 * Time: 09:44
 */

class utilisateur {


	private $id;
	private $nom;
	private $prenom;
	private $adresse;
	private $codepostal;
	private $ville;
	private $email;
	private $password;
	private $role;

	public function __construct( array $array =[] )
	{
		$this->hydrate($array);
	}

// LES GETTERS

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}


	public function getNom() {
		return $this->nom;
	}


	public function getPrenom() {
		return $this->prenom;
	}


	public function getAdresse() {
		return $this->adresse;
	}


	public function getCodePostal() {
		return $this->codepostal;
	}

	public function getVille() {
		return $this->ville;
	}


	public function getEmail() {
		return $this->email;
	}


	public function getPassword() {
		return $this->password;
	}

	/**
	 * @return mixed
	 */
	public function getRole() {
		return $this->role;
	}




	// LES SETTERS


	/**
	 * @param mixed $id_utilisateur
	 */
	public function setId( $id ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		$id = (int) $id;
		if ( $id > 0 ) {

			$this->id = $id;
		}
	}

	public function setNom( $nom ){
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (strlen(trim($nom)) > 0)
			//strlen = Calcule la taille d'une chaîne
			// trim = Supprime les espaces (ou d'autres caractères) en début et fin de chaîne
		{
			if (strpos($nom,"#") !== false)
				// strpos = Cherche la position de la première occurrence dans une chaîne
			{
				throw new Exception("Le nom ne peut pas avoir de caracteres speciaux");
			}
			if (preg_match("/[0-9]/", "$nom"))
				// preg_match = sert ici pour les chiffres
			{
				throw new Exception("Le nom ne peut pas avoir de chiffre");
			}
			else
			{
				//echo "la chaîne $nom est correcte";
				$this->nom = $nom;
			}
		}
	}

	public function setPrenom( $prenom ){
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (strlen(trim($prenom)) > 0)
		{
			if (strpos($prenom,"#") !== false)
			{
				throw new Exception("Le prenom ne peut pas avoir de caracteres speciaux");
			}

			if (preg_match("/[0-9]/", "$prenom"))
			{
				throw new Exception("Le prenom ne peut pas avoir de chiffre");
			}

			else
			{
				//echo "la chaîne $prenom est correcte";
				$this->prenom = $prenom;
			}
		}
	}

	public function setAdresse( $adresse ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (strlen(trim($adresse)) > 0)
		{
			$this->adresse = $adresse;
		}else{
			echo "l'adresse est obligatoire";
		}
	}

	public function setCodePostal( $codepostal ){
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (preg_match('/[0-9]{5}/',$codepostal))
		{
			$this->codepostal = $codepostal;
		} else {
			echo "<br/>Aucun r&eacute;sultat n'a &eacute;t&eacute; trouv&eacute;.";
		}
	}

	public function setVille( $ville ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if (strlen(trim($ville)) > 0)
		{
			$this->ville = $ville;

			if (preg_match("/[0-9]/", "$ville"))
			{
				throw new Exception("La ville ne peut pas avoir de chiffre");
			}

		}else{
			echo "la ville est obligatoire";
		}
	}

	public function setEmail( $email ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		//1) si la chaine n'est pas vide
		if (strlen(trim($email)) == 0) {
			//erreur
			throw new LengthException("Le mail est vide",100); //code 100 == mail vide
		} else {
			//pas d'erreur on continue
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
				//mail validé
				$this->email = $email;
				$this->email = $email;
			} else {
				//erreur à gérer
				throw new Exception("Le mail est invalide",101); //code 101 == mail invalide
			}
		}
	}

	public function setPassword( $password ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		if ( strlen( trim( $password ) ) == 0 )
		{
			//Si le mot de passe est vide
			throw new Exception( "le mot de passe est obligatoire" );
		}

		if ( strlen( $password ) > strlen( trim( $password ) ) )
		{
			//si le mot de passe commence/fini (ou les 2) par <espace>
			throw new Exception( "Le mot de passe ne peut pas commencer et se finir par un espace" );
		}

		if ( strlen( trim( $password ) ) < 6 )
		{
			//Si le mot de passe est inf 6 car
			throw new Exception( "Le mot de passe doit avoir plus de 6 caractères" );
		}
		/*
		 TOUT VA BIEN
        */
		$this->password = $password;
	}

	/**
	 * @param mixed $role
	 */
	public function setRole( $role ) {
		$this->role = $role;
	}



	// HYDRATATION

	public function hydrate($array){
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]',true);
		foreach ($array as $key => $value) {
			$methodName = 'set'.ucfirst($key);
			if(method_exists($this, $methodName)){
				$this->$methodName($value);
			}
		}
	}

}