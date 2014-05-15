<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Este es el modelo de la ventana de Parques de atracción
 *
 * @author Pau Garcia
 */
class ParcsModel extends Model{
    //put your code here
    public function __construct($arr) {
        parent::__construct($arr);
        $parques = "";
        //parametres de configuració
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URI
        $this->dataout = Array();
        $usuari = Session::get("usr");
        
        $results = $this->db->query('SELECT id, Nom, Direccio, Web FROM parcatraccions;');
        $this->dataout = Array();
        
        foreach ($results as $result){
        $ident = $result['id'];
        $unitats = $this->db->query('SELECT nplaces FROM serveis where id = '.$ident.';')->fetch();
        //Si aquest Parc te disponibles places actualment el mostrem
        if($unitats[0] > 0){
        $preu = $this->db->query('SELECT preu FROM serveis where id = '.$ident.';')->fetch();
        
        $Nom = $result['Nom'];
        $Direccio = $result['Direccio'];
        $Web = $result['Web'];        
        $Frase = "<div class='producto'><h1>".$Nom."</h1><h3>".$Direccio." <a href='http://".$Web."'>".$Web."</a></h3><h4>Preu Entrada: ".$preu[0]."</h4>";
            if(Session::get("usr") != "")
            {
                $parques = $parques.$Frase."<form action='{APP_W}/parcs/reserv' method='POST'><input type='text' name='id_ser' class='ocult' style='display:none' value='".$ident."'></input>Unitats: <input type'text' name='num'/><input type='submit' value='Comprar'/></form></div>";
            }
            else 
            {
                $parques = $parques.$Frase."</div>";
            }
        
        }}
        if(Session::get("usr") != "")
        {
            $this->addDataout(array('Login' => '<a href="{APP_W}/perfil">Perfil</a>', 'Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>', 'parques' => $parques));
        }
        else {
            $this->addDataout(array('Login' => 'Login','Registrarse'=>'Registrarse', 'parques' => $parques));
        }
    }
    /**
     * Funcio per a realitzar una reserva a Parcs.
     * Si existeix una reserva del mateix usuari igual el que fa la funcio es aumentar la quantitat.
     */
     public function reserv(){
        //Recuperem les dades del formulari per poder realitzar la reserva.
        $id = 0 + mysql_real_escape_string($_POST['id_ser']);
        $unidades = 0 + mysql_real_escape_string($_POST['num']);
        if($unidades > 0)
        {
            $preu = $this->db->query('SELECT preu FROM serveis where id = '.$id.';')->fetch();
            $preu_tot = 0 + $preu[0] * $unidades;
            $usuari = Session::get("usr");
            //$stmt = $this->db->query('SELECT * FROM usuaris WHERE id = "'.$usuari.'";')->fetch();
            //Insertamosen reserva
            //select id from reserves where idusuari = 1 and status = "espera";
            $reserv = $this->db->query('select id from reserves where idusuari = '.$usuari.' and status = "espera";')->fetch();
            if($reserv[0] != null)
            {
                //Consulta per veure si existeix un servei amb un id de reserva
                $existeix = $this->db->query('select idservei from serveis_reservats where idreserva = '.$reserv[0].' and idservei = '.$id.';')->fetch();
                if($existeix[0] != null){
                    $existeix = $this->db->query('select num_reserves from serveis_reservats where idreserva = '.$reserv[0].' and idservei = '.$id.';')->fetch();
                    $total = 0 + $existeix[0] + floatval($unidades);
                    //update serveis_reservats set num_reserves = 4 where idreserva = 10 and idservei = 1;
                    $this->db->query('update serveis_reservats set num_reserves = '.$total.' where idreserva = '.$reserv[0].' and idservei = '.$id.';');
                }
                else{
                    //insertamos la linea en la tabla serveis_reservats
                    $this->db->query('INSERT INTO serveis_reservats(idservei,idreserva,Data,num_reserves) values('.$id.','.$reserv[0].',CURDATE(),'.$unidades.');'); 
                }                
            }
            else{
                //Aquest usuari no te cap reserva oberta
                //Tenim que crear una
                $this->db->query('INSERT INTO reserves (data,idusuari, status, preu) values(CURDATE(),'.$usuari.',"ESPERA",'.$preu_tot.');');
                //Obtenemos el id de la reserva
                $id_res = $this->db->query('select id From reserves order by id DESC limit 1;')->fetch(PDO::FETCH_ASSOC);
                 //insertamos la reserva en la tabla serveis_reservats
                $this->db->query('INSERT INTO serveis_reservats(idservei,idreserva,Data,num_reserves) values('.$id.','.$id_res['id'].',CURDATE(),'.$unidades.');');  
            } 
        }

    }
}

?>
