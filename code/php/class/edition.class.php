<?php
/**
 * Created by PhpStorm.
 * User: Adeline
 * Date: 23/02/2019
 * Time: 09:03
 */

class edition {

	protected $id;
	protected $nom;
	protected $date_publication;
	protected $isbn;
	protected $nb_page;
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
	public function getNom() {
		return $this->nom;
	}



	/**
	 * @return mixed
	 */
	public function getDate_publication() {
		return $this->date_publication;
	}

	/**
	 * @return mixed
	 */
	public function getIsbn() {
		return $this->isbn;
	}

	/**
	 * @return mixed
	 */
	public function getNb_Page() {
		return $this->nb_page;
	}




	/**
	 * @param mixed $id_edition
	 */
	public function setId($id) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$id = (int) $id;
		if ($id > 0)
		{
			$this->id = $id;
		}
	}

	/**
	 * @param mixed $nom
	 */
	public function setNom( $nom ) {
		debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->nom = $nom;
	}



	/**
	 * @param mixed $date_publication
	 */
	public function setDate_publication( $date_publication ){
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->date_publication = $date_publication;
	}

	/**
	 * @param mixed $isbn
	 */
	public function setIsbn( $isbn ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->isbn = $isbn;
	}

	/**
	 * @param mixed $nb_page
	 */
	public function setNb_Page( $nb_page ) {
	    debug('<br>[debug]Dans "'.__CLASS__."::".__FUNCTION__.'" [/debug]');
		$this->nb_page = $nb_page;
	}






	// HYDRATATION

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