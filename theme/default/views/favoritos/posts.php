<h2 class="title">Favoritos - Posts</h2>
{if="count($favoritos)"}
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Titulo</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody>
	{loop="$favoritos"}
		<tr>
			<td><a href="/post/index/{$value.id}" class="title"><img src="{#THEME_URL#}/assets/img/categoria/{$value.categoria.imagen}" /> {$value.titulo}</a></td>
			<td>{$value.fecha->fuzzy()}</td>
		</tr>
	{/loop}
	</tbody>
</table>
{else}
<div class="alert alert-info">No tienes ning&uacute;n posts como favorito.</div>
{/if}
{$paginacion}