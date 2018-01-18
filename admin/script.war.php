<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';

validate_referer();
?>
function mil(init){
var checkit = document.getElementById("checkit").checked;
var mk = document.getElementById("mk"+init).innerHTML;
var k = document.getElementById("k"+init).value;
mk = Math.round(mk.replace(/[^0-9]/g, ""));
k = Math.round(k.replace(/[^0-9]/g, ""));
if (k>mk) {
	k=mk;
}
if (k<1) {
	k='';
}


if (document.getElementById("md"+init)) {
var md = document.getElementById("md"+init).innerHTML;
var d = document.getElementById("d"+init).value;
md = Math.round(md.replace(/[^0-9]/g, ""));
d = Math.round(d.replace(/[^0-9]/g, ""));
if (d>md) {
	d=md;
}
if (d<1) {
	d='';
}

if (checkit) {
	d=k;
	if (d>md) {
		d=md;
	}
}
	document.getElementById("d"+init).value=ac(d);
}

	document.getElementById("k"+init).value=ac(k);

}

function max(init) {
maxmil(init);
maxpet(init);
}

function maxmil(init) {
if (document.getElementById("k"+init)) {
	document.getElementById("k"+init).value = ac(document.getElementById("mk"+init).innerHTML);
}
}

function maxpet(init) {
if (document.getElementById("d"+init)&&document.getElementById("md"+init)) {
	document.getElementById("d"+init).value = ac(document.getElementById("md"+init).innerHTML);
}
}