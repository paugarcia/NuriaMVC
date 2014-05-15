<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Este es el Controlador de la ventana de Balnearis
 *
 * @author Pau Garcia
 */
class BalnearisController extends ControllerBase {
    //put your code here
    protected $model;
    protected $view;
    private $conf;
    /**
     * rep con a paràmetre un array associatiu que 
     * permet passar els paràmetres de la URI
     * @param array $arr
     */
    public function __construct($arr) {
        parent::__construct($arr);
       //carregar la configuració
        $this->conf=$this->config;
        $this->model= new BalnearisModel($arr);
        $this->view=new View();       
    }
     public function index(){
               
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
        $this->view->setTemplate(APP.'/public/tpl/Balnearis.php');
        $this->view->render();        
    }
    /**
     * Funcio per a realitzar una reserva de tipus Balneari
     */
     public function reserv()
     {
        $this->model->reserv();
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
        $this->view->setTemplate(APP.'/public/tpl/reserva.php');
        $this->view->render();        
    }
}

?>
