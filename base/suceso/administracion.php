<?php
/**
 * administracion.php is part of Marifa.
 *
 * Marifa is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Marifa is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Marifa. If not, see <http://www.gnu.org/licenses/>.
 *
 * @license     http://www.gnu.org/licenses/gpl-3.0-standalone.html GNU Public License
 * @since		Versión 0.1
 * @filesource
 * @package		Marifa\Base
 * @subpackage  Model
 */
defined('APP_BASE') || die('No direct access allowed.');

/**
 * Clase para el parseo de los sucesos de la administración.
 *
 * @since      0.1
 * @package    Marifa\Base
 * @subpackage Model
 */
class Base_Suceso_Administracion extends Suceso {

	/**
	 * Obtenemos el listado de sucesos a procesar.
	 * @param int $usuario ID del usuario dueño de los sucesos.
	 * @param int $pagina Número de página a mostrar.
	 * @param int $cantidad Cantidad de elementos por página.
	 * @param string $class Clase para procesar. No debe ser pasado, solo es a fines de compatibilidad de herencias estáticas.
	 * @return array
	 */
	public static function obtener_listado($usuario, $pagina, $cantidad = 20, $class = __CLASS__)
	{
		// Obtenemos la lista de sucesos que puede procesar.
		$rc = new ReflectionClass(substr($class, 5));
		$ms = $rc->getMethods(ReflectionMethod::IS_STATIC);

		$methods = array();
		foreach ($ms as $method)
		{
			if (substr($method->name, 0, 7) == 'suceso_')
			{
				$methods[] = substr($method->name, 7);
			}
		}
		unset($rc, $ms);

		// Cargamos el listado de sucesos.
		$model_suceso = new Model_Suceso_Administracion;
		return $model_suceso->listado($usuario, $pagina, $cantidad, $methods);
	}

	/**
	 * Obtenemos los datos para visualizar un suceso.
	 * @param array|Model_Suceso $informacion Información de un suceso.
	 * @param string $class Clase para procesar. No debe ser pasado, solo es a fines de compatibilidad de herencias estáticas.
	 * @return array
	 */
	public static function procesar($informacion, $class = __CLASS__)
	{
		return parent::procesar($informacion, $class);
	}

}
