<?php



$output="images/a.jpeg";


$x=720;
$y=480;
$image=imagecreate($x,$y);

$color=imagecolorallocate($image,93,73,255);


$font_size=40;
$rotation=0;
$origin_x=120;
$origin_y=120;
$font="ITCBLKAD.TTF";
$name="UMESH SHARMA";


//$text1=imagettftext($image,$font_size,$rotation,$origin_x,$origin_y,$color,$font,$name);

imagejpeg($image,$output);

?>