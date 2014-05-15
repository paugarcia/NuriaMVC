<?php
/**
 * Este es el Controlador de la ventana de Registrarse
 *
 * @author Pau Garcia
 */
class RegistrarseController extends ControllerBase  {
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
        $this->model= new RegistrarseModel($arr);
        $this->view=new View();       
    }
     public function index(){
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
        $this->view->setTemplate(APP.'/public/tpl/registrarse.php');
        $this->view->render();       
    }
    /**
     * Funcio per a registrar un nou usuari a la base de dades de la agencia
     */
    public function regis()
     {
        $this->model->regis();
        $this->view->setProp($this->model->getDataout());
        //afegir configuració per ruta publica, enllaços, css ,js...
        $this->view->addProp(array('APP_W'=>$this->conf->APP_W));
        $this->view->setTemplate(APP.'/public/tpl/index.php');
        $this->view->render();        
    }
}

?>
