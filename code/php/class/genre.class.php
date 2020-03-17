<?php


class genre {

	protected $id;
	protected $nom;

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
	 * @param mixed $id
	 */
	public function setId( $id ): void {
		$this->id = $id;
	}

	/**
	 * @return mixed
	 */
	public function getNom() {
		return $this->nom;
	}

	/**
	 * @param mixed $nom
	 */
	public function setNom( $nom ): void {
		$this->nom = $nom;
	}

	protected function hydrate($array){
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		foreach ($array as $key => $value) {
			$methodName = 'set'.ucfirst($key);
			if(method_exists($this, $methodName)){
				$this->$methodName($value);
			} else {
				echo "<br> La methode '<b>".$methodName."()</b>' n'existe pas.";
			}
		}
	}

}