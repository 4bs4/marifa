<?php
/**
 * favoritos.php is part of Marifa.
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
 * @subpackage  Controller
 */
defined('APP_BASE') || die('No direct access allowed.');

/**
 * Controlador para la gestión de los favoritos del usuario.
 *
 * @since      Versión 0.1
 * @package    Marifa\Base
 * @subpackage Controller
 */
class Base_Controller_Favoritos extends Controller {

	/**
	 * Constructor de la clase.
	 * Verificamos los permisos para acceder a la sección.
	 */
	public function __construct()
	{
		// Verifico que esté logueado.
		if ( ! Usuario::is_login())
		{
			$_SESSION['flash_error'] = 'Debes iniciar sessión para poder acceder a tus favoritos.';
			Request::redirect('/usuario/login');
		}
		parent::__construct();
	}

	/**
	 * Submenu.
	 * @param string $selected Elemento seleccionado.
	 */
	public static function submenu($selected = NULL)
	{
		$data = array();

		$data['posts'] = array('link' => '/favoritos', 'caption' => 'Posts', 'active' => $selected == 'posts', 'cantidad' => Usuario::usuario()->cantidad_favoritos_posts());
		$data['fotos'] = array('link' => '/favoritos/fotos', 'caption' => 'Fotos', 'active' => $selected == 'fotos', 'cantidad' => Usuario::usuario()->cantidad_favoritos_fotos());

		return $data;
	}

	/**
	 * Portada de los favoritos.
	 * @param int $pagina Número de página a mostrar.
	 */
	public function action_index($pagina)
	{
		// Cargamos la portada.
		$vista = View::factory('favoritos/posts');

		// Cantidad de elementos por pagina.
		$model_configuracion = new Model_Configuracion;
		$cantidad_por_pagina = $model_configuracion->get('elementos_pagina', 20);

		// Formato de la página.
		$pagina = ( (int) $pagina) > 0 ? ( (int) $pagina) : 1;

		// Cargamos el listado de favoritos.
		$favoritos = Usuario::usuario()->listado_posts_favoritos($pagina, $cantidad_por_pagina);

		// Verifivo que la página seleccionada sea válida.
		if (count($favoritos) == 0 && $pagina != 1)
		{
			Request::redirect('/favoritos/');
		}

		// Paginación.
		$paginador = new Paginator(Usuario::usuario()->cantidad_favoritos_posts(), $cantidad_por_pagina);
		$vista->assign('paginacion', $paginador->get_view($pagina, '/favoritos/index/%i'));
		unset($paginador);

		// Obtengo información de los favoritos.
		foreach ($favoritos as $k => $v)
		{
			$a = $v->as_array();
			$a['usuario'] = $v->usuario()->as_array();
			$a['categoria'] = $v->categoria()->as_array();

			$favoritos[$k] = $a;
		}

		// Seteo parámetros a la vista.
		$vista->assign('favoritos', $favoritos);
		unset($favoritos);

		// Seteo el menu.
		$this->template->assign('master_bar', parent::base_menu('inicio'));
		$this->template->assign('top_bar', self::submenu('posts'));

		// Asignamos la vista a la plantilla base.
		$this->template->assign('contenido', $vista->parse());
	}

	/**
	 * Portada de los favoritos.
	 * @param int $pagina Número de página a mostrar.
	 */
	public function action_fotos($pagina)
	{
		// Cargamos la portada.
		$vista = View::factory('favoritos/fotos');

		// Cantidad de elementos por pagina.
		$model_configuracion = new Model_Configuracion;
		$cantidad_por_pagina = $model_configuracion->get('elementos_pagina', 20);

		// Formato de la página.
		$pagina = ( (int) $pagina) > 0 ? ( (int) $pagina) : 1;

		// Cargamos el listado de favoritos.
		$favoritos = Usuario::usuario()->listado_fotos_favoritos($pagina, $cantidad_por_pagina);

		// Verifivo que la página seleccionada sea válida.
		if (count($favoritos) == 0 && $pagina != 1)
		{
			Request::redirect('/favoritos/fotos/');
		}

		// Paginación.
		$paginador = new Paginator(Usuario::usuario()->cantidad_favoritos_fotos(), $cantidad_por_pagina);
		$vista->assign('paginacion', $paginador->get_view($pagina, '/favoritos/fotos/%d'));
		unset($paginador);

		// Obtengo información de los favoritos.
		foreach ($favoritos as $k => $v)
		{
			$a = $v->as_array();
			$a['usuario'] = $v->usuario()->as_array();
			$a['categoria'] = $v->categoria()->as_array();

			$favoritos[$k] = $a;
		}

		// Seteo parámetros a la vista.
		$vista->assign('favoritos', $favoritos);
		unset($favoritos);

		// Seteo el menu.
		$this->template->assign('master_bar', parent::base_menu('inicio'));
		$this->template->assign('top_bar', self::submenu('fotos'));

		// Asignamos la vista a la plantilla base.
		$this->template->assign('contenido', $vista->parse());
	}

}
