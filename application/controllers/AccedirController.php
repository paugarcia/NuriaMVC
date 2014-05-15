<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Este es el Controlador de la ventana de Acceder
 *
 * @author Pau Garcia
 */
class AccedirController extends ControllerBase{
    //put your code here
    /**
     * rep con a paràmetre un array associatiu que 
     * permet passar els paràmetres de la URI
     * @param array $arr
     */
    
    public function __construct($arr) {
        parent::__construct($arr);
       //carregar la configuració
        $this->conf=$this->config;
        $this->model= new AccedirModel($arr);
        $this->view=new View();       
    }
     public function index(){    
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
        $this->view->setTemplate(APP.'/public/tpl/accedir.php');
        $this->view->render();        
    }
    /**
     * Funcio per fer el login al "Backend" de la agencia
     */
    public function login()
     {
        $this->model->login();
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
        $this->view->setTemplate(APP.'/public/tpl/index.php');
        $this->view->render();        
    }
}

?>
