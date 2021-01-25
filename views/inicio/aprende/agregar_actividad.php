<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
require_once MODELS.'modulo.php';
session_start();

$estilos = ['estilos_inicio.css','estilos_form.css','comp_select.css'];
require VIEWS.'templates/head.php';

if (isset($_GET['id'])) {
$id_modulo = $_GET['id'];

$obj_modulo = new Modulo();
$row = $obj_modulo->detalles_actividad($id_modulo);
}

$cuenta = "active";
include VIEWS.'templates/header.php';

?>

<main>
	<div class="main">
		<div class="contenido">
		<?php
		require_once LIBS.'verificar_sesion.php';
		$object = $row;
		require_once LIBS.'empty.php';
		if ($flag_empty === False){ ?>
			<div class="informacion">
				<h2 class="h2_informacion">Tipo de Actividad</h2>
				<div class="menu_actividades">
					<a class="button" href="<?php echo HOST?>agregar_actividad_general?id=<?php echo $id_modulo ?>"><i class="icon-filled-add"></i>General</a>
					<a class="button" href="<?php echo HOST?>agregar_examen?id=<?php echo $id_modulo ?>"><i class="icon-filled-add"></i>Examen</a>
				</div>
			</div>
		<?php } ?>
		</div>
	</div>
</main>
<?php
$scripts = ['comp_select.js'];
include VIEWS.'templates/footer.php';
include VIEWS.'templates/foot.php'; 
?>