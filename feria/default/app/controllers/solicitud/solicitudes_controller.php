<?php

Load::model('ap_ferias');
Load::model('ap_apoyos');
Load::model('ap_solicitudes');
Load::model('ap_instituciones_has_solicitudes');
Load::model('ap_horarios_dias');
Load::model('ap_solicitudes_has_horarios');
Load::model('ap_solicitudes_foraneo');
Load::model('ap_solicitudes_horarios_foraneo');

class SolicitudesController extends AdminController {

    protected function after_filter() {
        if (Input::isAjax()) {
            View::select(NULL, NULL);
        }
    }

    public function index($page = 1) {
        try {
            $ferias = new ApFerias();
            $solicitudes = new ApSolicitudes();
            $this->feria = $ferias->find_first("conditions: activo='1'");
            $this->Listasolicitudes = $solicitudes->getSolicitudes($page);
            $this->ListasolicitudesCancelar = $solicitudes->getSolicitudesCanceladas($page);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function listaForaneo($page = 1) {
        try {
            $ferias = new ApFerias();
            $solicitudes = new ApSolicitudesForaneo();
            $this->feria = $ferias->find_first("conditions: activo='1'");
            $this->Listasolicitudes = $solicitudes->getSolicitudes($page);
            $this->ListasolicitudesCancelar = $solicitudes->getSolicitudesCanceladas($page);
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function eliminar($id = NULL) {

        $id = (int) $id;
        try {
            $ap_solicitudes = new ApSolicitudes();
            if (is_int($id)) {


                if (!$ap_solicitudes->find_first($id)) { //si no existe
                    Flash::warning("No existe ninguna solicitud con id '{$id}'");
                } else if ($ap_solicitudes->update("estatus: 0")) {
                    Flash::valid("La solicitud <b>{$ap_solicitudes->pkSolicitud}</b> fue cancelada...!!!");
                } else {
                    Flash::warning("No se Pudo Cancelar la Solicitud <b>{$ap_solicitudes->pkSolicitud}</b>...!!!");
                }
            } elseif (is_string($id)) {
                if ($ap_solicitudes->update("estatus: 0")) {
                    Flash::valid("La solicitud <b>{$ap_solicitudes->pkSolicitu}</b> fue Cancelada...!!!");
                } else {
                    Flash::warning("No se cancelo la solicitud...!!!");
                }
            } elseif (Input::hasGet($id)) {
                $this->ids = Input::get($id);
                return;
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect('solicitud/solicitudes/index');
    }

    public function cancelarForaneo($id = NULL) {

        $id = (int) $id;
        try {
            $ap_solicitudes = new ApSolicitudesForaneo();
            if (is_int($id)) {


                if (!$ap_solicitudes->find_first($id)) { //si no existe
                    Flash::warning("No existe ninguna solicitud con id '{$id}'");
                } else if ($ap_solicitudes->update("estatus: 0")) {
                    Flash::valid("La solicitud <b>{$ap_solicitudes->pkSolicitud}</b> fue cancelada...!!!");
                } else {
                    Flash::warning("No se Pudo Cancelar la Solicitud <b>{$ap_solicitudes->pkSolicitud}</b>...!!!");
                }
            } elseif (is_string($id)) {
                if ($ap_solicitudes->update("estatus: 0")) {
                    Flash::valid("La solicitud <b>{$ap_solicitudes->pkSolicitu}</b> fue Cancelada...!!!");
                } else {
                    Flash::warning("No se cancelo la solicitud...!!!");
                }
            } elseif (Input::hasGet($id)) {
                $this->ids = Input::get($id);
                return;
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
        return Router::redirect('solicitud/solicitudes/listaForaneo');
    }

    public function crear() {
        try {


            $ferias = Load::model('ap_ferias');
            $horarios = Load::model('ap_horarios');
            $dias = Load::model('ap_dias');
            $horarios_dias = Load::model('ap_horarios_dias');
            $ap_reserva_horarios_temp = Load::model('ap_reserva_horarios_temp');
            $ap_solicitudes_has_horarios = Load::model('ap_solicitudes_has_horarios');

            $this->feria = $ferias->find_first("conditions: activo='1'");
            $this->listHorarios = $horarios->getHorariosAll('1');    /* todos los horarios de la feria ativa */
            $this->dias = $dias->get_dias('1');                      /* todos los dias de la feria activa */

            $this->diasHorario = $horarios_dias->obtener_camiones_dias('1');     /* todos horarios y dias validos de la feria actual */
            $this->reservados = $ap_solicitudes_has_horarios->obtener_reservados('1'); /* todos los horarios solicitados asta el momento */
            $this->ocupados = $ap_reserva_horarios_temp->obtener_ocupados('1');     /* trae todos los horarios ocupados de la feria */





            if (Input::hasPost('ap_solicitudes')) {



                if (Input::hasPost('ap_solicitudes_has_horarios')) {
                    $solicitud = new ApSolicitudes();
                    $data = Input::post('ap_solicitudes');
                    $data2 = Input::post('ap_instituciones');
                    $data3 = array_values(Input::post('ap_solicitudes_has_horarios')); /* convierto el array de nombre a array normal */

                    //print_r(Input::post('ap_solicitudes_has_horarios'));

                    $solicitudes = array();
                    for ($i = 0; $i < count($data3); $i = $i + 6) {
                        array_push($solicitudes, $data3[$i]);
                    }
                    $solicitudes = array_count_values($solicitudes);
//    print_r($solicitudes);


                    $band = true;
                    foreach ($solicitudes as $id_horario => $solicitados) {


                        $ap_solicitudes_has_horarios = new ApSolicitudesHasHorarios();

                        $reservados = $ap_solicitudes_has_horarios->count_by_sql("SELECT COUNT(*) FROM ap_solicitudes_has_horarios AS HS LEFT JOIN ap_solicitudes AS S ON S.pkSolicitud=HS.pkSolicitud WHERE HS.pkHorarioDia='$id_horario' AND S.estatus=1");
//$reservados = $ap_solicitudes_has_horarios->count("pkHorarioDia='$id_horario'");
//  print_r($reservados);
// return false;

                        $ap_horarios_dias = new ApHorariosDias();
                        $totales = $ap_horarios_dias->find_first("conditions: ap_horarios_dias.pkHorarioDia='$id_horario'", "join: LEFT JOIN ap_horarios as H ON H.pkHorario=ap_horarios_dias.pkHorario", "columns: ap_horarios_dias.pkHorarioDia,ap_horarios_dias.pkHorario,ap_horarios_dias.pkDias, H.numeroCamiones ");

                        $disponibles = intval($totales->numeroCamiones,10) - intval($reservados,10);

                        if ($solicitados > $disponibles) {
                            $band = false;
                        }
                    }

                    if ($band == true) {

                        echo '<script>
                                
   $("html, body").animate({ scrollTop: 0 }, 200); 
   </script>';


                        if ($solicitud->guardarSolicitud($data, $data2, $data3)) {



                            Flash::info('Guardando la Solicitud...<i class="icon-refresh icon-spin"></i>');
                            echo '<script>
                                
   $("html, body").animate({ scrollTop: 0 }, 200);

window.location = "http://' . $_SERVER['HTTP_HOST'] . PUBLIC_PATH . 'solicitud/solicitudes/index"


</script>'; /* mejorar la libreria */
                        } else {

                            View::response('view');
                            Flash::warning('No se Pudieron Guardar los Datos...!!!');
                            echo '<script>
                                
   $("html, body").animate({ scrollTop: 0 }, 200); 
   </script>';
                        }
                    } else {
                        Flash::warning('Compruebe la disponibilidad de camiones...!!!');
                        echo '<script>reloadCamiones();</script>';
                    }
                } else {
                    Flash::warning('No se han selecionado Camiones...!!!');
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function imprimir($id) {
        View::template(NULL); /* importante de poner ya que sino no se genra bien elpdf */
        $solicitudes = Load::model('ap_solicitudes');
        $solicitudesHorarios = Load::model('ap_solicitudes_has_horarios');

        $this->feria = $solicitudes->getFeria($id);

        $this->solicitud = $solicitudes->getSolicitud($id);
        $this->solicitudHorarios = $solicitudesHorarios->getHorariosSolicitud($id);
        $this->reglamento = $solicitudes->getReglamento($id);
    }

    public function imprimirForaneo($id) {
        View::template(NULL); /* importante de poner ya que sino no se genra bien elpdf */
        $solicitudes = new ApSolicitudesForaneo();
        $solicitudesHorarios = new ApSolicitudesHorariosForaneo();

        $this->feria = $solicitudes->getFeria($id);

        $this->solicitud = $solicitudes->getSolicitud($id);
        $this->solicitudHorarios = $solicitudesHorarios->getHorariosSolicitud($id);
        $this->reglamento = $solicitudes->getReglamento($id);
    }

    public function reservarCamion() {
        try {
            if (Input::hasPost('pkid')) {
                $ap_reserva_horarios_temp = Load::model('ap_reserva_horarios_temp');

                $pkHorarioDia = Input::Post('pkHorarioDia');
                $pkid = Input::Post('pkid');



                if ($ap_reserva_horarios_temp->exists("pkHorarioDia='$pkHorarioDia' and pkid='$pkid'")) {
                    echo $pkid;
                } else {
                    $ap_reserva_horarios_temp->pkHorarioDia = Input::Post('pkHorarioDia');
                    $ap_reserva_horarios_temp->pkid = Input::Post('pkid');
                    $ap_reserva_horarios_temp->usuario_id = Auth::get('id');
                    $ap_reserva_horarios_temp->save();
                    echo "reservado";
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function EliminarReservarCamion() {
        try {
            if (Input::hasPost('pkid')) {
                $ap_reserva_horarios_temp = Load::model('ap_reserva_horarios_temp');
                $pkid = Input::Post('pkid');
                $usuario_id = Auth::get("id");

                if ($ap_reserva_horarios_temp->delete_all("pkid='$pkid' and usuario_id='$usuario_id'")) {
                    echo $pkid;
                } else {
                    echo 'Error';
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function eliminarTemporal() {
        try {

            $usuario_id = Auth::get('id');
            // print_r($usuario_id);
            $ap_reserva_horarios_temp = Load::model('ap_reserva_horarios_temp');
            $ap_reserva_horarios_temp->delete_all("usuario_id='$usuario_id'");
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function actualizaHorarios() {
        $ap_reserva_horarios_temp = Load::model('ap_reserva_horarios_temp');
        $ap_solicitudes_has_horarios = Load::model('ap_solicitudes_has_horarios');
        $reservados = $ap_solicitudes_has_horarios->obtener_reservados('1'); /* todos los horarios solicitados asta el momento */
        $ocupados = $ap_reserva_horarios_temp->obtener_ocupados('1');     /* trae todos los horarios ocupados de la feria */


        $datos = array();
        foreach ($reservados as $e => $id) {

            $datos[] =
                    array("id" => $e, "src" => "bus_reservado.png");
        }
        foreach ($ocupados as $e => $id) {
            $datos[] =
                    array("id" => $e, "src" => "bus_ocupado.png");
        }
        echo json_encode($datos);
    }

    public function foranea() {
        try {
            $ferias = Load::model('ap_ferias');
            $this->feria = $ferias->find_first("conditions: activo='1'");

            if (Input::hasPost('ap_solicitudes')) {
                $ap_solicitudes_foraneo = new ApSolicitudesForaneo();
                $institucion = Input::post('ap_instituciones');
                $responsables = Input::post('ap_solicitudes');
                if (Input::hasPost('ap_solicitudes_has_horarios')) {

                    $horarios = Input::post('ap_solicitudes_has_horarios');

                    if ($ap_solicitudes_foraneo->guardarSolicitud($institucion, $responsables, $horarios)) {

                        Flash::success('Datos guardados...!!!');
                    } else {

                        Flash::warning('No se pudieron guardar los datos...!!!');
                    }
                } else {
                    Flash::warning('No se han selecionado Camiones...!!!');
                }
            }
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

}

?>
