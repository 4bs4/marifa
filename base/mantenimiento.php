<?php
/**
 * matenimiento.php is part of Marifa.
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
 * @since		Versión 0.3
 * @filesource
 * @package		Marifa\Base
 */
defined('APP_BASE') || die('No direct access allowed.');

/**
 * Clase para el manejo del modo mantenimiento. Se encarga de administrar
 * cuando se encuentra activo y quienes son los que tienen permitido el acceso.
 *
 * @author     Ignacio Daniel Rostagno <ignaciorostagno@vijona.com.ar>
 * @since      Versión 0.3
 * @package    Marifa\Base
 */
class Base_Mantenimiento {

	/**
	 * Archivo utilizado para indicar el bloqueo.
	 * @var type
	 */
	protected $lock_file;

	/**
	 * Cargamos clase de bloqueo.
	 * @param string $lock_file Archivo donde guardar el bloqueo.
	 */
	public function __construct($lock_file = NULL)
	{
		if ($lock_file === NULL)
		{
			$lock_file = APP_BASE.DS.'lock.tmp';
		}
		$this->lock_file = $lock_file;
	}

	/**
	 * Verificamos si hay un bloqueo activo.
	 * @return bool
	 */
	public function is_locked()
	{
		return file_exists($this->lock_file) && is_file($this->lock_file);
	}

	/**
	 * Verificamos si el bloqueo aplica al IP provisto.
	 * @param string $ip
	 * @return bool
	 */
	public function is_locked_for($ip)
	{
		if ( ! $this->is_locked())
		{
			return FALSE;
		}

		// Cargamos los rangos.
		$range_list = file($this->lock_file);

		// Verificamos.
		foreach ($range_list as $range)
		{
			if ($ip == $range || IP::ip_in_range($ip, $range))
			{
				// Existe en el rango.
				return FALSE;
			}
		}

		// No existe en los rangos.
		return TRUE;
	}

	/**
	 * Realizamos el bloqueo, excluyendo el listado de IP's y/o rangos provisto.
	 * @param array $for Arreglo de IP's y/o rangos que tienen permitido el acceso.
	 * Es decir, no le dan importancia al bloqueo.
	 * @return bool
	 */
	public function lock($for = array())
	{
		// Generamos el listado de rangos.
		$range = implode(PHP_EOL, $for);

		// Guardamos la información
		return file_put_contents($this->lock_file, $range);
	}

	/**
	 * Desbloqueamos.
	 * @return bool
	 */
	public function unlock()
	{
		return @unlink($this->lock_file);
	}

}
