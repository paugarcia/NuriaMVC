<?php
/**
 * Este es el modelo de la ventana de Registrarse
 * @author Pau Garcia
 */
class RegistrarseModel extends Model {
    protected $ale = 0;
    public function __construct($arr) {
        parent::__construct($arr);
        //parametres de configuració
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URI
        $this->dataout = array();
        if(Session::get("usr") != "")
        {
            $this->addDataout(array('Login' => '<a href="{APP_W}/perfil">Perfil</a>', 'Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>'));
        }
        else {
            $this->addDataout(array('Login' => 'Login','Registrarse'=>'Registrarse','REGISTRARSE'=>'Formilari per a registrarse a DawAgency'));
        }
        
    }
    /**
     * Funcio per a realitzar el login amb usuaris de la base de dades
     */
    public function login()  
    {   
        $email = mysql_real_escape_string($_POST['email']);
        $contra = mysql_real_escape_string($_POST['contra']);
        $stmt = $this->db->query('SELECT id, nom FROM usuaris WHERE email = "'.$email.'" AND password = "'.$contra.'";')->fetch();
        $this->dataout = Array();
        if($stmt["id"] > 0)
        {   
            $this->addDataout(array('Login' => '<a href="{APP_W}/perfil">Perfil</a>', 'Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>'));
            Session::set("usr",$stmt['id']);
        }
        else
        {
            $this->addDataout(array('Login' => 'Accedir'));
        }
    }
    /**
     * Funcio per a registrar un nou usuari a la base de dades de la agencia
     */
    public function regis()
    {
        //Obtenim els valors del formulari amb el métode POST
        $email = mysql_real_escape_string($_POST['email']);
        $nombre = mysql_real_escape_string($_POST['nombre']);
        $apellidos = mysql_real_escape_string($_POST['apellidos']);
        $contra = mysql_real_escape_string($_POST['contra']);
        $this->dataout = Array();
        //Criderm al procediment per a crear un nou usuari
        $this->db->query('CALL SP_nou_user("'.$nombre.'","'.$apellidos.'","'.$email.'","'.$contra.'");');
        $this->addDataout(array('REGISTRARSE' => 'USUARI REGISTRAT'));
        $this->login();
    }
}
?>
