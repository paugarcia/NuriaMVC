<?php
/**
 * Este es el modelo de la ventana de politica
 *
 * @author Pau Garcia
 */
class PoliticaModel extends Model {
    
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
}
?>
