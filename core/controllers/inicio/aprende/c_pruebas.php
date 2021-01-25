<?php 
include_once $_SERVER['DOCUMENT_ROOT']."/plataforma/application/settings.php";
echo 'Bienvenido<br>';
// $cmd = "ffmpeg -i ".SERVER."static/img/s3.avi ".SERVER."static/img/s.mp4";
$cmd = "ffmpeg -i ".SERVER."static/img/s3.avi -ss 00:00:01.000 -vframes 1 ".SERVER."static/img/img_output.png";

shell_exec($cmd);

echo $cmd."<br>";


?>