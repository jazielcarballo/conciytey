<?php

Load::model('ap_instituciones');
Load::model('ap_horarios_dias');
Load::model('ap_dias');
Load::model('ap_horarios');
Load::model('ap_apoyos');

class ApSolicitudes extends ActiveRecord {

    protected function initialize() {
        $this->has_many('ap_horarios', 'ap_horarios', 'fk:pkHorarios');
    }

    public function getFeria($id) {

        $cols = 'F.nombre, F.tematica';
        $joins = ' LEFT JOIN ap_solicitudes_has_horarios AS SH ON SH.pkSolicitud=ap_solicitudes.pkSolicitud ';
        $joins.= ' LEFT JOIN ap_horarios_dias AS HD ON HD.pkHorarioDia=SH.pkHorarioDia ';
        $joins.= ' LEFT JOIN ap_dias AS D ON D.pkDia=HD.pkDias ';
        $joins.= ' LEFT JOIN ap_ferias AS F ON F.pkFeria=D.ferias_pkFeria ';
        $conditions = "ap_solicitudes.pkSolicitud='$id'";


        return $this->find_first("conditions: $conditions", "columns: $cols", "join: $joins", 'group: F.pkFeria');
    }

    public function guardarSolicitud($data, $data2, $data3) {

//print_r($data2);


        $solicitud = new ApSolicitudes();
        $solicitud->begin();
        $solicitud->fechaRegistro = date("Y-m-d H:i");
        $solicitud->nombreResponsable = $data['nombreResponsable'];
        $solicitud->telefonoResponsable = floatval($data['tipoResponsableTelefono']) * floatval(preg_replace(array('/ /', '/-/'), '', $data['telefonoResponsable']));
//        $solicitud->telefonoResponsable = $data['telefonoResponsable'];
        $solicitud->emailReponsable = $data['correoResponsable'];
        $solicitud->nombreSolicitante = $data['nombreSolicitante'];
        $solicitud->telefonoSolicitante = floatval($data['tipoSolicitanteTelefono']) * floatval(preg_replace(array('/ /', '/-/'), '', $data['telefonoSolicitante']));
//        $solicitud->telefonoSolicitante = $data['telefonoSolicitante'];
        $solicitud->emailSolicitante = $data['correoSolicitante'];
        $solicitud->apoyos_pkApoyo = $data['apoyos_pkApoyo'];
        $solicitud->estatus = 1;
        $solicitud->usuarios_pkUsuario = Auth::get('id');
        /* linea decodigo nueva */
        $solicitud->nombreInstitucion = $data2['nombreInstitucion'];
        $solicitud->nivelEscolar = $data2['nivelEscolar'];
        $solicitud->domicilio = $data2['domicilio'];
        $solicitud->referenciaDomicilio = $data2['referenciaDomicilio'];
        $tipo = floatval($data2['tipoTelefono']);
        $solicitud->telefonoInstitucion = $tipo * floatval(preg_replace(array('/ /', '/-/'), '', $data2['telefonoInstitucion']));
        $solicitud->municipio = $data2['municipio'];
        $solicitud->nombreDirector = $data2['nombreDirector'];
        $solicitud->emailDirector = $data2['emailDirector'];
        $solicitud->turno = $data2['turno'];




        if (!$solicitud->save()) {
            $solicitud->rollback();
            return FALSE;
        }


        $pkInstitucion = "";
        if ($data2['pkInstitucion'] == '') {
            $institucion = new ApInstituciones();
            $institucion->nombreInstitucion = $data2['nombreInstitucion'];
            $institucion->nivelEscolar = $data2['nivelEscolar'];
            $institucion->domicilio = $data2['domicilio'];
            $institucion->referenciaDomicilio = $data2['referenciaDomicilio'];
            $institucion->municipio = $data2['municipio'];
            $tipo = floatval($data2['tipoTelefono']);
            $institucion->telefonoInstitucion = $tipo * floatval(preg_replace(array('/ /', '/-/'), '', $data2['telefonoInstitucion']));
            $institucion->nombreDirector = $data2['nombreDirector'];
            $institucion->emailDirector = $data2['emailDirector'];
            $institucion->turno = $data2['turno'];
            if (!$institucion->save()) {
                $solicitud->rollback();
                return FALSE;
            } else {
                $pkInstitucion = $institucion->pkInstitucion;
            }
        } else {


            $pkInstitucion = $data2['pkInstitucion'];

            $institucion2 = new ApInstituciones();
            $aist = $institucion2->find($pkInstitucion);
            $aist->nivelEscolar = $data2['nivelEscolar'];
            $aist->domicilio = $data2['domicilio'];
            $aist->referenciaDomicilio = $data2['referenciaDomicilio'];
            $aist->municipio = $data2['municipio'];
            $tipo = floatval($data2['tipoTelefono']);
            $aist->telefonoInstitucion = $tipo * floatval(preg_replace(array('/ /', '/-/'), '', $data2['telefonoInstitucion']));
            $aist->nombreDirector = $data2['nombreDirector'];
            $aist->emailDirector = $data2['emailDirector'];
            $aist->turno = $data2['turno'];
            $aist->update();
        }

        $intitucionesHasSolicitud = Load::model('ap_instituciones_has_solicitudes');
        if (!$intitucionesHasSolicitud->guardarRelacion($solicitud->pkSolicitud, $pkInstitucion)) {
            $solicitud->rollback();
            return FALSE;
        }


        $ap_apoyo = new ApApoyos();
        $apoyo_id = $data['apoyos_pkApoyo'];
        $apoyo = $ap_apoyo->find_first("pkApoyo='$apoyo_id'");


        for ($i = 0; $i < count($data3); $i = $i + 6) {
            $ap_solicitudes_has_horarios = new ApSolicitudesHasHorarios();

            $ap_horarios_dias = new ApHorariosDias();
            $cols = 'fecha,salidaEscuela,llegadaEvento,salidaEvento,llegadaEscuela ';
            $joins = ' LEFT JOIN ap_horarios AS H ON H.pkHorario=ap_horarios_dias.pkHorario';
            $joins.= ' LEFT JOIN ap_dias AS D ON D.pkDia=ap_horarios_dias.pkDias';
            $conditions = "ap_horarios_dias.pkHorarioDia='$data3[$i]'";
            $horario = $ap_horarios_dias->find_first("conditions: $conditions", "join: $joins", "columns: $cols");




            $ap_solicitudes_has_horarios->pkSolicitud = $solicitud->pkSolicitud;
            $ap_solicitudes_has_horarios->pkHorarioDia = $data3[$i];
            $ap_solicitudes_has_horarios->alumnos = $data3[$i + 1];
            $ap_solicitudes_has_horarios->alumnas = $data3[$i + 2];
            $ap_solicitudes_has_horarios->acompMuj = $data3[$i + 3];
            $ap_solicitudes_has_horarios->acompHom = $data3[$i + 4];
            $ap_solicitudes_has_horarios->salidaEscuela = $horario->salidaEscuela;
            $ap_solicitudes_has_horarios->llegadaEvento = $horario->llegadaEvento;
            $ap_solicitudes_has_horarios->salidaEvento = $horario->salidaEvento;
            $ap_solicitudes_has_horarios->llegadaEscuela = $horario->llegadaEscuela;
            $ap_solicitudes_has_horarios->fecha = $horario->fecha;
            $ap_solicitudes_has_horarios->apoyo = $apoyo->monto;
            $ap_solicitudes_has_horarios->pkid = $data3[$i + 5];


            $ap_solicitudes_has_horarios->save();

            if (!$ap_solicitudes_has_horarios->save()) {
                $solicitud->rollback();
                return FALSE;
            }
        }



        $solicitud->commit();

        return TRUE;
    }

