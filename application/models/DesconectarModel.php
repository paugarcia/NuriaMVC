<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Este es el modelo de la ventana de Desconectar
 *
 * @author Pau Garcia
 */
class DesconectarModel extends Model {
    
    public function __construct($arr) {
        parent::__construct($arr);
        //parametres de configuració
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URI
        $this->addDataout($arr);
        Session::destroy();
        header("Location: /NuriaMVC");
    }
    
}

?>
