<?php
/**
 * Classe Image qui modelise une image presente sur le serveur
 * @author cbarrau
 *
 */
class Image {
    
    protected $_nom;
    protected $_chemin;
    
    public function __construct($nom="",$chemin="") {
        $this->setNom($nom);
        $this->setChemin($chemin);
    }
    
    public function setNom($nouveauNom) {
        $this->_nom = $nouveauNom;
    }
    
    public function setChemin($nouveauChemin) {
        $this->_chemin = $nouveauChemin;
    }
    
    public function getNom() {
        return $this->_nom;
    }
    
    public function getChemin() {
        return $this->_chemin;
    }
    
    public function getCheminComplet() {
        return $this->getChemin()."/".$this->getNom();
    }
}