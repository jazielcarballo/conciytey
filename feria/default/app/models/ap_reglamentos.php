<?php

class ApReglamentos extends ActiveRecord {

     protected function initialize() {
        $this->belongs_to('ap_ferias','model: ap_ferias', 'fk:pkFeria');
    }
    
  public function getReglamentos($page, $ppage = 20) {
        
        
        $cols = 'ap_reglamentos.' . join(',ap_reglamentos.', $this->fields) . ",F.nombre as nombreFeria";
        $joins = 'LEFT JOIN ap_ferias AS F ON F.pkFeria=ferias_pkFeria ';
        
        
        return $this->paginate("page: $page","columns: $cols", "join: $joins","per_page: $ppage", 'order: ferias_pkFeria desc, posicion asc, descripcion asc ');
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
