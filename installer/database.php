<?php
/**
 * database.php is part of Marifa.
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
 * @package		Marifa\Installer
 */
defined('APP_BASE') || die('No direct access allowed.');

/**
 * Listado de consultas a ejecutar para instalar el sistema.
 */
$consultas = array();

/**
 * El formato de las consultas es:
 * array('NOMBRE_DE_LA_TABLA', array(LISTADO_DE_CONSULTAS));
 * Donde NOMBRE_DE_LA_TABLA es una descripción a mostrar en la vista para informar al usuario.
 * LISTADO_DE_CONSULTAS son un listado de arreglos. Cada elemento es una consulta que se ejecutan en una transacción si se permite.
 * Cada consulta tiene el formato: array('tipo', 'consulta', 'parametros', 'verificar').
 * tipo puede ser: INSERT, DELETE, UPDATE, QUERY, ALTER
 * parametros una lista de parametros a inyectar en la consulta.
 * verificar, arreglo con claves a utilizar para verificar si hay que implementarlo.
 *	  Posibles valores de verificar:
 *        error_no: Si el número de error coincide, se toma como correcta.
 */

/**
 * Categorias con sus valores.
 */
$consultas[] = array(
	'Tabla de categorias',
	array(
		array('ALTER', 'CREATE TABLE `categoria` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`nombre` varchar(50) NOT NULL,
				`seo` varchar(50) NOT NULL,
				`imagen` varchar(32) NOT NULL DEFAULT \'\',
				UNIQUE INDEX `seo` (`seo`),
				PRIMARY KEY (`id`)
			);', NULL, array('error_no' => 1050)
		),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Animaciones', 'animaciones', 'flash.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Apuntes y Monografías', 'Apuntes-y-Monografias', 'report.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Arte', 'Arte', 'palette.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Autos y Motos', 'autosymotos', 'car.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Celulares', 'celulares', 'phone.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Ciencia y Educación', 'Ciencia-y-Educacion', 'lab.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Comics', 'comics', 'comic.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Deportes', 'deportes', 'sport.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Downloads', 'downloads', 'disk.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('E-books y Tutoriales', 'ebooksytutoriales', 'ebook.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Ecología', 'Ecologia', 'nature.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Economía y Negocios', 'Economia-y-Negocios', 'economy.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Femme', 'femme', 'female.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Hazlo tu mismo', 'hazlotumismo', 'escuadra.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Humor', 'humor', 'humor.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Imágenes', 'Imagenes', 'photo.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Info', 'info', 'book.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Juegos', 'juegos', 'controller.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Links', 'links', 'link.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Linux', 'linux', 'tux.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Mac', 'mac', 'mac.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Manga y Anime', 'mangayanime', 'manga.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Mascotas', 'mascotas', 'pet.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Música', 'Musica', 'music.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Noticias', 'noticias', 'newspaper.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Off Topic', 'offtopic', 'comments.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Recetas y Cocina', 'recetasycocina', 'cake.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Salud y Bienestar', 'saludybienestar', 'heart.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Solidaridad', 'solidaridad', 'salva.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Prueba', 'prueba', 'tscript.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Turismo', 'turismo', 'brujula.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('TV, Peliculas y series', 'tvpeliculasyseries', 'tv.png'), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO categoria (nombre, seo, imagen) VALUES (?, ?, ?)', array('Videos On-line', 'videosonline', 'film.png'), array('error_no' => 1062))
	)
);

// Tabla de configuraciones.
$consultas[] = array(
	'Tabla de configuraciones',
	array(
		array('ALTER', 'CREATE TABLE `configuracion` (
				`clave` varchar(100) NOT NULL,
				`valor` mediumtext,
				`defecto` mediumtext,
				PRIMARY KEY (`clave`)
			);', NULL, array('error_no' => 1050)
		),
		array('INSERT', 'INSERT INTO configuracion (clave, valor, defecto) VALUES (?, ?, ?)', array('registro', 1, 1), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO configuracion (clave, valor, defecto) VALUES (?, ?, ?)', array('activacion_usuario', 2, 2), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO configuracion (clave, valor, defecto) VALUES (?, ?, ?)', array('elementos_pagina', 20, 20), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO configuracion (clave, valor, defecto) VALUES (?, ?, ?)', array('ip_mantenimiento', serialize(array()), serialize(array())), array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO configuracion (clave, valor, defecto) VALUES (?, ?, ?)', array('rango_defecto', serialize(1), serialize(1)), array('error_no' => 1062))
	)
);

