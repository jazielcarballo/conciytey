<?php

/**
 * Backend - KumbiaPHP Backend
 * PHP version 5
 * LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * ERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package Controller
 * @license http://www.gnu.org/licenses/agpl.txt GNU AFFERO GENERAL PUBLIC LICENSE version 3.
 * @author Manuel José Aguirre Garcia <programador.manuel@gmail.com>
 */
class RegistroController extends AppController {

	public function before_filter(){
		if (!Config::get('config.application.registro')){
			return View::notFound();
		}
	}

    public function index() {
        View::template('aplicacion/frontend_bootstrap');
        if (Input::hasPost('registro')) {
            if (Load::model('usuarios', Input::post('registro'))->registrar()){
				Flash::valid("Exito");
			}else{
				Flash::error("Problemas");			
			}
        }
    }

    public function activar($id_usuario, $hash) {
        $usuario = Load::model('usuarios');
        if ($usuario->activarCuenta($id_usuario, $hash)) {
            $this->user = $usuario;
        } else {
            View::response('error');
        }
    }

}
