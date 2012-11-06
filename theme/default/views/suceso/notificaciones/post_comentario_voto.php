<div class="suceso{if=" ! $visto"} nuevo{/if}">
	<div class="icono hidden-phone">
		<i class="icon icon-comment"></i>
	</div>
	<div class="contenido">
		<a href="/perfil/index/{$suceso.usuario.nick}">{$suceso.usuario.nick}</a> {@ha votado@} {if="$suceso.voto"}<span class="badge badge-success">{@POSITIVAMENTE@}</span>{else}<span class="badge badge-danger">{@NEGATIVAMENTE@}</span>{/if} {@tu comentario en el post@} <a href="/post/index/{$suceso.post.id}">{$suceso.post.titulo}</a>.
	</div>
	<div class="fecha visible-desktop">
		{function="$fecha->fuzzy()"}
	</div>
</div>