<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 23/02/2019
 * Time: 08:53
 */

class langue {

	private $id;
	protected $locale;
	protected $originale;

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
	public function getLocale() {
		return $this->locale;
	}

	/**
	 * @return mixed
	 */
	public function getOriginale() {
		return $this->originale;
	}



	/**
	 * @param mixed $id_langue
	 */
	public function setId( $id ) {
	    // debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		}

	}

	/**
	 * @param mixed $locale
	 */
	public function setLocale( $locale ) {
	    // debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->locale = $locale;
	}

	/**
	 * @param mixed $originale
	 */
	public function setOriginale( $originale ) {
	    // debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->originale = $originale;
	}



	// HYDRATATION

	protected function hydrate($array){
	    // debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		foreach ($array as $key => $value) {
			$methodName = 'set'.ucfirst($key);
			if(method_exists($this, $methodName)){
				$this->$methodName($value);
			}
		}
	}
}