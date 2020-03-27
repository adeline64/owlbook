<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 23/02/2019
 * Time: 17:46
 */

class localisation {

	private $id;
	protected $ville;
	protected $codepostal;
	protected $pays;
	protected $librairie;

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
	public function getVille() {
		return $this->ville;
	}

	/**
	 * @return mixed
	 */
	public function getCodePostal() {
		return $this->codepostal;
	}

	/**
	 * @return mixed
	 */
	public function getPays() {
		return $this->pays;
	}

	/**
	 * @return mixed
	 */
	public function getLibrairie() {
		return $this->librairie;
	}

	/**
	 * @param mixed $id_localisation
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
	 * @param mixed $ville
	 */
	public function setVille( $ville ) {
		$this->ville = $ville;
	}

	/**
	 * @param mixed $codePostal
	 */
	public function setCodePostal( $codepostal ) {
		$this->codepostal = $codepostal;
	}

	/**
	 * @param mixed $Pays
	 */
	public function setPays( $pays ) {
		$this->pays = $pays;
	}

	/**
	 * @param mixed $id_libraire
	 */
	public function setLibraire( $librairie ) {
		$this->librairie = $librairie;
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