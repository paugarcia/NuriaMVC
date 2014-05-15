<?php
/**
 * Este es el modelo de la ventana de Balnearios
 * @author Pau Garcia
 */
class BalnearisModel extends Model{
    public function __construct($arr) {
        parent::__construct($arr);
        $balnearios = "";
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URL
        $results = $this->db->query('SELECT * FROM balnearis;');
        $this->dataout = Array();
        foreach ($results as $result){
        $ident = $result['id'];
        //Si aquest Balneari te disponibles places actualment el mostrem
        $unitats = $this->db->query('SELECT nplaces FROM serveis where id = '.$ident.';')->fetch();
        if($unitats[0] > 0)
        {
        $preu = $this->db->query('SELECT preu FROM serveis where id = '.$ident.';')->fetch();
        $Nom = $result['Nom'];
        $Direccio = $result['Direccio'];
        $Web = $result['Web']; 
        $Latitud = $result['lati'];
        $Longitud = $result['long'];
        $Frase = "<div class='producto'><div class='producto1'><h1>".$Nom."</h1><h3>".$Direccio." <a href='http://".$Web."'>".$Web."</a></h3><h4>Preu Entrada: ".$preu[0]."</h4><input type='button' value='Mapa' onClick='Mapa(".$Longitud.",".$Latitud.",".$ident.");'/>";
            if(Session::get("usr") != "")
            {
                $balnearios = $balnearios.$Frase."<form action='{APP_W}/parcs/reserv' method='POST'><input type='text' name='id_ser' class='ocult' style='display:none' value='".$ident."'></input>Unitats: <input type'text' name='num'/><input type='submit' value='Comprar'/></form><br/></div><div class='producto2'><div class='mapa' id='".$ident."'></div></div></div>";
            }
            else 
            {
                $balnearios = $balnearios.$Frase."</div><div class='producto2'><div class='mapa' id='".$ident."'></div></div></div>";
            }
        }
        }
        if(Session::get("usr") != "")
        {
            $this->addDataout(array('Login' => '<a href="{APP_W}/perfil">Perfil</a>', 'Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>', 'balnearios' => $balnearios));
        }
        else {
            $this->addDataout(array('Login' => 'Login','Registrarse'=>'Registrarse', 'balnearios' => $balnearios));
        }
    }
    /**
     * Funcio per a realitzar una reserva de Balenaris.
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
