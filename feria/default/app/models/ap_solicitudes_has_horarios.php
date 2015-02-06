<?php

class ApSolicitudesHasHorarios extends ActiveRecord {

    protected function initialize() {
        $this->validates_presence_of('alumnos', 'message: Debe escribir el  <b>Numero de alumnos</b> que abordaran el autobus');
        $this->validates_presence_of('alumnas', 'message: Debe escribir el  <b>Numero de alumnas</b> que abordaran el autobus');
        $this->validates_presence_of('acompMuj', 'message: Debe escribir el  <b>Numero de Acompañantes Mujeres</b> que abordaran el autobus');
        $this->validates_presence_of('acompHom', 'message: Debe escribir el  <b>Numero de Acompañantes Hombres</b> que abordaran el autobus');
    }

    public function getHorariosSolicitud($id) {

        $cols = 'count(*) as cantidad, ap_solicitudes_has_horarios.' . join(',ap_solicitudes_has_horarios.', $this->fields) . " ";


        $conditions = "ap_solicitudes_has_horarios.pkSolicitud='$id'";

        return $this->find("conditions: $conditions", "columns: $cols", 'order: fecha desc ', 'group: ap_solicitudes_has_horarios.pkHorarioDia');
        //return $this->find("conditions: $conditions", "columns: $cols", "join: $joins", 'order: fecha desc ');
    }

    public function obtener_reservados($activo) {

        $reservados = array();
        $cols = 'ap_solicitudes_has_horarios.pkHorarioDia, ap_solicitudes_has_horarios.pkid';
        $joins = 'LEFT JOIN ap_horarios_dias AS HD ON HD.pkHorarioDia=ap_solicitudes_has_horarios.pkHorarioDia ';
        $joins.= 'LEFT JOIN ap_horarios AS H ON H.pkHorario=HD.pkHorario ';
        $joins.= 'LEFT JOIN ap_ferias AS F ON F.pkFeria= H.ferias_pkFeria ';
        $joins.= 'LEFT JOIN ap_solicitudes AS S ON S.pkSolicitud= ap_solicitudes_has_horarios.pkSolicitud ';
        $conditions = "F.activo='$activo' and S.estatus='1'";

        foreach ($this->find("conditions: $conditions", "columns: $cols", "join: $joins", 'order: H.salidaEscuela desc ') as $e) {
            $reservados["$e->pkid"] = $e->pkHorarioDia;
        }

        return $reservados;
    }

}

?>