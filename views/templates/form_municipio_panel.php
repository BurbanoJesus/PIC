<?php
if ($_SESSION['ses_municipio'] == 'Elige Municipio'){
$obj_municipio = new Municipio();
$array_municipio = $obj_municipio->listar();
 
?>
<form class="form" action="<?php echo CONTROLLERS?>panel/c_elegir_municipio.php" method="POST">
	<div class="elegir_municipio_panel">
		<div class="logo">
			<img src="<?php echo IMG?>mingas_logo_b.png">
			<h2>PIC</h2>
		</div>
		<div class="input">
			<h3>Elige el municipio.</h3>
			<div class="select" id="municipio" data="">
				<div class="head_select">
					<span class="nombre_select">Seleccione Municipio</span>
					<i class="icon-arrow"></i>
				</div>
				<div class="opciones">
					<?php foreach ($array_municipio as $key => $row) { ?>
						<div class="opcion t_submit"><i class="icon-filled-ubicacion"></i><span><?php echo ucwords($row->municipio)?></span></div>
					<?php } ?>
				</div>
				<input type="hidden" name="municipio" value="" />
			</div>
			<input type="hidden" name="view" value="<?php echo $view ?>" />
		</div>
	</div>
</form>
<?php } ?>