<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 20/10/2018
 * Time: 17:47
 */

class Livre {

	protected $id;
	protected $titre;
	protected $sousTitre;
	protected $resume;
	protected $image;
	protected $etat;
	protected $edition;
	protected $mot_cle;
	protected $langue;
	public function __construct( array $array =[] )
	{
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->hydrate($array);
	}

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getTitre() {
		return $this->titre;
	}

	/**
	 * @return mixed
	 */
	public function getSousTitre() {
		return $this->sousTitre;
	}

	/**
	 * @return mixed
	 */
	public function getResume() {
		return $this->resume;
	}

	/**
	 * @return mixed
	 */
	public function getImage() {
		return $this->image;
	}

	/**
	 * @return mixed
	 */
	public function getEtat() {
		return $this->etat;
	}

	/**
	 * @return mixed
	 */
	public function getEdition() {
		return $this->edition;
	}

	/**
	 * @return mixed
	 */
	public function getMot_Cle() {
		return $this->mot_cle;
	}


	public function getLangue() {
		return $this->langue;
	}

	/**
	 * @param mixed $id_livre
	 */
	public function setId( $id ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		}
	}

	/**
	 * @param mixed $titre_livre
	 */
	public function setTitre( $titre ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->titre = $titre;
	}

	/**
	 * @param mixed $soustitre
	 */
	public function setSousTitre( $sousTitre ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->sousTitre = $sousTitre;
	}

	/**
	 * @param mixed $resume
	 */
	public function setResume( $resume ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->resume = $resume;
	}

	/**
	 * @param mixed $image_livre
	 */
	public function setImage( $image ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->image = $image;
	}

	/**
	 * @param mixed $etat_livre
	 */
	public function setEtat( $etat ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->etat = $etat;
	}

	/**
	 * @param mixed $nom_editeur
	 */
	public function setEdition( $edition ){
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->edition = $edition;
	}

	public function setLangue( $langue ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->langue = $langue;
	}

	/**
	 * @param mixed $mot_cle
	 */
	public function setMot_Cle( $mot_cle ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->mot_cle = $mot_cle;
	}



// HYDRATATION

	public function hydrate($array){
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		foreach ($array as $key => $value) {
			$methodName = 'set'.ucfirst($key);
			if(method_exists($this, $methodName)){
				$this->$methodName($value);
			}
		}
	}


}