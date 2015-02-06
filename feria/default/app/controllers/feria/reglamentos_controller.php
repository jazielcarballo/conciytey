<?php

Load::model('ap_reglamentos');

class ReglamentosController extends AdminController {

    protected function after_filter() {
        if (Input::isAjax()) {
            View::select(NULL, NULL);
        }
    }
    
     public function index($page = 1) {
        try {
            $reglamentos = new ApReglamentos();
            $this->listReglamentos= $reglamentos->getReglamentos($page);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
    
    public function crear() {
        try {
            if (Input::hasPost('apReglamento')) {
                //esto es para tener atributos que no son campos de la tabla
                $ar = new ApReglamentos(Input::post('apReglamento'));
                //seleccionados en el formulario.
                if ($ar->guardar(Input::post('apReglamento'))) {
                    Flash::valid('El reglamento Ha Sido Agregado Exitosamente...!!!');
                    if (!Input::isAjax()) {
                        return Router::redirect();
                    }
                } else {
                    Flash::warning('No se Pudieron Guardar los Datos...!!!');
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
     public function eliminar($id = NULL) {
        try {
            $ar = new ApReglamentos();
            if (is_int($id)) {


                if (!$ar->find_first($id)) { //si no existe
                    Flash::warning("No existe ningun reglamento con id '{$id}'");
                } else if ($ar->delete()) {
                    Flash::valid("El reglamento <b>{$ar->pkReglamento}</b> fué Eliminado...!!!");
                } else {
                    Flash::warning("No se Pudo Eliminar el reglamento <b>{$ar->pkReglamento}</b>...!!!");
                }
            } elseif (is_string($id)) {
                if ($ar->delete_all("pkReglamento IN ($id)")) {
                    Flash::valid("El reglamento <b>{$ar->pkReglamento}</b> fue Eliminado...!!!");
                } else {
                    Flash::warning("No se Pudieron Eliminar los reglamentos...!!!");
                }
            } elseif (Input::hasPost('apReglamento')) {
                $this->ids = Input::post('apReglamento');
                return;
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect();
    }
    
    
        public function editar($id) {
        try {

            $id = (int) $id;

            $ar = new ApReglamentos();

            $this->apReglamento = $ar->find_first($id);

            if ($this->apReglamento) {

                if (Input::hasPost('apReglamento')) {


                    if ($ar->guardar(Input::post('apReglamento'))) {
                        Flash::valid('El Reglamento  Ha Sido Actualizada Exitosamente...!!!');



                        if (!Input::isAjax()) {
                            return Router::redirect();
                        }
                    } else {
                        Flash::warning('No se Pudieron Guardar los Datos...!!!');
                    }
                }
            } else {
                Flash::warning("No existe ningun Reglamento con id '{$id}'");
                if (!Input::isAjax()) {
                    return Router::redirect();
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }



}

?>
