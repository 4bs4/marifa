<?php
/**
 * post.php is part of Marifa.
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
 * Controlador de la portada.
 *
 * @since      Versión 0.1
 * @package    Marifa\Base
 * @subpackage Controller
 */
class Base_Controller_Post extends Controller {

	/**
	 * Información de un post.
	 * @param int $post ID del post a visualizar.
	 */
	public function action_index($post)
	{
		// Convertimos el post a ID.
		$post = (int) $post;

		// Cargamos el post.
		$model_post = new Model_Post($post);

		// Verificamos exista.
		if ( ! is_array($model_post->as_array()))
		{
			Request::redirect('/');
		}

		if ($model_post->as_object()->privado && ! Usuario::is_login())
		{
			// Asignamos el título.
			$this->template->assign('title', 'Post privado');

			$view = View::factory('post/privado');
			$view->assign('post', $model_post->as_array());
		}
		else
		{
			// Asignamos el título.
			$this->template->assign('title', $model_post->as_object()->titulo);

			// Cargamos la vista.
			$view = View::factory('post/index');

			if (Usuario::usuario()->id != $model_post->as_object()->usuario_id)
			{
				$model_post->agregar_vista();
			}

			// Mi id.
			$view->assign('me', Usuario::usuario()->id);

			// Información del usuario dueño del post.
			$u_data = $model_post->usuario()->as_array();
			$u_data['seguidores'] = $model_post->usuario()->cantidad_seguidores();
			$u_data['posts'] = $model_post->usuario()->cantidad_posts();
			$u_data['comentarios'] = $model_post->usuario()->cantidad_comentarios();
			$u_data['puntos'] = $model_post->usuario()->cantidad_puntos();
			$view->assign('usuario', $u_data);
			unset($u_data);

			// Información del post.
			$pst = $model_post->as_array();
			$pst['seguidores'] = $model_post->cantidad_seguidores();
			$pst['puntos'] = $model_post->puntos();
			$pst['favoritos'] = $model_post->cantidad_favoritos();
			$view->assign('post', $pst);
			unset($pst);

			// Verifico permisos para acciones extendidas.
			$view->assign('modificar_sticky', Usuario::permiso(Model_Usuario_Rango::PERMISO_FIJAR_POSTS));
			$view->assign('modificar_patrocinado', Usuario::permiso(Model_Usuario_Rango::PERMISO_ADMINISTRADOR));
			$view->assign('modificar_borrar', Usuario::permiso(Model_Usuario_Rango::PERMISO_ELIMINAR_POSTS));

			if ($model_post->as_object()->usuario_id == Usuario::usuario()->id)
			{
				$view->assign('es_favorito', TRUE);
				$view->assign('sigo_post', TRUE);
				$view->assign('puntuacion', FALSE);
			}
			else
			{
				$view->assign('es_favorito', $model_post->es_favorito(Usuario::usuario()->id));
				$view->assign('sigo_post', $model_post->es_seguidor(Usuario::usuario()->id));
				if ( ! Usuario::permiso(Model_Usuario_Rango::PERMISO_PUNTUAR_POST) || $model_post->dio_puntos(Usuario::usuario()->id))
				{
					$view->assign('puntuacion', FALSE);
				}
				else
				{
					// Obtenemos puntos disponibles.
					$m_user = Usuario::usuario();
					$p_d = $m_user->puntos_disponibles;

					$p_arr = array();
					for ($i = 1; $i <= $p_d; $i++)
					{
						$p_arr[] = $i;
					}

					$view->assign('puntuacion', $p_arr);
					unset($m_user, $p_d, $p_arr);
				}
			}

			// Categoria del post.
			$view->assign('categoria', $model_post->categoria()->as_array());

			// Etiquetas.
			$view->assign('etiquetas', $model_post->etiquetas());

			// Comentarios del post.
			$cmts = $model_post->comentarios(NULL);
			$l_cmt = array();
			foreach ($cmts as $cmt)
			{
				$cl_cmt = $cmt->as_array();
				$cl_cmt['contenido_raw'] = $cl_cmt['contenido'];
				$cl_cmt['contenido'] = Decoda::procesar($cl_cmt['contenido']);
				if ($cl_cmt['usuario_id'] == Usuario::usuario()->id)
				{
					$cl_cmt['vote'] = TRUE;
				}
				else
				{
					$cl_cmt['vote'] = $cmt->ya_voto(Usuario::usuario()->id);
				}
				$cl_cmt['votos'] = $cmt->cantidad_votos();
				$cl_cmt['usuario'] = $cmt->usuario()->as_array();
				$l_cmt[] = $cl_cmt;
			}
			$view->assign('comentarios', $l_cmt);
			unset($l_cmt, $cmts);

			$view->assign('comentario_content', isset($_POST['comentario']) ? $_POST['comentario'] : NULL);
			$view->assign('comentario_error', Session::get_flash('post_comentario_error'));
			$view->assign('comentario_success', Session::get_flash('post_comentario_success'));
		}


		// Menu.
		$this->template->assign('master_bar', parent::base_menu('posts'));
		$this->template->assign('top_bar', Controller_Home::submenu('index'));


		// Asignamos la vista.
		$this->template->assign('contenido', $view->parse());
	}

