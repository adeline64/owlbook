<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 23/02/2019
 * Time: 17:42
 */

class serie {

	private $id;
	protected $num;
	protected $nom;

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
	public function getNum() {
		return $this->num;
	}

	/**
	 * @return mixed
	 */
	public function getNom() {
		return $this->nom;
	}

	/**
	 * @param mixed $id_serie
	 */
	public function setId( $id ) {
		echo '<br>[debug]Dans "' . __FUNCTION__ . '" [/debug]';
		$id = (int) $id;
		if ( $id > 0 ) {
			$this->id = $id;
		}
	}

	/**
	 * @param mixed $num_serie
	 */
	public function setNum( $num ) {
		$this->num = $num;
	}

	/**
	 * @param mixed $nom_serie
	 */
	public function setNom( $nom ) {
		$this->nom = $nom;
	}

	// HYDRATATION

	protected function hydrate($array){
		echo '<br>[debug]Dans "'.__FUNCTION__.'" [/debug]';
		foreach ($array as $key => $value) {
			$methodName = 'set'.ucfirst($key);
			if(method_exists($this, $methodName)){
				$this->$methodName($value);
			}
		}
	}

}