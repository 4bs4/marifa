<div class="suceso{if=" ! $visto"} nuevo{/if}">
	<div class="icono hidden-phone">
		<i class="icon icon-certificate"></i>
	</div>
	<div class="contenido">
		<a href="/perfil/index/{$suceso.moderador.nick}">{$suceso.moderador.nick}</a> {@ha cambiado tu rango a @} <img src="{#THEME_URL#}/assets/img/rangos/{$suceso.rango.imagen}" /><span style="color: #{function="sprintf('%06s', dechex($suceso.rango.color))"}"><strong>{$suceso.rango.nombre}</strong></span>.
	</div>
	<div class="fecha visible-desktop">
		{function="$fecha->fuzzy()"}
	</div>
</div>