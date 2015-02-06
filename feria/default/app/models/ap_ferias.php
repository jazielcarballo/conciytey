<?php

class ApFerias extends ActiveRecord {

    protected function initialize() {
        $this->has_many('ap_dias', 'ap_dias', 'fk:pkFeria');
        $this->has_many('ap_apoyos', 'ap_apoyos', 'fk:pkFeria');
        $this->has_many('ap_reglamentos', 'ap_reglamentos', 'fk:pkFeria');
    }

    public function getFerias($page, $ppage = 20) {
        return $this->paginate("page: $page", "per_page: $ppage", 'order: fechaInicio desc');
    }
    
    
    public function guardarEdicion($data) {


        $this->begin();
        $this->pkFeria=$data['pkFeria'];
        $this->nombre = $data['nombre'];
        $this->tematica = $data['tematica'];
        $this->activo = $data['activo'];
        $fechaInicio = str_replace('/', '-', $data['fechaInicio']);
        $this->fechaInicio = date("Y-m-d", strtotime($fechaInicio));
        $fechaFin = str_replace('/', '-', $data['fechaFin']);
        $this->fechaFin = date("Y-m-d", strtotime($fechaFin));


        if ($this->activo == 1) {
            $ferias = Load::model('ap_ferias');
            $ferias->update_all("activo='0'", "activo='1'");
        }

        if (!$this->save()) {
            $this->rollback();
            return FALSE;
        }




    

     

        $this->commit();
        return TRUE;
    }

    public function guardar($data) {


        $this->begin();

        $this->pkFeria=$data['pkFeria'];
        $this->nombre = $data['nombre'];
        $this->tematica = $data['tematica'];
        $this->activo = $data['activo'];
        $fechaInicio = str_replace('/', '-', $data['fechaInicio']);
        $this->fechaInicio = date("Y-m-d", strtotime($fechaInicio));
        $fechaFin = str_replace('/', '-', $data['fechaFin']);
        $this->fechaFin = date("Y-m-d", strtotime($fechaFin));


        if ($this->activo == 1) {
            $ferias = Load::model('ap_ferias');
            $ferias->update_all("activo='0'", "activo='1'");
        }

        if (!$this->save()) {
            $this->rollback();
            return FALSE;
        }




        $dias = Load::model('ap_dias');

        if (!$dias->delete_all("ferias_pkFeria = '$this->pkFeria'")) {
            Flash::error('No se pudieron Guardar los dias para la feria');
            $this->rollback();
            return FALSE;
        }

        for ($i = strtotime($this->fechaInicio); $i <= strtotime($this->fechaFin); $i = $i + 86400) {
            $dias = new ApDias();
            $dias->ferias_pkFeria = $this->pkFeria;
            $dias->fecha = date("Y-m-d", $i);
            $dias->save();
        }

        $this->commit();
        return TRUE;
    }

    public function getFirst($id) {
        Load::lib('date');

        $cols = "ap_ferias.pkFeria, ap_ferias.nombre, ap_ferias.tematica, ap_ferias.fechaInicio, ap_ferias.fechaFin, ap_ferias.activo";

        $conditions = " ap_ferias.pkFeria='$id'";

        return $this->find_first("conditions: $conditions", "columns: $cols");
    }
    
    
    
    
        public function activar() {

        $this->update_all("activo='0'", "activo='1'");

        if (isset($this->activo)) {
            $this->activo = '1';
            return $this->update();
        } else {
            Flash::error("La tabla <b>{$this->get_source()}</b> no tiene un campo <b>activo</b>");
            return FALSE;
        }
    }

    /**
     * Desactiva un registro en la tabla actual.
     *
     * @return boolean 
     */
    public function desactivar() {
        if (isset($this->activo)) {
            $this->activo = '0';
            return $this->update();
        } else {
            Flash::error("La tabla <b>{$this->get_source()}</b> no tiene un campo <b>activo</b>");
            return FALSE;
        }
    }


}

?>