    public function getSolicitudes($page, $ppage = 30) {
        $cols = 'ap_solicitudes.' . join(',ap_solicitudes.', $this->fields) . ",AP.ferias_pkFeria as pkFeria, I.nombreInstitucion as nombreInstitucion, U.nombres as nombreUsuario";
        $joins = 'LEFT JOIN ap_instituciones_has_solicitudes AS RI ON RI.solicitudes_pkSolicitud=ap_solicitudes.pkSolicitud ';
        $joins.='LEFT JOIN ap_instituciones AS I ON I.pkInstitucion=RI.instituciones_pkInstitucion ';
        $joins.='LEFT JOIN usuarios AS U ON U.id=ap_solicitudes.usuarios_pkUsuario ';
        $joins.='LEFT JOIN ap_apoyos AS AP ON AP.pkApoyo=ap_solicitudes.apoyos_pkApoyo ';
        $joins.='LEFT JOIN ap_ferias AS F ON F.pkFeria=AP.ferias_pkFeria ';
        //  $usuario_id=  Auth::get('id');
        $conditions = "F.activo='1' and ap_solicitudes.estatus='1'";

        //  return $this->find("conditions: $conditions", "columns: $cols", "join: $joins",'order: fechaRegistro desc ');
        return $this->paginate("page: $page", "columns: $cols", "join: $joins", "per_page: $ppage", 'order: fechaRegistro desc ', "conditions: $conditions");
    }

