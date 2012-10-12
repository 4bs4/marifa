<h2 class="title">Borradores</h2>
{if="count($borradores)"}
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Titulo</th>
			<th>Fecha</th>
		</tr>
	</thead>
	<tbody>
	{loop="$borradores"}
		<tr>
			<td><a href="/post/index/{$value.id}" class="title"><img src="{#THEME_URL#}/assets/img/categoria/{$value.categoria.imagen}" /> {$value.titulo}</a></td>
			<td>{$value.fecha->fuzzy()}</td>
		</tr>
	{/loop}
	</tbody>
</table>
{else}
<div class="alert">No tienes ning&uacute;n borrador</div>
{/if}
{$paginacion}