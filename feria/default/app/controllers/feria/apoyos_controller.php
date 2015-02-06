<?php

Load::model('ap_apoyos');
Load::model('ap_ferias');

class ApoyosController extends AdminController {

    protected function after_filter() {
        if (Input::isAjax()) {
            View::select(NULL, NULL);
        }
    }

    public function index($page = 1) {
        try {
            $apoyos = new ApApoyos();
            $this->listApoyos = $apoyos->getApoyos($page);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function crearMonto() {
        
         View::select(NULL, NULL);
         
        try {
            if (Input::hasPost('inputDescripcion') and Input::hasPost('inputApoyo')) {
                //esto es para tener atributos que no son campos de la tabla
                $ap = new ApApoyos();
                //seleccionados en el formulario.

                $ap->descripcion = Input::post('inputDescripcion');
                $ap->monto = Input::post('inputApoyo');

                $ferias = new ApFerias();
                $feria = $ferias->find_first("conditions: activo='1'");

                $ap->ferias_pkFeria = $feria->pkFeria;


                if ($ap->save()) {
                    echo "<option value='".$ap->pkApoyo."'>".$ap->descripcion."</option>";
                    if (!Input::isAjax()) {
                        return Router::redirect();
                    }
                } else {
                    Flash::warning('No se pudo guardar el apoyo...!!!');
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function crear() {
        try {
            if (Input::hasPost('apApoyo')) {
                //esto es para tener atributos que no son campos de la tabla
                $ap = new ApApoyos(Input::post('apApoyo'));
                //seleccionados en el formulario.
                if ($ap->guardar(Input::post('apApoyo'))) {
                    Flash::valid('El Apoyo Ha Sido Agregado Exitosamente...!!!');
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
            $ap = new ApApoyos();
            if (is_int($id)) {


                if (!$ap->find_first($id)) { //si no existe
                    Flash::warning("No existe ningun apoyo con id '{$id}'");
                } else if ($ap->delete()) {
                    Flash::valid("El Apoyo <b>{$ap->descripcion}</b> fué Eliminado...!!!");
                } else {
                    Flash::warning("No se Pudo Eliminar el Apoyo <b>{$ap->descripcion}</b>...!!!");
                }
            } elseif (is_string($id)) {
                if ($ap->delete_all("pkApoyo IN ($id)")) {
                    Flash::valid("El apoyo <b>{$ap->descripcion}</b> fue Eliminado...!!!");
                } else {
                    Flash::warning("No se Pudieron Eliminar los Apo...!!!");
                }
            } elseif (Input::hasPost('pkApoyo')) {
                $this->ids = Input::post('pkApoyo');
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

            $ap = new ApApoyos();

            $this->apApoyos = $ap->find_first($id);

            if ($this->apApoyos) {

                if (Input::hasPost('apApoyos')) {


                    if ($ap->guardar(Input::post('apApoyos'))) {
                        Flash::valid('El Apoyo Ha Sido Actualizada Exitosamente...!!!');



                        if (!Input::isAjax()) {
                            return Router::redirect();
                        }
                    } else {
                        Flash::warning('No se Pudieron Guardar los Datos...!!!');
                    }
                }
            } else {
                Flash::warning("No existe ningun Apoyo con id '{$id}'");
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
