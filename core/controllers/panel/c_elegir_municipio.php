<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();
$ses_municipio = $_POST['municipio'];
$view = $_POST['view'];
$_SESSION['ses_municipio'] = $ses_municipio;

  // var_dump($view);
header("Location: ".HOST.$view);
exit;
  
?>

