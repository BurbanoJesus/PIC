<?php 
require_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'curso.php';
session_start();

$estilos = ['estilos_inicio.css','comp_modal.css'];
require_once VIEWS.'templates/head.php';

$dimension = isset($_GET['dimension']) ? $_GET['dimension'] : '';

$obj_curso = new Curso();
$array = $obj_curso->filtrar($dimension);

$aprende = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main">
		<div class="contenido relative aprende" id="cursos">
			<?php
			require_once LIBS.'verificar_sesion.php';
			if ($flag_session === False){
			?>
			<form action="" class="form">
				<div class="volver" onclick="window.location = '<?php echo HOST?>aprende'">
					<i class="icon-lineal-flecha volver"></i>
				</div>
				<div class="informacion last">
					<h2 class="h2_informacion">Cursos disponibles</h2>
					<div class="cursos">
						<?php
						if($array !== Null && $array !== False){
						foreach ($array as $key => $row) { 
						$nota = $row->nota_curso;
						?>
						<div class="tarjetas_cursos parent_me_elemento" id="s<?php echo $key ?>" id_data="<?php echo $row->id_curso?>" url_data="inicio/aprende/c_eliminar_curso">
							<div onclick="window.location = '<?php echo HOST?>curso?id=<?php echo $row->id_curso ?>'" class="img">
								<img index="0" src="<?php echo $row->img_curso ?>" target="theater" />
							</div>
							<div onclick="window.location = '<?php echo HOST?>curso?id=<?php echo $row->id_curso ?>'" class="props">
								<h2 class="">Curso <?php echo $key + 1 ?>: <?php echo $row->nombre_curso ?></h2>
								<div class="valoracion">
									<span class="titulo">Valoración: </span>
									<?php if($nota !== '0.0'){ ?>
									<span class="nota"><?php echo $nota ?></span>
									<?php
									$nota_base = floor($nota);
									$nota_restante = (float) $nota - $nota_base;
									for ($i=1; $i <= 5; $i++) {
										if ($nota_base >= $i) {
											echo '<img src="'.IMG.'estrellas/small/estrella_s.png" />';
										}else{
											if ($nota_restante > 0) {
											 	$nota_restante = substr($nota_restante, -1);
												echo '<img src="'.IMG.'estrellas/small/'.$nota_restante.'s.png" />';
												$nota_restante = 0;
											}else{
												echo '<img src="'.IMG.'estrellas/small/borde_estrella_s.png" />';
											}
										}
									}
									?>
									<?php }else{ ?>
									<div class="not_nota">
										<span>(Sin valoraciónes)</span>
									</div>
									<?php } ?>
								</div>
							</div>
							<a href="<?php echo HOST?>curso?id=<?php echo $row->id_curso ?>" class="button cursos completo">Entrar</a>
							<?php if ($tipo_usuario == 'administrador'){ ?>
								<div class="menu_elemento">
									<div class="me_icon filled"><i class="icon-filled-ellipsis"></i></div>
									<div class="me_opciones">
										<span class="me_opcion me_editar"><i class="icon-filled-editar"></i>Editar</span>
										<span class="me_opcion me_eliminar"><i class="icon-filled-eliminar-b"></i>Eliminar</span>
									</div>
								</div>
							<?php } ?>
						</div>
						<?php }
						}else{ ?>
						<div class="empty_cursos">
							<span>No hay cursos creados en esta dimensión.</span>
						</div>
						<?php } ?>
						<?php
						if ($tipo_usuario == 'administrador'){
							$center = (is_array($array)) ? '': 'center';
						?>
						<div class="tarjetas_cursos nuevo <?php echo $center ?>" onclick="window.location = '<?php echo HOST?>registrar_curso?dimension=<?php echo $dimension ?>'">
							<i class="icon-filled-modulo-add"></i>
							<a href="<?php echo HOST?>registrar_curso?dimension=<?php echo $dimension ?>" class="button cursos">Crear Curso</a>
						</div>
						<?php } ?>
					</div>
				</div>
			</form>
			<?php } ?>
			<div id="div_mod_eliminar"></div>
		</div>
	</div>	
</main>
<?php
$scripts = ['comp_modal.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>