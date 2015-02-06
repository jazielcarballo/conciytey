<?php

Load::model('ap_ferias');
Load::model('ap_horarios');

class FeriasController extends AdminController {

    protected function after_filter() {
        if (Input::isAjax()) {
            View::select(NULL, NULL);
        }
    }

    public function index($page = 1) {
        try {
            $ferias = new  ApFerias();
            $this->listFerias = $ferias->getFerias($page);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function crear() {
        try {
            if (Input::hasPost('apferia')) {
                //esto es para tener atributos que no son campos de la tabla
                $fer = new ApFerias(Input::post('apferia'));
                //seleccionados en el formulario.
                if ($fer->guardar(Input::post('apferia'))) {
                    Flash::valid('La feria Ha Sido Agregado Exitosamente...!!!');
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
            $fer = new ApFerias();
            if (is_int($id)) {


                if (!$fer->find_first($id)) { //si no existe
                    Flash::warning("No existe ningun feria con id '{$id}'");
                } else if ($fer->delete()) {
                    Flash::valid("La feria <b>{$fer->nombre}</b> fué Eliminado...!!!");
                } else {
                    Flash::warning("No se Pudo Eliminar la Feria <b>{$fer->nombre}</b>...!!!");
                }
            } elseif (is_string($id)) {
                if ($fer->delete_all("pkFeria IN ($id)")) {
                    Flash::valid("La Feria <b>{$fer->nombre}</b> fue Eliminada...!!!");
                } else {
                    Flash::warning("No se Pudieron Eliminar las Ferias...!!!");
                }
            } elseif (Input::hasPost('pkFeria')) {
                $this->ids = Input::post('pkFeria');
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

            $fer = new ApFerias();

            $this->apferia = $fer->getFirst($id);

            if ($this->apferia) {

                if (Input::hasPost('apferia')) {


                    if ($fer->guardarEdicion(Input::post('apferia'))) {
                        Flash::valid('La feria Ha Sido Actualizada Exitosamente...!!!');



                        if (!Input::isAjax()) {
                            return Router::redirect();
                        }
                    } else {
                        Flash::warning('No se Pudieron Guardar los Datos...!!!');
                    }
                }
            } else {
                Flash::warning("No existe ningun feria con id '{$id}'");
                if (!Input::isAjax()) {
                    return Router::redirect();
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }
    
     public function activar($id) {
        try {
            $id = (int) $id;

            $feria = new ApFerias();

            if (!$feria->find_first($id)) { //si no existe
                Flash::warning("No existe ningun feria con id '{$id}'");
            } else if ($feria->activar()) {
                Flash::valid("La feria <b>{$feria->nombre}</b> Esta ahora <b>Activo</b>...!!!");
            } else {
                Flash::warning("No se Pudo Activar el Feria <b>{$feria->nombre}</b>...!!!");
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        Router::redirect();
    }

    public function desactivar($id) {
        try {
            $id = (int) $id;

            $feria = new ApFerias();

            if (!$feria->find_first($id)) { //si no existe
                Flash::warning("No existe ninguna feria con id '{$id}'");
            } else if ($feria->desactivar()) {
                Flash::valid("La feria <b>{$feria->nombre}</b> Esta ahora <b>Inactiva</b>...!!!");
            } else {
                Flash::warning("No se Pudo Desactivar la feria <b>{$feria->nombre}</b>...!!!");
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect();
    }
    
    
    
    /*-----------------horarios------------------------*/
      public function horario($id) {
        try {
            if ($id != 0) {
                $id = (int) $id;
                $horarios = Load::model('ap_horarios');
                $dias = Load::model('ap_dias');
                $horarios_dias = Load::model('ap_horarios_dias');
                $ferias = Load::model('ap_ferias');

                $this->feria = $ferias->find_first("conditions: pkFeria='$id'");
                $this->listHorarios = $horarios->getHorariosAllFeria($id);
                $this->dias = $dias->getDiasFeria($id);
                $this->diasArray = $horarios_dias->obtener_dias($id);
            } else {
                return Router::redirect('feria/ferias/horario');
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function eliminarHorario($id, $feria) {
        try {
            $ah = new ApHorarios();
            if (is_int($id)) {


                if (!$ah->find_first($id)) { //si no existe
                    Flash::warning("No existe ningun Horario con id '{$id}'");
                } else if ($ah->delete()) {
                    Flash::valid("El Horario <b>{$ah->descripcion}</b> fué Eliminado...!!!");
                } else {
                    Flash::warning("No se Pudo Eliminar el Horario <b>{$ah->descripcion}</b>...!!!");
                }
            } elseif (is_string($id)) {
                if ($ah->delete_all("pkHorario IN ($id)")) {
                    Flash::valid("El Horario <b>{$ah->descripcion}</b> fue Eliminado...!!!");
                } else {
                    Flash::warning("No se Pudieron Eliminar los Horarios...!!!");
                }
            } elseif (Input::hasPost('pkHorario')) {
                $this->ids = Input::post('pkHorarios');
                return;
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::toAction("horario/" . $feria);
    }

    public function editarHorario($feria) {


        try {
            if (Input::hasPost('priv') || Input::hasPost('horarios_dias')) {
                $obj = Load::model('ap_horarios_dias');
                $datos = Input::post('priv');
                $horarios_dias = Input::post('horarios_dias');
                if ($obj->editarHorarios($datos, $horarios_dias)) {
                    Flash::valid('Los Horarios Fueron Editados Exitosamente...!!!');
                } else {
                    Flash::warning('No se Pudieron Guardar los Datos...!!!');
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::toAction("horario/" . $feria);
    }

    public function guardarHora($feria) {
        try {
            if (Input::hasPost('apHorario')) {
                $obj = Load::model('ap_horarios');
                $datos = Input::post('apHorario');
       
                if ($obj->guardarHorario($datos)) {
                    Flash::valid('Los Horario Fue guardado Exitosamente...!!!');
                } else {
                    Flash::warning('No se Pudieron Guardar los Datos...!!!');
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::toAction("horario/" . $feria);
    }


}

?>
