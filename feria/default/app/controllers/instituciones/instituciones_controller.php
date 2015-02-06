<?php

class institucionesController extends AdminController {

    //accion con la vista del input autocomplete
    public function index() {
        
    }

    //accion que busca en los estados y devuelve el json con los datos

    public function getInstitucion() {
        $id = Input::post('id');
        View::template(NULL);
        View::select(NULL);
        if (Input::isAjax()) { //solo devolvemos los estados si se accede desde ajax 
            //   $busqueda = Input::post('busqueda');
            $inst = Load::model('ap_instituciones')->find("pkInstitucion='$id'");
            die(json_encode($inst)); // solo devolvemos los datos, sin template ni vista
            //json_encode nos devolverá el array en formato json ["aragua","carabobo","..."]
        }
    }

    public function getTodasNombre() {

        $nombre = Input::post('query');

        View::template(NULL);
        View::select(NULL);
        if (Input::isAjax()) { //solo devolvemos los estados si se accede desde ajax 
            //   $busqueda = Input::post('busqueda');
            $inst = Load::model('ap_instituciones')->find("columns:  pkInstitucion,claveEscuela,nombreInstitucion,nivelEscolar,domicilio,turno", "nombreInstitucion like '%{$nombre}%'");

            $array = array();

            foreach ($inst as $d) {

                $array[] = array(
                "pkInstitucion" => $d["pkInstitucion"],
                "nombreInstitucion" => $d["nombreInstitucion"]." (".$d["turno"].") <br><sub style='color:#666;'>".$d["domicilio"]."</sub>"
                );
            }


            die(json_encode($array)); // solo devolvemos los datos, sin template ni vista
            //json_encode nos devolverá el array en formato json ["aragua","carabobo","..."]
        }
    }

}

?>
