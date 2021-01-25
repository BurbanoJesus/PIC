<?php 
include $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
include VIEWS.'templates/head.php';
session_start();
$tipo_usuario = $_SESSION['usuario']->tipo_usuario;
$municipio = $_SESSION['usuario']->municipio;
$str_h1 = $_SESSION['str_h1'];

?>

<main>
	<div class="panel" id="notificaciones">
		<?php
		$gestion_cursos = 'active';
		include VIEWS.'templates/menu_p.php'; 
		?>
		<div class="contenido_panel">
			<?php include VIEWS.'templates/contenido_panel_h1.php' ?>
			<form class="form s100" method="POST" action="<?php echo CONTROLLERS?>panel/c_busqueda_personas.php" id="buscar_personas">
				<h2 class="titulo_panel">Gestión de cursos</h2>
				<div class="tabla">
					<table>
						<thead>
							<tr class="tr_sin_color">
								<th class="left" width="350">Nombre</th>
								<th width="90">Modulos</th>
								<th width="90">Actividades</th>
								<th width="145">Fecha Creación</th>
								<th class="left">Descripción</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="left"><div class="ellipsis">Estrategia de movilización social</div></td>
								<td class="nowrap">6</td>
								<td class="nowrap">25</td>
								<td class="nowrap">25/07/2020</td>
								<td class="left"><div class="ellipsis">Descripcion Curso</div></td>
								<td class="td_acciones">
									<div class="div_acciones">
										<a href="" class="acciones"><i class="icon-filled-visible"></i><span class="icon_info">Ver</span></a>
										<a href="" class="acciones"><i class="icon-filled-editar"></i><span class="icon_info">editar</span></a>
										<a href="<?php echo HOST?>detalles_familia_riesgos?id=pqwpe" class="acciones"><i class="icon-filled-eliminar-b"></i><span class="icon_info">Eliminar</span></a>
									</div>
								</td>
							</tr>
							<tr>
								<td class="left"><div class="ellipsis">Enfermedad Pulmonar Obstructiva</div></td>
								<td class="nowrap">4</td>
								<td class="nowrap">25</td>
								<td class="nowrap">25/07/2020</td>
								<td class="left"><div class="ellipsis">Descripcion Curso</div></td>
								<td class="td_acciones">
									<div class="div_acciones">
										<a href="" class="acciones"><i class="icon-filled-visible"></i><span class="icon_info">Ver</span></a>
										<a href="" class="acciones"><i class="icon-filled-editar"></i><span class="icon_info">editar</span></a>
										<a href="<?php echo HOST?>detalles_familia_riesgos?id=pqwpe" class="acciones"><i class="icon-filled-eliminar-b"></i><span class="icon_info">Eliminar</span></a>
									</div>
								</td>
							</tr>
							<tr>
								<td class="left"><div class="ellipsis">Estrategia Covid-19</div></td>
								<td class="nowrap">3</td>
								<td class="nowrap">15</td>
								<td class="nowrap">25/07/2020</td>
								<td class="left"><div class="ellipsis">Descripcion Curso</div></td>
								<td class="td_acciones">
									<div class="div_acciones">
										<a href="" class="acciones"><i class="icon-filled-visible"></i><span class="icon_info">Ver</span></a>
										<a href="" class="acciones"><i class="icon-filled-editar"></i><span class="icon_info">editar</span></a>
										<a href="<?php echo HOST?>detalles_familia_riesgos?id=pqwpe" class="acciones"><i class="icon-filled-eliminar-b"></i><span class="icon_info">Eliminar</span></a>
									</div>
								</td>
							</tr>
							
						</tbody>
					</table>
				</div>
				<div class="content_button next">
					<button class="button"><i class="icon-lineal-add"></i>Agregar nuevo</button>
				</div>
			</form>
		</div>
	</div>
</main>
<?php 
include VIEWS.'templates/foot.php'; 
?>