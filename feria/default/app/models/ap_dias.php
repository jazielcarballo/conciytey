<?php

class ApDias extends ActiveRecord {

    protected function initialize() {
        $this->belongs_to('ap_ferias', 'model: ap_ferias', 'fk:ferias_pkFeria');
    }

    public function get_dias($activo) {


        $cols = 'pkDia, fecha, ferias_pkFeria, F.activo as activo';
        $joins = 'LEFT JOIN ap_ferias AS F ON F.pkFeria=ferias_pkFeria ';
        $conditions = "F.activo='$activo'";

        return $this->find("conditions: $conditions", "columns: $cols", "join: $joins", "order: fecha asc");

       
    }
    
    
    public function getDiasFeria($id) {


        $cols = 'pkDia, fecha, ferias_pkFeria, F.activo as activo';
        $joins = 'LEFT JOIN ap_ferias AS F ON F.pkFeria=ferias_pkFeria ';
        $conditions = "F.pkFeria='$id'";

        return $this->find("conditions: $conditions", "columns: $cols", "join: $joins", "order: fecha asc");

       
    }

}

?>
