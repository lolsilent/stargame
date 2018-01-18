<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';

//validate_referer();

/*
https://images.google.com/images?q=old+saw
https://www.altavista.com/image/results?q=old+saw

https://images.google.com/images?imgsz=huge&hl=en&safe=off&q=nature
*/
//$q='nature';
if (!empty($_GET['q'])) {$q=clean_post($_GET['q']);
$url = file_get_contents('https://images.google.com/images?imgsz=huge&hl=en&safe=on&q='.$q,'r');
$url = explode("dyn.Img",$url);
$url = preg_grep("/^\(.*?\)\;$/", $url);
	//print_r($url);print '<hr>';
$max=count($url);
$rander = rand(1,$max);
$image = explode("\",\"",$url[$rander]);
array_walk($image, 'trim');
	//print_r($image);print '<hr>';
	//$filename=$image[3]; //original from site
$filename=preg_replace("@ @si","",$image[14].'?q=tbn:'.$image[2].$image[3]);//from google thumbs

print '<img src="'.$filename.'" width="100" height="100">';
}else{print 'images/default0.jpg';}
?>