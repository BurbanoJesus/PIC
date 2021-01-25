	<script src="<?php echo JS?>jquery-3.3.1.min.js"></script>
	<script src="<?php echo JS?>funciones_generales.js"></script>
	<script src="<?php echo JS?>funciones_vistas.js"></script>
	<script src="<?php echo JS?>comp_menu_elementos.js"></script>
	<?php
	if (isset($scripts)){
	  	foreach ($scripts as $key => $value) { 
	  		$file_js = (strpos($value, 'http') === False) ? JS.$value : $value;
	  	?>
		<script src="<?php echo $file_js?>"></script>
	<?php } 
	} ?>
</body>
</html>