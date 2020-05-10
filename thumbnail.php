<?php
if(isset($_GET["id"])) {
	$id=$_GET["id"];
	$file="image/".$id."/icon.webp";
	if(!file_exists($file)) {
		exit("404!\n");
	}
	$im=imagecreatefromwebp($file);
	header("Content-Type: image/png");
	imagepng($im);//, './example.jpeg', 100);
	imagedestroy($im);
}
else {
	exit("No value!\n");
}
