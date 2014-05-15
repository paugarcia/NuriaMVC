<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Este es el Controlador de la ventana de Perfil
 *
 * @author Pau Garcia
 */
class PerfilController extends ControllerBase{
    //put your code here
    protected $model;
    protected $view;
    private $conf;
    
     public function __construct($arr) {
        parent::__construct($arr);
       //carregar la configuració
        $this->conf=$this->config;
        $this->model= new PerfilModel($arr);
        $this->view=new View();       
    }
     public function index(){
               
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
        $this->view->setTemplate(APP.'/public/tpl/perfil.php');
        $this->view->render();        
    }
    //put your code here
}

?>
