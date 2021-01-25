<?php 
    if (!isset($_SESSION['usuario'])){
        header("Location: ".HOST);
        exit();
    }else if($_SESSION['usuario']->tipo_usuario !== 'administrador' && $_SESSION['usuario']->tipo_usuario !== 'generador' && $_SESSION['usuario']->tipo_usuario !== 'supervisor'){
    	header("Location: ".HOST);
        exit();
    }
?>