<?php

class ApApoyos extends ActiveRecord {

    protected function initialize() {
        $this->belongs_to('ap_ferias', 'model: ap_ferias', 'fk:pkFeria');
    }

    public function getApoyos($page, $ppage = 20) {


        $cols = 'ap_apoyos.' . join(',ap_apoyos.', $this->fields) . ",F.nombre as nombreFeria";
        $joins = 'LEFT JOIN ap_ferias AS F ON F.pkFeria=ferias_pkFeria ';


        return $this->paginate("page: $page", "columns: $cols", "join: $joins", "per_page: $ppage", 'order: ferias_pkFeria desc, monto desc ');
    }

    public function getApoyosFeria($id_feria) { 
        $conditions = "ferias_pkFeria='$id_feria'";
        return $this->find("conditions: $conditions", "order: descripcion asc");
    }

    public function guardar($data) {
        $this->begin();
        if (!$this->save($data)) {
            $this->rollback();
            return FALSE;
        }
        $this->commit();
        return TRUE;
    }

}

?>