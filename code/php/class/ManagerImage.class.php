<?php
/**
 * Classe ManagerImage qui gere les objets Images
 * @author cbarrau
 *
 */
class ManagerImage extends Manager {
    
    public function __construct( $mode = 'prod' ) {
        parent::__construct( $mode );
    }
    
    /**
     * Retourne TOUTES les images d'un repertoire donne,
     * par defaut le repertoire des images s'appelle images
     * @param string $path
     */
    public function getAllImage($path="image/") {
        $oFileList = new DirectoryIterator(realpath($path));
        $extensionList = array('jpg','jpeg','bmp','png');
        $imageList = array();
        foreach ($oFileList AS $oFile) {
            if ($oFile->isDot()) {
                continue;
            }
            if (in_array($oFile->getExtension(),$extensionList)) {
                $imageList[] = new Image($oFile->getFilename(),realpath($path));
            }
        }
        return $imageList;
    }
    
    public function getimageByName($imageName="") {
        
    }
}