	/**
	 * Agregamos una denuncia a un post.
	 * @param int $post
	 */
	public function action_denunciar($post)
	{
		// Convertimos el post a ID.
		$post = (int) $post;

		// Cargamos el post.
		$model_post = new Model_Post($post);

		// Verificamos exista.
		if ( ! is_array($model_post->as_array()))
		{
			Request::redirect('/');
		}

		// Verificamos que no sea autor.
		if ($model_post->usuario_id == Usuario::usuario()->id)
		{
			Session::set('post_comentario_error', 'No puedes denunciar tu propio post.');
			Request::redirect('/post/index/'.$post);
		}

		// Asignamos el título.
		$this->template->assign('title', 'Denunciar post');

		// Cargamos la vista.
		$view = View::factory('post/denunciar');

		$view->assign('post', $model_post->id);

		// Elementos por defecto.
		$view->assign('motivo', '');
		$view->assign('comentario', '');
		$view->assign('error_motivo', FALSE);
		$view->assign('error_comentario', FALSE);

		if (Request::method() == 'POST')
		{
			// Seteamos sin error.
			$error = FALSE;

			// Obtenemos los campos.
			$motivo = isset($_POST['motivo']) ? (int) $_POST['motivo'] : NULL;
			$comentario = isset($_POST['comentario']) ? preg_replace('/\s+/', '', trim($_POST['comentario'])) : NULL;

			// Valores para cambios.
			$view->assign('motivo', $motivo);
			$view->assign('comentario', $comentario);

			// Verifico el tipo.
			if ( ! in_array($motivo, array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12)))
			{
				$error = TRUE;
				$view->assign('error_motivo', 'No ha seleccionado un motivo válido.');
			}

			// Verifico la razón si corresponde.
			if ($motivo === 12)
			{
				if ( ! isset($motivo{10}) || isset($motivo{400}))
				{
					$error = TRUE;
					$view->assign('error_contenido', 'La descripción de la denuncia debe tener entre 10 y 400 caracteres.');
				}
			}
			else
			{
				if (isset($motivo{400}))
				{
					$error = TRUE;
					$view->assign('error_contenido', 'La descripción de la denuncia debe tener entre 10 y 400 caracteres.');
				}
				$comentario = NULL;
			}

			if ( ! $error)
			{
				// Creo la denuncia.
				$model_post->denunciar(Usuario::usuario()->id, $motivo, $comentario);

				//TODO: crear suceso.

				// Seteamos mensaje flash y volvemos.
				Session::set('post_correcto', 'Denuncia enviada correctamente.');
				Request::redirect('/post/index/'.$model_post->id);
			}
		}

		// Menu.
		$this->template->assign('master_bar', parent::base_menu('posts'));
		$this->template->assign('top_bar', Controller_Home::submenu());

