<div class="suceso">
	<div class="icono hidden-phone">
		<i class="icon icon-comment"></i>
	</div>
	<div class="contenido">
{if="$suceso.usuario.id == $suceso.post.usuario.id"}
<a href="/perfil/index/{$suceso.usuario.nick}">{$suceso.usuario.nick}</a> {@coment&oacute; en su post@} <a href="/post/index/{$suceso.post.id}">{$suceso.post.titulo}</a>.
{else}
	{if="$suceso.usuario.id !== $actual.id"}
		<a href="/perfil/index/{$suceso.usuario.nick}">{$suceso.usuario.nick}</a> {@coment&oacute; en tu post@} <a href="/post/index/{$suceso.post.id}">{$suceso.post.titulo}</a>.
	{else}
		<a href="/perfil/index/{$suceso.usuario.nick}">{$suceso.usuario.nick}</a> {@coment&oacute; en el post@} <a href="/post/index/{$suceso.post.id}">{$suceso.post.titulo}</a> {@de@} <a href="/perfil/index/{$suceso.post.usuario.nick}">{$suceso.post.usuario.nick}</a>.
	{/if}
{/if}
	</div>
	<div class="fecha hidden-phone hidden-tablet">
		{function="$fecha->fuzzy()"}
	</div>
</div>