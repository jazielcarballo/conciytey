<?php

/**
 * Controller por defecto si no se usa el routes
 * 
 */
class IndexController extends AppController {

    public function index() {
        
        
        View::template('aplicacion/frontend_bootstrap');
        $ferias = Load::model('ap_ferias');
        $this->ferias=$ferias->find('order: fechaInicio desc');
    
    }

}
