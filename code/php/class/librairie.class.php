<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 23/02/2019
 * Time: 09:09
 */

class librairie {

	private $id;
	protected $nom;
	protected $ville;
	protected $codepostal;
	protected $pays;

	public function __construct( array $array =[] )
	{
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
	public function getNom() {
		return $this->nom;
	}

	/**
	 * @return mixed
	 */
	public function getVille() {
		return $this->ville;
	}

	/**
	 * @return mixed
	 */
	public function getCodepostal() {
		return $this->codepostal;
	}

	/**
	 * @return mixed
	 */
	public function getPays() {
		return $this->pays;
	}



	/**
	 * @param mixed $id_librairie
	 */
	public function setId( $id ) {
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		}


	}

	/**
	 * @param mixed $nom_librairie
	 */
	public function setNom( $nom ) {
		$this->nom = $nom;
	}

	/**
	 * @param mixed $ville
	 */
	public function setVille( $ville )  {
		$this->ville = $ville;
	}

	/**
	 * @param mixed $codepostal
	 */
	public function setCodepostal( $codepostal ) {
		$this->codepostal = $codepostal;
	}

	/**
	 * @param mixed $pays
	 */
	public function setPays( $pays ) {
		$this->pays = $pays;
	}






	protected function hydrate($array){
		// echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		foreach ($array as $key => $value) {
			$methodName = 'set'.ucfirst($key);
			if(method_exists($this, $methodName)){
				$this->$methodName($value);
			}
		}
	}



}