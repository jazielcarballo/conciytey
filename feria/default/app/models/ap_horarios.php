<?php

class ApHorarios extends ActiveRecord {

    protected function initialize() {
        //relaciones
        $this->has_and_belongs_to_many('ap_dias', 'model: ap_dias', 'fk: pkDias', 'through: ap_horarios_dias', 'key: pkHorario');
    }

    public function getHorarios($page, $ppage = 20) {


        $cols = 'ap_horarios.' . join(',ap_horarios.', $this->fields) . ",F.nombre as nombreFeria, D.fecha as fechaFeria";

        $joins = 'LEFT JOIN ap_dias AS D ON D.pkDia=ap_horarios.dias_pkDia ';
        $joins.= 'LEFT JOIN ap_ferias AS F ON F.pkFeria=D.ferias_pkFeria ';


        return $this->paginate("page: $page", "columns: $cols", "join: $joins", "per_page: $ppage", 'order: ferias_pkFeria asc,  fechaFeria desc ');
    }

    public function getHorariosAll($activo) {

        //  $cols = 'ap_horarios_dias.' . join(',ap_horarios_dias.', $this->fields) . ",F.nombre as nombreFeria, D.fecha as fechaFeria";
        $cols = 'pkHorario, salidaEscuela, llegadaEvento, salidaEvento, llegadaEscuela, numeroCamiones';
        $joins = 'LEFT JOIN ap_ferias AS F ON F.pkFeria=ferias_pkFeria ';
        $conditions = "F.activo='$activo'";

        return $this->find("conditions: $conditions", "columns: $cols", "join: $joins", "order: salidaEscuela asc");
    }

    public function getHorariosAllFeria($id) {

        //    $cols = 'ap_horarios_dias.' . join(',ap_horarios_dias.', $this->fields) . ",F.nombre as nombreFeria, D.fecha as fechaFeria";
        $cols = 'pkHorario, salidaEscuela, llegadaEvento, salidaEvento, llegadaEscuela, numeroCamiones';
        $joins = 'LEFT JOIN ap_ferias AS F ON F.pkFeria=ferias_pkFeria ';
        $conditions = "F.pkFeria='$id'";

        return $this->find("conditions: $conditions", "columns: $cols", "join: $joins", "order: salidaEscuela asc");
    }

    public function guardarHorario($datos) {

        $this->begin();
        $this->salidaEscuela = date("H:i:s",strtotime($datos['salidaEscuela']));
        $this->llegadaEvento = date("H:i:s", strtotime($datos['llegadaEvento']));
        $this->salidaEvento = date("H:i:s", strtotime($datos['salidaEvento']));
        $this->llegadaEscuela = date("H:i:s", strtotime($datos['llegadaEscuela']));
        $this->numeroCamiones = $datos['numeroCamiones'];
        $this->ferias_pkFeria = $datos['ferias_pkFeria'];

//        print_r($this->salidaEscuela);
//        print_r(date("H:i:s", strtotime($datos['salidaEscuela'])));

        if (!$this->save()) {
            $this->rollback();
            return FALSE;
        }

        $this->commit();
        return TRUE;
    }

}

?>