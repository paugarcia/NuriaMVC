<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Este es el modelo de la ventana de Acceder
 *
 * @author Pau Garcia
 */
class AccedirModel extends Model{
    //put your code here
     public function __construct($arr) {
        parent::__construct($arr);
        //parametres de configuració
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URI
        $this->setDataout($arr);
        //$this->addDataout($arr);
        if(Session::get("usr") != "")
        {
            $this->addDataout(array('Login' => '<a href="{APP_W}/perfil">Perfil</a>', 'Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>'));
        }
        else {
            $this->addDataout(array('Login' => 'Login','Registrarse'=>'Registrarse'));
        }
    }
    /**
     * Funcio per a realitzar el login amb usuaris de la base de dades
     */
    public function login()  
    {
        
        //Extaim les dades de el formulari amb el métode POST
        $email = mysql_real_escape_string($_POST['nom']);
        $contra = mysql_real_escape_string($_POST['password']);
        //Realitzaem la consulta a la bd 
        $stmt = $this->db->query('SELECT id, nom FROM usuaris WHERE email = "'.$email.'" AND password = "'.$contra.'";')->fetch();
        $this->dataout = Array();
        if($stmt["id"] > 0)
        {   
            $this->addDataout(array('Login' => 'Benvingut '.$stmt['nom']));
            Session::set("usr",$stmt['id']);
            header("Location: /NuriaMVC");
        }
        else
        {
            $this->addDataout(array('Login' => 'Accedir'));
        }
    
    }
}
?>
