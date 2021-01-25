<?php
function convertir_firma_digital($firma_tmp){
    $firma_tmp = $firma_tmp['tmp_name'];
    $imagesize = getimagesize($firma_tmp);
    $width = $imagesize[0];
    $height = $imagesize[1];
    $y = 30;
    $x = $y*($width/$height);
    $img_size = ($x >= 250) ? 'width="240"' : 'height="30"';
    $img = '<img src="data:image/*;base64,'.base64_encode(file_get_contents($firma_tmp)).'" '.$img_size.' />';
    return $img;
}

?>