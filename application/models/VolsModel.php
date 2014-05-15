<?php
/**
 * Este es el modelo de la ventana de Vols
 * @author Pau Garcia
 */
class VolsModel extends Model{
     public function __construct($arr) {
        parent::__construct($arr);
        //parametres de configuració
        $vuelos = "";
        $this->datain=$this->config;
       $results = $this->db->query('SELECT id, dest, Aeroport_Origen, Aeroport_Desti, Companya FROM vols;');
        $this->dataout = Array();
        
        foreach ($results as $result){
            $ident = $result['id'];
            $preu = $this->db->query('SELECT preu FROM serveis where id = '.$ident.';')->fetch();
            $unitats = $this->db->query('SELECT nplaces FROM serveis where id = '.$ident.';')->fetch();
            //Si aquest Vol te disponibles places actualment el mostrem
            if($unitats[0] > 0){
            $dest = $result['dest'];
            $Origen = $result['Aeroport_Origen'];
            $Desti = $result['Aeroport_Desti'];
            $Companya = $result['Companya'];        
            if(Session::get("usr") != "")
            {
                $vuelos = $vuelos."<div class='producto'><h1>".$dest."</h1><h3>".$Origen."--".$Desti."    <a href='http://".$Companya.".com'>".$Companya."</a></h3><h4>Preu Vol: ".$preu[0]."€</h4><form action='{APP_W}/vols/reserv' method='POST'><input type='text' name='id_ser' class='ocult' style='display:none' value='".$ident."'></input>Unitats: <input type'text' name='num'/><input type='submit' value='Comprar'/></form></div>";
            }
            else 
            {
               $vuelos = $vuelos."<div class='producto'><h1>".$dest."</h1><h3>".$Origen."--".$Desti."    <a href='http://".$Companya.".com'>".$Companya."</a></h3><h4>Preu Vol: ".$preu[0]."</h4></div>";
               
            }
                    
        }}
        //afegir en DataOut els paràmetres URI
        $this->setDataout($arr);
        if(Session::get("usr") != "")
        {
            $this->addDataout(array('Login' => '<a href="{APP_W}/perfil">Perfil</a>', 'Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>', 'vols'=>$vuelos));
        }
        else {
            $this->addDataout(array('Login' => 'Login','Registrarse'=>'Registrarse','vols'=>$vuelos));
        }
    }
    /**
     * Funcio per a realitzar una reserva a vols.
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


