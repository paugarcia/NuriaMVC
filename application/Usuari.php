<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Usuari
 *
 * @author alumnes
 */
class Usuari {
    //put your code here
    public $nom;
    public $cognom;
    public $email;
    public $password;
    public $idrol;
    
    function __construct($nom, $cognom, $email, $password, $idrol) {
        $this->nom = $nom;
        $this->cognom = $cognom;
        $this->email = $email;
        $this->password = $password;
        $this->idrol = $idrol;
    }
    function getNom(){
        return $this->nom;
    }
    function setNom($nom){
         $this->nom = $nom;
    }
    function getCognom(){
        return $this->cognom;
    }
    function setCognom($cognom){
         $this->cognom = $cognom;
    }
}

?>
