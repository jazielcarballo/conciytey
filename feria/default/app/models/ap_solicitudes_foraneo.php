<?php

//Load::model('ap_solicitudes_horarios_foraneo');
Load::model('ap_instituciones');
Load::model('ap_solicitudes_horarios_foraneo');
Load::model('ap_ferias');

class ApSolicitudesForaneo extends ActiveRecord {

    public function guardarSolicitud($institucion, $responsables, $horarios) {

        /*  echo '<pre>';
          print_r($institucion);
          echo '</pre>';

          echo '<pre>';
          print_r($responsables);
          echo '</pre>';


          echo '<pre>';
          print_r($horarios);
          echo '</pre>'; */


        $solicitud = new ApSolicitudesForaneo();
        $solicitud->begin();
        $maximo = $solicitud->maximum("pkSolicitud");
        $solicitud_id = intval($maximo) + 1;


        $solicitud->fechaRegistro = date("Y-m-d H:i");
        $solicitud->nombreResponsable = $responsables['nombreResponsable'];
        $solicitud->telefonoResponsable = floatval($responsables['tipoResponsableTelefono']) * floatval(preg_replace(array('/ /', '/-/'), '', $responsables['telefonoResponsable']));
        $solicitud->emailReponsable = $responsables['correoResponsable'];
        $solicitud->nombreSolicitante = $responsables['nombreSolicitante'];
        $solicitud->telefonoSolicitante = floatval($responsables['tipoSolicitanteTelefono']) * floatval(preg_replace(array('/ /', '/-/'), '', $responsables['telefonoSolicitante']));
        $solicitud->emailSolicitante = $responsables['correoSolicitante'];
        $solicitud->apoyo = $responsables['apoyo'];
        $solicitud->estatus = 1;
        $solicitud->usuarios_pkUsuario = Auth::get('id');
        $solicitud->nombreInstitucion = $institucion['nombreInstitucion'];
        $solicitud->nivelEscolar = $institucion['nivelEscolar'];
        $solicitud->domicilio = $institucion['domicilio'];
        $solicitud->referenciaDomicilio = $institucion['referenciaDomicilio'];
        $tipo = floatval($institucion['tipoTelefono']);
        $solicitud->telefonoInstitucion = $tipo * floatval(preg_replace(array('/ /', '/-/'), '', $institucion['telefonoInstitucion']));
        $solicitud->municipio = $institucion['municipio'];
        $solicitud->nombreDirector = $institucion['nombreDirector'];
        $solicitud->emailDirector = $institucion['emailDirector'];
        $solicitud->turno = $institucion['turno'];

        $feria = new ApFerias();
        $f = $feria->find_first("activo='1'");
        $solicitud->pkFeria = $f->pkFeria;


        if (!$solicitud->save()) {
            $solicitud->rollback();
            $solicitud->sql("ALTER TABLE ap_solicitudes_foraneo auto_increment =$solicitud_id");
            return FALSE;
        }


        $pkInstitucion = "";
        if ($institucion['pkInstitucion'] == '') {
            $instituciones = new ApInstituciones();
            $instituciones->nombreInstitucion = $institucion['nombreInstitucion'];
            $instituciones->nivelEscolar = $institucion['nivelEscolar'];
            $instituciones->domicilio = $institucion['domicilio'];
            $instituciones->referenciaDomicilio = $institucion['referenciaDomicilio'];
            $instituciones->municipio = $institucion['municipio'];
            $tipo = floatval($institucion['tipoTelefono']);
            $instituciones->telefonoInstitucion = $tipo * floatval(preg_replace(array('/ /', '/-/'), '', $institucion['telefonoInstitucion']));
            $instituciones->nombreDirector = $institucion['nombreDirector'];
            $instituciones->emailDirector = $institucion['emailDirector'];
            $instituciones->turno = $institucion['turno'];
            if (!$instituciones->save()) {
                $solicitud->rollback();
                $solicitud->sql("ALTER TABLE ap_solicitudes_foraneo auto_increment =$solicitud_id");
                return FALSE;
            } else {
                $pkInstitucion = $instituciones->pkInstitucion;
            }
        } else {

            $pkInstitucion = $institucion['pkInstitucion'];
            $institucion2 = new ApInstituciones();
            $aist = $institucion2->find($pkInstitucion);
            $aist->nivelEscolar = $institucion['nivelEscolar'];
            $aist->domicilio = $institucion['domicilio'];
            $aist->referenciaDomicilio = $institucion['referenciaDomicilio'];
            $aist->municipio = $institucion['municipio'];
            $tipo = floatval($institucion['tipoTelefono']);
            $aist->telefonoInstitucion = $tipo * floatval(preg_replace(array('/ /', '/-/'), '', $institucion['telefonoInstitucion']));
            $aist->nombreDirector = $institucion['nombreDirector'];
            $aist->emailDirector = $institucion['emailDirector'];
            $aist->turno = $institucion['turno'];
            $aist->update();
        }



        //  printf(count($horarios));

        for ($i = 0; $i < count($horarios); $i = $i + 9) {

            $solicitudesHorarios = new ApSolicitudesHorariosForaneo();
            $solicitudesHorarios->fecha = date('Y-m-d', strtotime($horarios[$i]));
            $solicitudesHorarios->salidaEscuela = $horarios[$i + 1];
            $solicitudesHorarios->llegadaEvento = $horarios[$i + 2];
            $solicitudesHorarios->salidaEvento = $horarios[$i + 3];
            $solicitudesHorarios->llegadaEscuela = $horarios[$i + 4];
            $solicitudesHorarios->alumnos = $horarios[$i + 5];
            $solicitudesHorarios->alumnas = $horarios[$i + 6];
            $solicitudesHorarios->acompMuj = $horarios[$i + 7];
            $solicitudesHorarios->acompHom = $horarios[$i + 8];
            $solicitudesHorarios->pkSolicitud = $solicitud->pkSolicitud;
            $solicitudesHorarios->apoyo = $responsables['apoyo'];

            if (!$solicitudesHorarios->save()) {
                $solicitud->rollback();
                $solicitud->sql("ALTER TABLE ap_solicitudes_foraneo auto_increment =$solicitud_id");
                return FALSE;
            }
        }



        $solicitud->commit();
        return TRUE;
    }

