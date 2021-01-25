<?php
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
session_start();
$year = $_POST['year'];
$array_year = ['2014','2015','2016','2017','2018','2019','2020'];
if (!in_array($year, $array_year)){
	header("Location: ".HOST."estructura_principal");
	exit;
}
$_SESSION['ses_year'] = $year;

header("Location: ".HOST."panel");
exit;
  
?>

