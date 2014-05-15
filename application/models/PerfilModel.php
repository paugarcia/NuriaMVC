<?php
/**
 * Este es el modelo de la ventana de Perfil
 *
 * @author Pau Garcia
 */
class PerfilModel extends Model{
    public function __construct($arr) {
        parent::__construct($arr);
        //parametres de configuració
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URI
        $this->dataout = Array();
        $usuari = Session::get("usr");
        if(Session::get("usr") != "")
        {
            $stmt = $this->db->query('SELECT * FROM usuaris WHERE id = "'.$usuari.'";')->fetch();
            $formu = "<a href='{APP_W}/carrito'><div class='botoperf'>CARRITO</div></a> <a href='{APP_W}/index'><div class='botoperf'>HOME</div></a> <a href='{APP_W}/desconectar'><div class='botoperf'>TANCAR SESSIO</div></a>";
            $this->addDataout(array('Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>', 'nom'=>$stmt['nom'], 'dades'=>$formu));
        }
    else{
        $this->addDataout(array('Login' => 'Login','Registrarse'=>'Registrarse','dades'=>'<div id="zonapriv">Per a accedir a aquesta zona tens que <a href="{APP_W}/registrarse">registrarte</a></div>','nom'=>'Visitant'));   
    }
        }   
}
?>
