<?php

class ApSolicitudesHorariosForaneo extends ActiveRecord {

    public function getHorariosSolicitud($id) {

        $cols = 'ap_solicitudes_horarios_foraneo.' . join(',ap_solicitudes_horarios_foraneo.', $this->fields) . " ";
        $conditions = "ap_solicitudes_horarios_foraneo.pkSolicitud='$id'";

        return $this->find("conditions: $conditions", "columns: $cols", 'order: fecha desc ');

    }

}

?>