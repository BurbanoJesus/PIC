<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();

$estilos = ['estilos_inicio.css'];
require_once VIEWS.'templates/head.php';
?>

<main>
	<div class="main">
		<div class="certificado">
			<img class="img_fondo" src="<?php echo IMG?>fondo_certificado.png" alt="" />
			<img class="img_main" src="<?php echo IMG?>instituto_logo.png" />
			<h2>Plan de intervenciones colectivas</h2>
			<span class="sp_a" style="display: block;">En cumplimiento de la ley 122 de 1992</span>
			<span class="sp_b"  style="display: block;">Hace constar que:</span>
			<span class="sp_nombre"  style="display: block;">Luis Alejandro Muñoz Armero</span>
			<span class="sp_cedula"  style="display: block;">Con Cedula de Ciudadania N° 109231232</span>
			<span class="sp_c"  style="display: block;">Curso y aprobo la accion de formacion</span>
			<span class="sp_curso">Generar cultura de servicio al cliente</span>
			<span class="sp_c">Con una duracion de 40 horas</span>
			<span class="sp_d">En presente a lo anterior, se firma el presente en Pasto, a los veintitres (23) dias del mes de Julio de dos mil veinte (2020).</span>
			<div class="tabla no_color">
				<table>
					<tbody>
						<tr>
							<td class="center">
								<div class="block wrap_firmas">
									<img class="img_firma" src="<?php echo IMG?>firma.jpg" width = "100" />
									<span class="sp_firma_linea"  style="display: block;">________________________________</span>
									<span class="sp_firma_nombre"  style="display: block;">DIANA SOFIA BOLAÑOS GOMEZ</span>
									<span class="sp_firma_cargo"  style="display: block;">SUBDIRECTORA DE PIC</span>
								</div>
							</td>
							<td class="center">
								<div class="block wrap_firmas">
									<img class="img_firma" src="<?php echo IMG?>firma.jpg" width = "100" />
									<span class="sp_firma_linea">________________________________</span>
									<span class="sp_firma_nombre">DIANA SOFIA BOLAÑOS GOMEZ</span>
									<span class="sp_firma_cargo">SUBDIRECTORA DE PIC</span>
								</div>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</main>
<?php 
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>