<?php

class ApInstitucionesHasSolicitudes extends ActiveRecord {

    public function guardarRelacion($data,$data2) {

        $this->solicitudes_pkSolicitud = $data;
        $this->instituciones_pkInstitucion = $data2;

        
 return $this->save();
    }

}

?>