<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Aquesta classe es la encarregada de mostrar el carrito de productes reservats per el usuari
 *  
 * @author Pau Garcia
 */
class CarritoModel extends Model{
    public $tabla = "";
    /**
     * $total es un contador 
     */
    public $total = 0;
     public function __construct($arr) {
        parent::__construct($arr);
        //parametres de configuració
        $this->datain=$this->config;
        //afegir en DataOut els paràmetres URI
        $this->dataout = Array();        
        if(Session::get("usr") != "")
        {
            $usuari = Session::get("usr");
            $id_res = $this->db->query('SELECT id FROM reserves Where idusuari = '.$usuari.' and status = "ESPERA";')->fetch();
            $lineas = $this->db->query('SELECT * FROM serveis_reservats where idreserva = '.$id_res[0].';')->fetchAll(PDO::FETCH_ASSOC);                    
             $this->tabla = "<table id='carrito'><tr><td>Producte</td><td>Data</td><td>Unitats</td><td>Preu Unitari</td><td>Preu Total</td></tr>";
       
            foreach ($lineas as $result)
            {
                $Data = $result['Data'];
                
                $ser = $this->db->query('SELECT * FROM serveis_reservats where idreserva = '.$id_res[0].';')->fetch();
                $UNITS = $result['num_reserves'];
                $preu = $this->db->query('SELECT preu FROM serveis where id = '.$result['idservei'].';')->fetch();
                /**
                 *  $tip indica el tipus de produce 
                 *  1 - Vol
                 *  2 - Parc de Atraccions
                 *  3 - Balneari
                 */
                $tip = $this->db->query('SELECT Tipus FROM serveis where id = '.$result['idservei'].';')->fetch();
                //VOL
                if($tip[0] == "1"){$nom = $this->db->query('SELECT dest FROM vols where id = '.$result['idservei'].';')->fetch();}
                //Parc de Atraccions
                elseif($tip[0] == "2"){$nom = $this->db->query('SELECT Nom FROM parcatraccions where id = '.$result['idservei'].';')->fetch();}
                //Balneari
                elseif($tip[0] == "3"){$nom = $this->db->query('SELECT Nom FROM balnearis where id = '.$result['idservei'].';')->fetch();}
                $preu_tot = 0 + ($UNITS*$preu[0]);
                $this->total = $this->total + $preu_tot;
                $fila = "<tr><td>".$nom[0]."</td><td>".$Data."</td><td>".$UNITS."</td><td>".$preu[0]."</td><td>".$preu_tot."</td></tr>";
                //$fila = "<tr><td>".$result['idservei']."</td><td>".$Data."</td><td>".$UNITS."</td><td>".$preu[0]."</td><td>".$preu_tot."</td></tr>";
                
                $this->tabla = $this->tabla . $fila;
            }
            $this->db->query('UPDATE reserves SET preu = '.$this->total.' WHERE id = '.$usuari.' AND status = "ESPERA";');
            $this->tabla = $this->tabla ."</table><h1>Total de la reserva: ".$this->total."€</h1>";
            $this->addDataout(array('Login' => '<a href="{APP_W}/perfil">Perfil</a>', 'Registrarse'=>'<a href="{APP_W}/desconectar">Desconectar</a>','carrito'=>$this->tabla));
        }
        else {
            
            $this->addDataout(array('Login' => 'Login','Registrarse'=>'Registrarse','carrito'=>'<div id="zonapriv">Per a accedir a aquesta zona tens que <a href="{APP_W}/registrarse">registrarte</a></div>'));
        }
    }
}
?>
