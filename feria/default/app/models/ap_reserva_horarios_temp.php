<?php

class ApReservaHorariosTemp extends ActiveRecord {

    public function obtener_ocupados($activo) {



        $ocupados = array();
        $cols = 'ap_reserva_horarios_temp.pkid, ap_reserva_horarios_temp.pkHorarioDia';
        $joins = 'LEFT JOIN ap_horarios_dias AS HD ON HD.pkHorarioDia=ap_reserva_horarios_temp.pkHorarioDia ';
        $joins.= 'LEFT JOIN ap_horarios AS H ON H.pkHorario=HD.pkHorario ';
        $joins.= 'LEFT JOIN ap_ferias AS F ON F.pkFeria= H.ferias_pkFeria';
        $conditions = "F.activo='$activo' and ap_reserva_horarios_temp.usuario_id!='".Auth::get('id')."' ";
        foreach ($this->find("conditions: $conditions", "columns: $cols","join: $joins") as $e) {
            $ocupados["$e->pkid"] = $e->pkHorarioDia;
        }

        return $ocupados;
    }

}

?>