    public function getSolicitudesCanceladas($page, $ppage = 30) {
        $cols = 'ap_solicitudes.' . join(',ap_solicitudes.', $this->fields) . ",AP.ferias_pkFeria as pkFeria, I.nombreInstitucion as nombreInstitucion, U.nombres as nombreUsuario";
        $joins = 'LEFT JOIN ap_instituciones_has_solicitudes AS RI ON RI.solicitudes_pkSolicitud=ap_solicitudes.pkSolicitud ';
        $joins.='LEFT JOIN ap_instituciones AS I ON I.pkInstitucion=RI.instituciones_pkInstitucion ';
        $joins.='LEFT JOIN usuarios AS U ON U.id=ap_solicitudes.usuarios_pkUsuario ';
        $joins.='LEFT JOIN ap_apoyos AS AP ON AP.pkApoyo=ap_solicitudes.apoyos_pkApoyo ';
        $joins.='LEFT JOIN ap_ferias AS F ON F.pkFeria=AP.ferias_pkFeria ';





        $conditions = "F.activo='1' and ap_solicitudes.estatus='0'";

        //  return $this->find("conditions: $conditions", "columns: $cols", "join: $joins",'order: fechaRegistro desc ');
        return $this->paginate("page: $page", "columns: $cols", "join: $joins", "per_page: $ppage", 'order: fechaRegistro desc ', "conditions: $conditions");
    }

    public function getSolicitud($id) {
        $cols = 'ap_solicitudes.' . join(',ap_solicitudes.', $this->fields) . ", AP.monto, AP.descripcion, AP.ferias_pkFeria as pkFeria, U.nombres as nombreUsuario, F.nombre as nombreFeria";

        $joins = 'LEFT JOIN ap_instituciones_has_solicitudes AS RI ON RI.solicitudes_pkSolicitud=ap_solicitudes.pkSolicitud ';

        $joins.='LEFT JOIN usuarios AS U ON U.id=ap_solicitudes.usuarios_pkUsuario ';
        $joins.='LEFT JOIN ap_apoyos AS AP ON AP.pkApoyo=ap_solicitudes.apoyos_pkApoyo ';
        $joins.='LEFT JOIN ap_ferias AS F ON F.pkFeria=AP.ferias_pkFeria ';
        $conditions = "ap_solicitudes.pkSolicitud='$id'";

        return $this->find_first("conditions: $conditions", "columns: $cols", "join: $joins", 'order: fechaRegistro desc ');
    }

    public function getReglamento($id) {

        $cols = 'ap_solicitudes.pkSolicitud, R.posicion, R.descripcion ';
        $joins = 'LEFT JOIN ap_apoyos AS A ON A.pkApoyo=ap_solicitudes.apoyos_pkApoyo ';
        $joins.= 'LEFT JOIN ap_ferias AS F ON F.pkFeria=A.ferias_pkFeria ';
        $joins.= 'LEFT JOIN ap_reglamentos AS R ON R.ferias_pkFeria=A.ferias_pkFeria ';
        $conditions = "ap_solicitudes.pkSolicitud='$id'";

        return $this->find("conditions: $conditions", "columns: $cols", "join: $joins", 'order: posicion asc ');
    }

    public function deleteRelaciones($id_solicitud) {


        $ap_solicitudes_has_horarios = Load::model('ap_solicitudes_has_horarios');
        $ap_solicitudes_has_horarios->delete_all("pkSolicitud='$id_solicitud'");

        $ap_instituciones_has_solicitudes = Load::model('ap_instituciones_has_solicitudes');
        $ap_instituciones_has_solicitudes->delete_all("solicitudes_pkSolicitud='$id_solicitud'");

        $ap_solicitudes = Load::model('ap_solicitudes');

        return $ap_solicitudes->delete_all("pkSolicitud='$id_solicitud'");
    }

}

?>