<?php

Load::model('ap_ferias');
Load::model('ap_solicitudes');
Load::model('ap_dias');

class InicioController extends AdminController {

    protected function after_filter() {
        if (Input::isAjax()) {
            View::select(NULL, NULL);
        }
    }

    public function index($page = 1) {
        try {

            $ferias = new ApFerias();
            $solicitudes = new ApSolicitudes();
            $this->ferias = $ferias->find('order: fechaInicio desc');
            $this->solicitudes = $solicitudes->count('estatus=1');
            $this->solicitudesC = $solicitudes->count('estatus=0');
        } catch (KumbiaException $e) {
            View::excepcion($e);
        }
    }

    public function folios($id) {
        View::template(NULL); /* importante de poner ya que sino no se genra bien elpdf */
        $solicitudes = new ApSolicitudes();
        $this->folios = $solicitudes->find_all_by_sql('
            SELECT S.pkSolicitud, S.nombreInstitucion, S.domicilio, S.referenciaDomicilio, D.fecha,H.salidaEscuela,H.llegadaEvento,H.salidaEvento,H.llegadaEscuela,S.nivelEscolar,S.nombreDirector,
 S.telefonoInstitucion,S.nombreResponsable,S.telefonoResponsable, S.nombreSolicitante,S.telefonoSolicitante, SH.alumnos,SH.alumnas,SH.acompMuj,SH.acompHom,
 A.descripcion, A.monto,S.fechaRegistro,U.nombres,S.estatus
FROM ap_solicitudes AS S
INNER JOIN ap_solicitudes_has_horarios AS SH ON SH.pkSolicitud=S.pkSolicitud
INNER JOIN ap_apoyos AS A ON A.pkApoyo=S.apoyos_pkApoyo
INNER JOIN ap_horarios_dias AS HD ON HD.pkHorarioDia=SH.pkHorarioDia
INNER JOIN ap_horarios AS H ON H.pkHorario=HD.pkHorario
INNER JOIN ap_instituciones_has_solicitudes AS IHI ON IHI.solicitudes_pkSolicitud=S.pkSolicitud
INNER JOIN ap_instituciones AS I ON I.pkInstitucion=IHI.instituciones_pkInstitucion
INNER JOIN ap_dias AS D ON D.pkDia=HD.pkDias
INNER JOIN usuarios AS U ON U.id=S.usuarios_pkUsuario
WHERE D.ferias_pkFeria='.$id.' ORDER BY S.pkSolicitud ASC, D.fecha ASC ');
    }
    
    
    
    public function diaHora($id) {
        View::template(NULL); /* importante de poner ya que sino no se genra bien elpdf */
        $solicitudes = new ApSolicitudes();
        $this->folios = $solicitudes->find_all_by_sql('
            SELECT S.pkSolicitud, S.nombreInstitucion, S.domicilio, S.referenciaDomicilio, D.fecha,H.salidaEscuela,H.llegadaEvento,H.salidaEvento,H.llegadaEscuela,S.nivelEscolar,S.nombreDirector,
 S.telefonoInstitucion,S.nombreResponsable,S.telefonoResponsable, S.nombreSolicitante,S.telefonoSolicitante, SH.alumnos,SH.alumnas,SH.acompMuj,SH.acompHom,
 A.descripcion, A.monto,S.fechaRegistro,U.nombres,S.estatus
FROM ap_solicitudes AS S
INNER JOIN ap_solicitudes_has_horarios AS SH ON SH.pkSolicitud=S.pkSolicitud
INNER JOIN ap_apoyos AS A ON A.pkApoyo=S.apoyos_pkApoyo
INNER JOIN ap_horarios_dias AS HD ON HD.pkHorarioDia=SH.pkHorarioDia
INNER JOIN ap_horarios AS H ON H.pkHorario=HD.pkHorario
INNER JOIN ap_instituciones_has_solicitudes AS IHI ON IHI.solicitudes_pkSolicitud=S.pkSolicitud
INNER JOIN ap_instituciones AS I ON I.pkInstitucion=IHI.instituciones_pkInstitucion
INNER JOIN ap_dias AS D ON D.pkDia=HD.pkDias
INNER JOIN usuarios AS U ON U.id=S.usuarios_pkUsuario
WHERE D.ferias_pkFeria='.$id.' ORDER BY D.fecha ASC, H.llegadaEvento ASC');
        
        $dias=new ApDias();
        $this->diasFeria=$dias->getDiasFeria($id);
        
    }

}

?>
