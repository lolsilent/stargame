<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';

validate_referer();

?>
function resourcev(xdocid,inner){

var allr=0;
var xpref="a";
for(i=1;i<=100;++i){
		var xpid=xpref+i;
		if (document.getElementById(xpid)){
			iallr = document.getElementById(xpid).value;
			iallr = Math.round(iallr.replace(/[^0-9]/g, ""));
			allr += iallr;
		}
}

var a = document.getElementById(xdocid).value;
var m = document.getElementById("xxr"+inner).innerHTML;
var mxcargo = document.getElementById("mxcargo").innerHTML;


a = Math.round(a.replace(/[^0-9]/g, ""));
m = Math.round(m.replace(/[^0-9]/g, ""));
mxcargo = Math.round(mxcargo.replace(/[^0-9]/g, ""));


if (a >= m) {
a=m;
}
if (a > mxcargo) {
a='';
}

if (allr > mxcargo){
a=mxcargo-allr;
allr=mxcargo;
}
if (a <= 0) {
a='';
}
if (a <= 0) {
a='';
}
allr=mxcargo-allr;

o=ac(a);
allr=ac(allr);


document.getElementById(xdocid).value=o;
document.getElementById("txcargo").innerHTML=allr;
}

function maxthis(xdocid,inner){

var allr=0;
var xpref="a";
for(i=1;i<=100;++i){
		var xpid=xpref+i;
		if (document.getElementById(xpid)){
			iallr = document.getElementById(xpid).value;
			iallr = Math.round(iallr.replace(/[^0-9]/g, ""));
			allr += iallr;
		}
}

var m = document.getElementById("xxr"+inner).innerHTML;
var mxcargo = document.getElementById("mxcargo").innerHTML;

m = Math.round(m.replace(/[^0-9]/g, ""));
mxcargo = Math.round(mxcargo.replace(/[^0-9]/g, ""));

if (m > mxcargo) {
m=mxcargo-allr;
}

if (allr > m){
m='';
}

allr=mxcargo-allr;

o=ac(m);
allr=ac(allr);

document.getElementById(xdocid).value=o;
document.getElementById("txcargo").innerHTML=allr;
}