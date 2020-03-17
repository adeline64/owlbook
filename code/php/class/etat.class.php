<?php


class etat {

	protected $id;
	protected $nom;
	protected $description;

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
	public function getNom() {
		return $this->nom;
	}

	/**
	 * @return mixed
	 */
	public function getDescription() {
		return $this->description;
	}



	/**
	 * @param mixed $id
	 */
	public function setId( $id ){
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->id = $id;
	}

	/**
	 * @param mixed $nom
	 */
	public function setNom( $nom ) {
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->nom = $nom;
	}

	/**
	 * @param mixed $description
	 */
	public function setDescription( $description ) {
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->description = $description;
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