// Tabla de fotos.
$consultas[] = array(
	'Tabla de fotos',
	array(
		array('ALTER', 'CREATE TABLE `foto` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`usuario_id` int(11) NOT NULL,
				`creacion` datetime NOT NULL,
				`titulo` varchar(200) NOT NULL,
				`descripcion` mediumtext NOT NULL,
				`url` varchar(300) DEFAULT NULL,
				`estado` int(11) NOT NULL DEFAULT 0,
				`ultima_visita` datetime DEFAULT NULL,
				`visitas` int(11) DEFAULT NULL,
				`categoria_id` int(11) DEFAULT NULL,
				`comentar` bit(1) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de comentarios en fotos.
$consultas[] = array(
	'Tabla de comentario en fotos',
	array(
		array('ALTER', 'CREATE TABLE `foto_comentario` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`foto_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				`comentario` mediumtext NOT NULL,
				`fecha` datetime NOT NULL,
				`estado` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `foto_id` (`foto_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de denuncias a fotos.
$consultas[] = array(
	'Tabla de denuncias a fotos',
	array(
		array('ALTER', 'CREATE TABLE `foto_denuncia` (
				`id` INTEGER NOT NULL AUTO_INCREMENT,
				`foto_id` INTEGER NOT NULL,
				`usuario_id` INTEGER NOT NULL,
				`motivo` INTEGER NOT NULL,
				`comentario` MEDIUMTEXT NULL DEFAULT NULL,
				`fecha` DATETIME NOT NULL,
				`estado` INTEGER NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de favoritos de fotos.
$consultas[] = array(
	'Tabla de favoritos de fotos',
	array(
		array('ALTER', 'CREATE TABLE `foto_favorito` (
				`foto_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				PRIMARY KEY (`foto_id`,`usuario_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de votos a fotos.
$consultas[] = array(
	'Tabla de votos a fotos',
	array(
		array('ALTER', 'CREATE TABLE `foto_voto` (
				`foto_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				`cantidad` int(11) NOT NULL,
				PRIMARY KEY (`foto_id`,`usuario_id`,`cantidad`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de mensajes entre usuarios a fotos.
$consultas[] = array(
	'Tabla de mensajeria',
	array(
		array('ALTER', 'CREATE TABLE `mensaje` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`emisor_id` int(11) NOT NULL,
				`receptor_id` int(11) NOT NULL,
				`estado` int(11) NOT NULL DEFAULT 0,
				`asunto` varchar(200) NOT NULL,
				`contenido` mediumtext NOT NULL,
				`fecha` datetime NOT NULL,
				`padre_id` int(11) DEFAULT NULL,
				PRIMARY KEY (`id`),
				KEY `emisor_id` (`emisor_id`),
				KEY `receptor_id` (`receptor_id`),
				KEY `padre_id` (`padre_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de noticias.
$consultas[] = array(
	'Tabla de noticias',
	array(
		array('ALTER', 'CREATE TABLE `noticia` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`usuario_id` int(11) NOT NULL,
				`contenido` mediumtext NOT NULL,
				`fecha` datetime NOT NULL,
				`estado` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de posts.
$consultas[] = array(
	'Tabla de posts',
	array(
		array('ALTER', 'CREATE TABLE `post` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`usuario_id` int(11) NOT NULL,
				`categoria_id` int(11) NOT NULL,
				`titulo` varchar(200) NOT NULL,
				`contenido` mediumtext NOT NULL,
				`fecha` datetime NOT NULL,
				`vistas` int(11) NOT NULL DEFAULT 0,
				`privado` bit(1) NOT NULL DEFAULT b\'0\',
				`sponsored` bit(1) NOT NULL DEFAULT b\'0\',
				`sticky` bit(1) NOT NULL DEFAULT b\'0\',
				`estado` int(11) NOT NULL DEFAULT 0,
				`tags` varchar(250) DEFAULT NULL,
				`comentar` bit(1) NOT NULL DEFAULT b\'1\',
				PRIMARY KEY (`id`),
				KEY `usuario_id` (`usuario_id`),
				KEY `post_categoria_id` (`categoria_id`),
				FULLTEXT KEY `busqueda` (`titulo`,`contenido`,`tags`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de comentarios en posts.
$consultas[] = array(
	'Tabla de comentarios en posts',
	array(
		array('ALTER', 'CREATE TABLE `post_comentario` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`post_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				`fecha` datetime NOT NULL,
				`contenido` mediumtext NOT NULL,
				`estado` int(11) NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`),
				KEY `post_id` (`post_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de votos a comentarios en posts.
$consultas[] = array(
	'Tabla de votos a comentarios en posts',
	array(
		array('ALTER', 'CREATE TABLE `post_comentario_voto` (
				`post_comentario_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				`cantidad` int(11) NOT NULL DEFAULT 1,
				PRIMARY KEY (`post_comentario_id`,`usuario_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de posts compartidos.
$consultas[] = array(
	'Tabla de posts compartidos',
	array(
		array('ALTER', 'CREATE TABLE `post_compartido` (
				`post_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				PRIMARY KEY (`post_id`,`usuario_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de denuncias a posts.
$consultas[] = array(
	'Tabla de denuncias a posts',
	array(
		array('ALTER', 'CREATE TABLE `post_denuncia` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`post_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				`motivo` int(11) NOT NULL,
				`comentario` mediumtext,
				`fecha` datetime NOT NULL,
				`estado` int(11) NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`),
				KEY `post_id` (`post_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de favoritos a posts.
$consultas[] = array(
	'Tabla de favoritos a posts',
	array(
		array('ALTER', 'CREATE TABLE  `post_favorito` (
				`post_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				PRIMARY KEY (`post_id`,`usuario_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de moderaciones de posts.
$consultas[] = array(
	'Tabla de moderaciones de posts',
	array(
		array('ALTER', 'CREATE TABLE  `post_moderado` (
				`post_id` int(11) NOT NULL DEFAULT 0,
				`usuario_id` int(11) NOT NULL,
				`tipo` int(11) NOT NULL,
				`padre_id` int(11) DEFAULT NULL,
				`razon` text,
				PRIMARY KEY (`post_id`),
				KEY `usuario_id` (`usuario_id`),
				KEY `padre_id` (`padre_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de puntos en posts.
$consultas[] = array(
	'Tabla de puntos en posts',
	array(
		array('ALTER', 'CREATE TABLE  `post_punto` (
				`post_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				`cantidad` int(11) NOT NULL DEFAULT 1,
				PRIMARY KEY (`post_id`,`usuario_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de seguidores de posts.
$consultas[] = array(
	'Tabla de seguidores de posts',
	array(
		array('ALTER', 'CREATE TABLE  `post_seguidor` (
				`post_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				PRIMARY KEY (`post_id`,`usuario_id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de etiquetas de posts.
$consultas[] = array(
	'Tabla de etiquetas de posts',
	array(
		array('ALTER', 'CREATE TABLE  `post_tag` (
				`post_id` int(11) NOT NULL,
				`nombre` varchar(50) NOT NULL,
				PRIMARY KEY (`post_id`,`nombre`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de sessiones de usuarios.
$consultas[] = array(
	'Tabla de sessiones de usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `session` (
				`id` varchar(32) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				`ip` int(11) NOT NULL,
				`expira` datetime NOT NULL,
				PRIMARY KEY (`id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de sucesos.
$consultas[] = array(
	'Tabla de sucesos',
	array(
		array('ALTER', 'CREATE TABLE  `suceso` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`usuario_id` int(11) NOT NULL,
				`objeto_id` int(11) NOT NULL,
				`objeto_id1` int(11) DEFAULT NULL,
				`objeto_id2` int(11) DEFAULT NULL,
				`tipo` varchar(50) NOT NULL,
				`notificar` BIT NOT NULL DEFAULT 0,
				`visto` BIT NOT NULL DEFAULT 0,
				`fecha` datetime NOT NULL,
				PRIMARY KEY (`id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de usuarios.
$consultas[] = array(
	'Tabla de usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`nick` varchar(16) NOT NULL,
				`password` varchar(64) NOT NULL,
				`email` varchar(50) NOT NULL,
				`rango` int(11) NOT NULL DEFAULT 1,
				`puntos` int(11) NOT NULL DEFAULT 10,
				`puntos_disponibles` int(11) NOT NULL DEFAULT 10,
				`registro` datetime NOT NULL,
				`lastlogin` datetime NOT NULL,
				`lastactive` datetime NOT NULL,
				`lastip` int(11) NOT NULL,
				`estado` int(11) NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`),
				KEY `rango` (`rango`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de avisos a usuarios.
$consultas[] = array(
	'Tabla de avisos a usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_aviso` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`usuario_id` int(11) NOT NULL,
				`moderador_id` int(11) NOT NULL,
				`asunto` varchar(50) NOT NULL,
				`contenido` mediumtext NOT NULL,
				`fecha` datetime NOT NULL,
				`estado` int(11) NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`),
				KEY `usuario_id` (`usuario_id`),
				KEY `moderador_id` (`moderador_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de usuarios baneados.
$consultas[] = array(
	'Tabla de usuarios baneados',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_baneo` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`usuario_id` int(11) NOT NULL,
				`moderador_id` int(11) NOT NULL,
				`tipo` int(11) NOT NULL,
				`razon` mediumtext NOT NULL,
				`fecha` datetime NOT NULL,
				PRIMARY KEY (`id`),
				KEY `usuario_id` (`usuario_id`),
				KEY `moderador_id` (`moderador_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de bloqueos entre usuarios.
$consultas[] = array(
	'Tabla de bloqueos entre usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_bloqueo` (
				`usuario_id` int(11) NOT NULL,
				`bloqueado_id` int(11) NOT NULL,
				PRIMARY KEY (`usuario_id`,`bloqueado_id`),
				KEY `bloqueado_id` (`bloqueado_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de denuncias a usuarios.
$consultas[] = array(
	'Tabla de denuncias a usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_denuncia` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`denunciado_id` int(11) NOT NULL,
				`usuario_id` int(11) NOT NULL,
				`motivo` int(11) NOT NULL,
				`comentario` mediumtext,
				`fecha` datetime NOT NULL,
				`estado` int(11) NOT NULL DEFAULT 0,
				PRIMARY KEY (`id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);




// Tabla de nick's del usuario.
$consultas[] = array(
	'Tabla de nick\'s del usuario',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_nick` (
				`usuario_id` int(11) NOT NULL,
				`nick` varchar(16) NOT NULL,
				`fecha` datetime NOT NULL,
				PRIMARY KEY (`usuario_id`,`nick`,`fecha`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de campos del perfil del usuario.
$consultas[] = array(
	'Tabla de campos del perfil del usuario',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_perfil` (
				`usuario_id` int(11) NOT NULL,
				`campo` varchar(50) NOT NULL,
				`valor` mediumtext,
				PRIMARY KEY (`usuario_id`,`campo`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de rangos de usuarios.
//TODO: agregar más rangos por defecto.
$consultas[] = array(
	'Tabla de rangos de usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_rango` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`nombre` varchar(32) NOT NULL,
				`color` int(11) NOT NULL,
				`imagen` varchar(50) NOT NULL,
				`orden` int(11) NOT NULL DEFAULT 1,
				PRIMARY KEY (`id`),
				UNIQUE KEY `orden` (`orden`)
			);', NULL, array('error_no' => 1050)
		),
		array('INSERT', 'INSERT INTO usuario_rango (id, nombre, color, imagen) VALUES (1, \'administrador\', 10168064, \'Admin2.png\')', NULL, array('error_no' => 1062)),
	)
);

// Tabla de permisos de rangos.
$consultas[] = array(
	'Tabla de permisos de rangos',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_rango_permiso` (
				`rango_id` int(11) NOT NULL,
				`permiso` int(11) NOT NULL,
				PRIMARY KEY (`rango_id`,`permiso`)
			);', NULL, array('error_no' => 1050)
		),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 0)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 1)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 2)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 3)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 4)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 5)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 20)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 21)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 22)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 23)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 24)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 25)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 26)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 27)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 28)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 40)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 41)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 42)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 43)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 44)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 45)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 46)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 47)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 60)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 61)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 62)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 63)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 64)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 65)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 66)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 80)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 81)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 82)', NULL, array('error_no' => 1062)),
		array('INSERT', 'INSERT INTO usuario_rango_permiso (rango_id, permiso) VALUES (1, 83)', NULL, array('error_no' => 1062))
	)
);

// Tabla de recuperación de claves de usuarios.
$consultas[] = array(
	'Tabla de recuperación de claves de usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_recuperacion` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`usuario_id` int(11) NOT NULL,
				`email` varchar(50) NOT NULL,
				`hash` varchar(32) NOT NULL,
				`fecha` datetime NOT NULL,
				`tipo` int(11) NOT NULL,
				PRIMARY KEY (`id`),
				KEY `usuario_id` (`usuario_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de seguidores de usuarios.
$consultas[] = array(
	'Tabla de seguidores de usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_seguidor` (
				`usuario_id` int(11) NOT NULL,
				`seguidor_id` int(11) NOT NULL,
				`fecha` datetime NOT NULL,
				PRIMARY KEY (`usuario_id`,`seguidor_id`),
				KEY `seguidor_id` (`seguidor_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de suspensiones de usuarios.
$consultas[] = array(
	'Tabla de suspensiones de usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_suspension` (
				`id` int(11) NOT NULL AUTO_INCREMENT,
				`usuario_id` int(11) NOT NULL,
				`moderador_id` int(11) NOT NULL,
				`motivo` mediumtext NOT NULL,
				`inicio` datetime NOT NULL,
				`fin` datetime NOT NULL,
				PRIMARY KEY (`id`),
				UNIQUE KEY `usuario_id` (`usuario_id`),
				KEY `moderador_id` (`moderador_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

// Tabla de visitas a los perfiles del usuarios.
$consultas[] = array(
	'Tabla de visitas a los perfiles del usuarios',
	array(
		array('ALTER', 'CREATE TABLE  `usuario_visita` (
				`usuario_id` int(11) NOT NULL,
				`visitado_id` int(11) NOT NULL,
				`fecha` datetime NOT NULL,
				PRIMARY KEY (`usuario_id`,`visitado_id`,`fecha`),
				KEY `visitado_id` (`visitado_id`)
			);', NULL, array('error_no' => 1050)
		)
	)
);

return $consultas;