<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';

validate_referer();

?>
function resourcer(xdocid,ins){

var t = document.getElementById(xdocid).innerHTML;
if (ins == 1) {
	var xdocidv = xdocid+"r";
}
if (ins == 2) {
	var xdocidv = xdocid+"a";
}
if (document.getElementById(xdocidv)){
var s = document.getElementById(xdocidv).value;
t = Math.round(t.replace(/[^0-9]/g, ""));
s = Math.round(s.replace(/[^0-9]/g, ""));

if (ins == 1) {
a = t-s;
}
if (ins == 2) {
a = t+s;
}

a=ac(a);


//document.getElementById(xdocid).innerHTML=t+" "+s+" "+a;
document.getElementById(xdocid).innerHTML=a;
}
}

function scanres(){
var xpref="xxr";
for(i=1;i<=100;++i){
		var xpid=xpref+i;
		if (document.getElementById(xpid)){
			resourcer(xpid,1);
		}
}

var xpref="xxr";
for(i=1;i<=100;++i){
		var xpid=xpref+i;
		if (document.getElementById(xpid)){
			resourcer(xpid,2);
		}
}
}

scanres();