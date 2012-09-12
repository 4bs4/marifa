<fiv class="row fotos">
	<ul class="thumbnails">
		{loop="$fotos"}<li class="span4">
			<div class="thumbnail">
				<img alt="" src="http://placehold.it/360x236">
				<div class="caption">
					<h4>{$value.titulo} <small>{@por@} <a href="/perfil/index/{$value.usuario.nick}">{$value.usuario.nick}</a></small></h4>
					<p>{$value.descripcion|nl2br}</p>
					<p class="toolbar">
						<span class="btn-toolbar">
							<span class="btn-group"><a class="btn btn-primary" href="/foto/ver/{$value.id}">{@Ver@}</a></span>
							{if="!$value.favorito"}<span class="btn-group"><a class="btn btn-info" href="/foto/favorito/{$value.id}"><i class="icon-white icon-star"></i> {@Agregar a favoritos@}</a></span>{/if}
							{if="!$value.voto"}<span class="btn-group"><a class="btn btn-success" href="/foto/votar/{$value.id}/1"><i class="icon-white icon-thumbs-up"></i></a>
							<a class="btn btn-danger" href="/foto/votar/{$value.id}/-1"><i class="icon-white icon-thumbs-down"></i></a></span>{/if}
						</span>
						<span class="fecha pull-right">{function="$value.creacion->fuzzy()"}</span>
					</p>
				</div>
			</div>
		</li>{/loop}
	</ul>
</fiv>