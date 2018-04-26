<?php
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); 

function _generateRandom($length=6)
{
	$_rand_src = array(
		array(48,57) //digits
	
	);
	srand ((double) microtime() * 1000000);
	$random_string = "";
	for($i=0;$i<$length;$i++){
		$i1=rand(0,sizeof($_rand_src)-1);
		$random_string .= chr(rand($_rand_src[$i1][0],$_rand_src[$i1][1]));
	}
	return $random_string;
}

$im = imagecreatefromjpeg("captcha.jpg"); 
$rand = _generateRandom(3);
$rand1  = $rand;
$font = 18;
imagestring($im,$font, 2, 2, $rand[0]." ".$rand[1]." ".$rand[2]." ", ImageColorAllocate ($im,  0, 255, 0));
$rand = _generateRandom(3);
$rand2  = $rand;
imagestring($im, $font, 2, 2, " ".$rand[0]." ".$rand[1]." ".$rand[2], ImageColorAllocate ($im, 0, 0, 255));

$_SESSION['captcha'] =$rand1[0].$rand2[0].$rand1[1].$rand2[1].$rand1[2].$rand2[2];
header ('Content-type: image/jpeg');
imagejpeg($im,NULL,100);
imagedestroy($im);
?>