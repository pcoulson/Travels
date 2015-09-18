<?php

ob_start();

define('CAPTCHA_STRENGTH', 5);
define('BACKGROUND_SIZE_X',2000);
define('BACKGROUND_SIZE_Y',350);
define('SIZE_X',200);
define('SIZE_Y',50);
define('FONT_FILE','verdana.ttf');
define('BACKGROUND_FILE','background.png');

session_start();

$hashText = md5(microtime());
$startChar = rand(0,27);
$textstr = substr($hashText, $startChar, CAPTCHA_STRENGTH);

$textLength = strlen($textstr);

$backgroundOffsetX = rand(0, BACKGROUND_SIZE_X - SIZE_X - 1);
$backgroundOffsetY = rand(0, BACKGROUND_SIZE_Y - SIZE_Y - 1);

$fontColorR 	= rand(0, 127);
$fontColorG 	= rand(0, 127);
$fontColorB 	= rand(0, 127);
$angle 			= rand(-5, 5);
$fontSize 		= rand(14, 24);
$textX 			= rand(0, (int)(SIZE_X - 0.9 * $textLength * $fontSize));
$textY 			= rand((int)(1.25 * $fontSize), (int)(SIZE_Y - 0.2 * $fontSize));

$gdInfoArray = gd_info();
$src_image = imagecreatefrompng( BACKGROUND_FILE );
$dst_image = imagecreatetruecolor(SIZE_X, SIZE_Y);
$resizeResult = imagecopyresampled($dst_image, $src_image, 0, 0, $backgroundOffsetX, $backgroundOffsetY, SIZE_X, SIZE_Y, SIZE_X, SIZE_Y);

$color = imagecolorallocate($dst_image, $fontColorR, $fontColorG, $fontColorB);
imagettftext($dst_image, $fontSize, -$angle, $textX, $textY, $color, FONT_FILE, $textstr);

$_SESSION['textstr'] = $textstr;

header("Content-Type: image/png");

imagepng($dst_image);

imagedestroy($src_image);
imagedestroy($dst_image);

ob_end_flush();
?>