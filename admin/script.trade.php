<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';

validate_referer();
?>
function maxthat(docid){

var a;
var r;

if (docid == 'oamo') {
a = document.getElementById("oamo").value;
r = document.getElementById("ores").value;
}

if (docid == 'samo') {
a = document.getElementById("samo").value;
r = document.getElementById("sres").value;
}

r++;
var haveamo = document.getElementById("xxr"+r).innerHTML;


haveamo = Math.round(haveamo.replace(/[^0-9]/g, ""));


document.getElementById(docid).value=ac(haveamo);
}