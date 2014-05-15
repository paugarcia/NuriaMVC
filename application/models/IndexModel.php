<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Este es el modelo de la ventana principal
 *
 * @author Pau Garcia
 */
class IndexModel extends Model{
    
    public function __construct($arr) {
        parent::__construct($arr);
        //parametres de configuració
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URI
        $this->dataout = Array();
        if(Session::get("usr") != "")
        {
            $this->addDataout(array('Login' => '<a href="{APP_W}/perfil">Perfil</a>', 'Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>'));
        }
        else {
            $this->addDataout(array('Login' => 'Login','Registrarse'=>'Registrarse'));
        }
    }
    /**
     * Exemple de funció
     */
    public function a(){
        //cap al controlador
        $this->addDataout(array('a'=>1));
                if($this->datain)
                {
                    $result=  array_merge($this->dataout,  $this->datain);
                    $this->dataout=  $result;
                }
    }
    /**
     * suma paràmetres
     */
    public function users(){
        $sql="SELEC * FROM USERS";
        $this->prepara($sql);
        $this->exec($array);
    }
    
}