		// Asignamos la vista.
		$this->template->assign('contenido', $view->parse());
	}

	/**
	 * Agregamos un comentario a un post.
	 * @param int $post ID del post donde colocar el comentario.
	 */
	public function action_comentar($post)
	{
		// Verificamos el método de envio.
		if (Request::method() != 'POST')
		{
			Request::redirect('/post/index/'.$post);
		}

		// Convertimos el post a ID.
		$post = (int) $post;

		// Cargamos el post.
		$model_post = new Model_Post($post);

		// Verificamos exista.
		if ( ! is_array($model_post->as_array()))
		{
			Request::redirect('/');
		}

		// Verifico permisos.
		//TODO: ver de poder cerrar comentarios.
		if ( ! Usuario::permiso(Model_Usuario_Rango::PERMISO_COMENTAR_POST))
		{
			Request::redirect('/post/index/'.$post);
		}

		// Obtenemos el comentario.
		$comentario = isset($_POST['comentario']) ? $_POST['comentario'] : NULL;

		// Verificamos el formato.
		$comentario_clean = preg_replace('/\[.*\]/', '', $comentario);
		if ( ! isset($comentario_clean{20}) || isset($comentario{400}))
		{
			Session::set('post_comentario_error', 'El comentario debe tener entre 20 y 400 caracteres.');

			// Evitamos la salida de la vista actual.
			$this->template = NULL;

			Dispatcher::call('/post/index/'.$post, TRUE);
		}
		else
		{
			// Transformamos entidades HTML.
			$comentario = htmlentities($comentario, ENT_NOQUOTES, 'UTF-8');

			// Insertamos el comentario.
			$id = $model_post->comentar(Usuario::usuario()->id, $comentario);

			if ($id)
			{
				// Agregamos los sucesos.
				$model_suceso = new Model_Suceso;
				$model_suceso->crear(array(Usuario::usuario()->id, $model_post->usuario_id), 'comentario_post', $id);

				Session::set('post_comentario_success', 'El comentario se ha realizado correctamente.');

				Request::redirect('/post/index/'.$post);
			}
			else
			{
				Session::set('post_comentario_error', 'Se produjo un error al colocar el comentario. Reintente.');

				// Evitamos la salida de la vista actual.
				$this->template = NULL;

				Dispatcher::call('/post/index/'.$post, TRUE);
			}
		}
	}

	/**
	 * Agregamos el post como favorito.
	 * @param int $post ID del post que se toma como favorito.
	 */
	public function action_favorito($post)
	{
		// Convertimos el post a ID.
		$post = (int) $post;

		// Cargamos el post.
		$model_post = new Model_Post($post);

		// Verificamos exista.
		if ( ! is_array($model_post->as_array()))
		{
			Request::redirect('/');
		}

		// Verifica autor.
		if ($model_post->usuario_id != Usuario::usuario()->id)
		{
			// Verificamos el voto.
			if ( ! $model_post->es_favorito(Usuario::usuario()->id))
			{
				$model_post->favorito(Usuario::usuario()->id);
				$model_suceso = new Model_Suceso;
				$model_suceso->crear(
						array(
							Usuario::usuario()->id,
							$model_post->usuario_id
						),
						'favorito_post',
						Usuario::usuario()->id,
						$post
					);
			}
		}
		Request::redirect('/post/index/'.$post);
	}

	/**
	 * Votar un comentario.
	 * @param int $comentario ID del comentario a votar.
	 * @param int $voto 1 para positivo, -1 para negativo.
	 */
	public function action_voto_comentario($comentario, $voto)
	{
		// Obtenemos el voto.
		$voto = $voto == 1;

		// Cargamos el comentario.
		$model_comentario = new Model_Post_Comentario( (int) $comentario);

		// Verificamos existencia.
		if ( ! is_array($model_comentario->as_array()))
		{
			Request::redirect('/');
		}

		// Verifico permisos.
		if ( ! Usuario::permiso(Model_Usuario_Rango::PERMISO_VOTAR_COMENTARIO_POST))
		{
			Request::redirect('/post/index/'.$model_comentario->post_id);
		}

		// Cargamos usuario.
		$usuario_id = Usuario::usuario()->id;

		// Verificamos autor.
		if ($model_comentario->usuario_id != $usuario_id)
		{
			// Verificamos puntuación.
			if ( ! $model_comentario->ya_voto($usuario_id))
			{
				$model_comentario->votar($usuario_id, $voto);
				$model_suceso = new Model_Suceso;
				$model_suceso->crear(
						array(
							$usuario_id,
							$model_comentario->usuario_id,
							$model_comentario->post()->usuario_id
						),
						'voto_comentario_post',
						$usuario_id,
						(int) $comentario
					);
			}
		}
		Request::redirect('/post/index/'.$model_comentario->post_id);
	}

	/**
	 * Ocultamos un comentario.
	 * @param int $comentario ID del comentario a ocultar.
	 */
	public function action_ocultar_comentario($comentario)
	{
		// Cargamos el comentario.
		$model_comentario = new Model_Post_Comentario( (int) $comentario);

		// Verificamos existencia.
		if ( ! is_array($model_comentario->as_array()))
		{
			Request::redirect('/');
		}

		// Cargamos usuario.
		$usuario_id = Usuario::usuario()->id;

		// Verificamos autor y permisos.
		if (($model_comentario->usuario_id == $usuario_id && Usuario::permiso(Model_Usuario_Rango::PERMISO_ELIMINAR_COMENTARIO_PROPIO))
			|| Usuario::permiso(Model_Usuario_Rango::PERMISO_ELIMINAR_COMENTARIOS_POSTS)
			|| Usuario::permiso(Model_Usuario_Rango::PERMISO_ADMINISTRADOR)
			|| Usuario::permiso(Model_Usuario_Rango::PERMISO_MODERADOR)
			)
		{
			// Seteo el estado como borrado.
			if ( ! $model_comentario->estado !== Model_Post_Comentario::ESTADO_OCULTO)
			{
				$model_comentario->actualizar_estado(Model_Post_Comentario::ESTADO_OCULTO);

				//TODO: ejecutar sucesos.
				/**
				$model_suceso = new Model_Suceso;
				$model_suceso->crear(
						array(
							$usuario_id,
							$model_comentario->usuario_id,
							$model_comentario->post()->usuario_id
						),
						'voto_comentario_post',
						$usuario_id,
						(int) $comentario
					);*/
			}
		}
		else
		{
			Session::set('post_comentario_error', 'No tienes permiso para realizar esta acción.');
		}
		Request::redirect('/post/index/'.$model_comentario->post_id);
	}

	/**
	 * Nos convertimos en seguidores de un post.
	 * @param int $post ID del post a seguir.
	 */
	public function action_seguir_post($post)
	{
		// Convertimos el post a ID.
		$post = (int) $post;

		// Cargamos el post.
		$model_post = new Model_Post($post);

		// Verificamos exista.
		if ( ! is_array($model_post->as_array()))
		{
			Request::redirect('/');
		}

		// Cargamos usuario.
		$usuario_id = Usuario::usuario()->id;

		// Verifica autor.
		if ($model_post->usuario_id != $usuario_id)
		{
			// Verificamos el voto.
			if ( ! $model_post->es_seguidor($usuario_id))
			{
				$model_post->seguir($usuario_id);
				$model_suceso = new Model_Suceso;
				$model_suceso->crear(
						array(
							$usuario_id,
							$model_post->usuario_id
						),
						'seguir_post',
						$usuario_id,
						$post
					);
			}
		}
		Request::redirect('/post/index/'.$post);
	}

	/**
	 * Damos puntos a un post.
	 * @param int $post ID del post al cual darle puntos.
	 * @param int $cantidad Cantidad de puntos. Número entre 1 y 10.
	 */
	public function action_puntuar($post, $cantidad)
	{
		// Convertimos el post a ID.
		$post = (int) $post;

		// Validamos la cantidad.
		$cantidad = (int) $cantidad;

		if ($cantidad < 1 || $cantidad > 10)
		{
			Request::redirect('/');
		}

		// Cargamos el post.
		$model_post = new Model_Post($post);

		// Verificamos exista.
		if ( ! is_array($model_post->as_array()))
		{
			Request::redirect('/');
		}

		// Cargamos usuario.
		$usuario_id = Usuario::usuario()->id;

		// Verifica autor.
		if ($model_post->usuario_id != $usuario_id)
		{
			// Verifico permisos.
			if (Usuario::permiso(Model_Usuario_Rango::PERMISO_PUNTUAR_POST))
			{
				// Verificamos el voto.
				if ( ! $model_post->dio_puntos($usuario_id))
				{
					// Verificamos la cantidad de puntos.
					$model_usuario = new Model_Usuario($usuario_id);
					if ($model_usuario->puntos_disponibles >= $cantidad)
					{
						$model_post->dar_puntos($usuario_id, $cantidad);
						$model_suceso = new Model_Suceso;
						$model_suceso->crear(
								array(
									$usuario_id,
									$model_post->usuario_id
								),
								'punto_post',
								$usuario_id,
								$post
							);
					}
				}
			}
		}
		Request::redirect('/post/index/'.$post);
	}

	/**
	 * Creamos un nuevo post.
	 */
	public function action_nuevo()
	{
		// Verificamos usuario logueado.
		if ( ! Usuario::is_login())
		{
			Request::redirect('/usuario/login');
		}

		// Verifico los permisos.
		if ( ! Usuario::permiso(Model_Usuario_Rango::PERMISO_CREAR_POST))
		{
			//TODO: Mensaje de alerta.
			Request::redirect('/');
		}

		// Asignamos el título.
		$this->template->assign('title', 'Nuevo post');

		// Cargamos la vista.
		$view = View::factory('post/nuevo');

		// Elementos por defecto.
		foreach (array('titulo', 'contenido', 'categoria', 'privado', 'sponsored', 'sticky', 'error_titulo', 'error_contenido', 'error_categoria') as $k)
		{
			$view->assign($k, '');
		}

		// Listado de categorias.
		$model_categoria = new Model_Categoria;
		$view->assign('categorias', $model_categoria->lista());

		// Menu.
		$this->template->assign('master_bar', parent::base_menu('posts'));
		$this->template->assign('top_bar', Controller_Home::submenu('nuevo'));

		// Asignamos la vista.
		$this->template->assign('contenido', $view->parse());

		if (Request::method() == 'POST')
		{
			$error = FALSE;

			// Obtenemos los datos y seteamos valores.
			foreach (array('titulo', 'contenido', 'categoria') as $k)
			{
				$$k = isset($_POST[$k]) ? $_POST[$k] : '';
				$view->assign($k, $$k);
			}

			// Obtenemos los checkbox.
			foreach (array('privado', 'sponsored', 'sticky') as $k)
			{
				$$k = isset($_POST[$k]) ? ($_POST[$k] == 1) : FALSE;
				$view->assign($k, $$k);
			}

			// Verificamos el titulo.
			if ( ! preg_match('/^[a-zA-Z0-9áéíóú\-,\.:\s]{6,60}$/D', $titulo))
			{
				$view->assign('error_titulo', 'El formato del título no es correcto.');
				$error = TRUE;
			}

			// Verificamos el contenido.
			$contenido_clean = preg_replace('/\[.*\]/', '', $contenido);
			if ( ! isset($contenido_clean{20}) || isset($contenido{600}))
			{
				$view->assign('error_contenido', 'El contenido debe tener entre 20 y 600 caractéres.');
				$error = TRUE;
			}
			unset($contenido_clean);

			// Verificamos la categoria.
			$model_categoria = new Model_Categoria;
			if ( ! $model_categoria->existe_seo($categoria))
			{
				$view->assign('error_categoria', 'La categoría seleccionada es incorrecta.');
				$error = TRUE;
			}
			else
			{
				$model_categoria->load_by_seo($categoria);
				$categoria_id = $model_categoria->id;
			}
			unset($model_categoria);

			// Procedemos a crear el post.
			if ( ! $error)
			{
				// Evitamos XSS.
				$contenido = htmlentities($contenido, ENT_NOQUOTES, 'UTF-8');

				// Formateamos los campos.
				$titulo = trim(preg_replace('/\s+/', ' ', $titulo));

				// Verifico si es borrador.
				$borrador = isset($_POST['submit']) ? $_POST['submit'] == 'borrador' : FALSE;

				$model_post = new Model_Post;
				$post_id = $model_post->crear(Usuario::usuario()->id, $titulo, $contenido, $categoria_id, $privado, $sponsored, $sticky, NULL, $borrador);

				if ($post_id > 0)
				{
					Request::redirect('/post/index/'.$post_id);

					$model_suceso = new Model_Suceso;
					$model_suceso->crear(Usuario::usuario()->id, 'nuevo_post', $post_id);
				}
				else
				{
					$view->assign('error', 'Se produjo un error cuando se creaba el post. Reintente.');
				}
			}
		}

		// Menu.
		$this->template->assign('master_bar', parent::base_menu('posts'));
		$this->template->assign('top_bar', Controller_Home::submenu('nuevo'));

		// Asignamos la vista.
		$this->template->assign('contenido', $view->parse());
	}
}
