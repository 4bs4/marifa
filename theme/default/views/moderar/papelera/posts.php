<ul class="breadcrumb">
    <li><a href="/moderar/">Moderación</a> <span class="divider">/</span></li>
    <li><a href="/moderar/papelera/">Papelera de reciclaje</a> <span class="divider">/</span></li>
    <li class="active">Posts</li>
</ul>
<div class="header">
	<h2>Posts</h2>
</div>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Autor</th>
			<th>Título</th>
			<th>Fecha</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
		{loop="$posts"}
		<tr>
			<td><a href="/perfil/index/{$value.usuario.nick}">{$value.usuario.nick}</a></td>
			<td><a href="/post/index/{$value.id}">{$value.titulo}</a></td>
			<td>{$value.fecha->fuzzy()}</td>
			<td>
				<div class="btn-group">
					<a href="/post/index/{$value.id}" class="btn btn-mini btn-info" rel="tooltip" title="Ver post"><i class="icon-white icon-eye-close"></i></a>
					<a href="/post/editar/{$value.id}" class="btn btn-mini btn-primary" rel="tooltip" title="Editar post"><i class="icon-white icon-pencil"></i></a>
					<a href="/moderar/papelera/restaurar_post/{$value.id}" class="btn btn-mini btn-success" rel="tooltip" title="Restaurar post"><i class="icon-white icon-refresh"></i></a>
					<a href="/moderar/papelera/borrar_post/{$value.id}" class="btn btn-mini btn-danger" rel="tooltip" title="Borrar post"><i class="icon-white icon-remove"></i></a>
				</div>
			</td>
		</tr>
		{else}
		<tr>
			<td class="alert" colspan="5">&iexcl;No hay post en la papelera!</td>
		</tr>
		{/loop}
	</tbody>
</table>
{$paginacion}