    public function getSolicitudes($page, $ppage = 30) {
        $cols = 'ap_solicitudes_foraneo.' . join(',ap_solicitudes_foraneo.', $this->fields) . ", U.nombres as nombreUsuario";
        $joins = 'LEFT JOIN usuarios AS U ON U.id=ap_solicitudes_foraneo.usuarios_pkUsuario ';
        $joins.='LEFT JOIN ap_ferias AS F ON F.pkFeria=ap_solicitudes_foraneo.pkFeria ';

        $conditions = "F.activo='1' and ap_solicitudes_foraneo.estatus='1'";

        //  return $this->find("conditions: $conditions", "columns: $cols", "join: $joins",'order: fechaRegistro desc ');
        return $this->paginate("page: $page", "columns: $cols", "join: $joins", "per_page: $ppage", 'order: fechaRegistro desc ', "conditions: $conditions");
    }

    public function getSolicitudesCanceladas($page, $ppage = 30) {
        $cols = 'ap_solicitudes_foraneo.' . join(',ap_solicitudes_foraneo.', $this->fields) . ", U.nombres as nombreUsuario";
        $joins = 'LEFT JOIN usuarios AS U ON U.id=ap_solicitudes_foraneo.usuarios_pkUsuario ';
        $joins.='LEFT JOIN ap_ferias AS F ON F.pkFeria=ap_solicitudes_foraneo.pkFeria ';

        $conditions = "F.activo='1' and ap_solicitudes_foraneo.estatus='0'";

        //  return $this->find("conditions: $conditions", "columns: $cols", "join: $joins",'order: fechaRegistro desc ');
        return $this->paginate("page: $page", "columns: $cols", "join: $joins", "per_page: $ppage", 'order: fechaRegistro desc ', "conditions: $conditions");
    }

    public function getFeria($id) {

        $cols = 'F.nombre, F.tematica';
        $joins.= ' LEFT JOIN ap_ferias AS F ON F.pkFeria=ap_solicitudes_foraneo.pkFeria ';
        $conditions = "ap_solicitudes_foraneo.pkSolicitud='$id'";
        return $this->find_first("conditions: $conditions", "columns: $cols", "join: $joins", 'group: F.pkFeria');
    }

    public function getSolicitud($id) {
        $cols = 'ap_solicitudes_foraneo.' . join(',ap_solicitudes_foraneo.', $this->fields) . ", U.nombres as nombreUsuario";



        $joins.='LEFT JOIN usuarios AS U ON U.id=ap_solicitudes_foraneo.usuarios_pkUsuario ';
        $joins.='LEFT JOIN ap_ferias AS F ON F.pkFeria=ap_solicitudes_foraneo.pkFeria ';
        $conditions = "ap_solicitudes_foraneo.pkSolicitud='$id'";

        return $this->find_first("conditions: $conditions", "columns: $cols", "join: $joins", 'order: fechaRegistro desc ');
    }

    public function getReglamento($id) {

        $cols = 'ap_solicitudes_foraneo.pkSolicitud, R.posicion, R.descripcion ';

        $joins.= 'LEFT JOIN ap_reglamentos AS R ON R.ferias_pkFeria=ap_solicitudes_foraneo.pkFeria ';
        $conditions = "ap_solicitudes_foraneo.pkSolicitud='$id'";

        return $this->find("conditions: $conditions", "columns: $cols", "join: $joins", 'order: posicion asc ');
    }

}

?>
