<?php

class ApHorariosDias extends ActiveRecord {

    protected function initialize() {
        $this->belongs_to('ap_horarios', 'ap_horarios', 'pkHorario');
    }

    public function obtener_camiones_dias($activo) {
        $dias = array();
        //   $cols = 'ap_horarios_dias.' . join(',ap_horarios_dias.', $this->fields) . ', D.fecha as fechaFeria ';
        $cols = 'D.fecha, ap_horarios_dias.pkHorarioDia,ap_horarios_dias.pkHorario,ap_horarios_dias.pkDias, H.numeroCamiones';
        $joins = 'LEFT JOIN ap_dias AS D ON D.pkDia=ap_horarios_dias.pkDias ';
        $joins.= 'LEFT JOIN ap_horarios AS H ON H.pkHorario=ap_horarios_dias.pkHorario ';
        $joins.= 'LEFT JOIN ap_ferias AS F ON F.pkFeria= D.ferias_pkFeria ';
        $conditions = "F.activo='$activo'";
        foreach ($this->find("conditions: $conditions", "columns: $cols", "join: $joins") as $e) {
            $dias["{$e->pkDias}-{$e->pkHorario}"] = array($e->pkHorarioDia,$e->numero_registros);
        }
        return $dias;
    }

    public function obtener_dias($id) {
        $dias = array();
        //   $cols = 'ap_horarios_dias.' . join(',ap_horarios_dias.', $this->fields) . ', D.fecha as fechaFeria ';
        $cols = 'fecha, pkHorario, pkDias, pkHorarioDia';
        $joins = 'LEFT JOIN ap_dias AS D ON D.pkDia=ap_horarios_dias.pkDias ';
        $conditions = "D.ferias_pkFeria='$id'";

        foreach ($this->find("conditions: $conditions", "columns: $cols", "join: $joins") as $e) {
            $dias["{$e->pkDias}-{$e->pkHorario}"] = $e->pkHorarioDia;
        }
        return $dias;
    }

    public function editarHorarios($datos, $horarios_dias_eliminar) {
        $this->begin();
        //elimino todo de la bd
        if (!$this->eliminarPorIds($horarios_dias_eliminar)) {
            $this->rollback();
            return FALSE;
        }

        foreach ((array) $datos as $e) {
            $data = explode('/', $e); //el formato es 1/4 = dia/horario
            if (!$this->guardar($data[0], $data[1])) {
                $this->rollback();
                return FALSE;
            }
        }
        $this->commit();
        return TRUE;
    }

    public function guardar($dia, $horario) {
        if ($this->existe($dia, $horario)) {
            return TRUE;
        } else {
            $horarioD = new ApHorariosDias();
            $horarioD->pkDias = $dia;
            $horarioD->pkHorario = $horario;
            return $horarioD->create();
        }
    }

    public function existe($dia, $horario) {
        return $this->exists("pkDias='$dia' AND pkHorario='$horario'");
    }

    public function eliminarPorIds($ids) {
        if (!empty($ids)) {
            $ids = str_replace('"', "'", Util::encomillar($ids));
            $res = $this->delete_all("pkHorarioDia IN ($ids)");
            $this->log();
            return $res;
        } else {
            return true;
        }
    }

}

?>
