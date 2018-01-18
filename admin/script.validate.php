<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';

validate_referer();
?>
function validate(docid) {
	if (document.getElementById(docid)){
		var n = document.getElementById(docid).name;
		var t = document.getElementById(docid).value;
		
		if (n == "email") {
			d = t.replace(/[^a-zA-Z0-9.@_]+/g, "");
		}else{
			d = t.replace(/[^a-zA-Z0-9]+/g, "");
		}
		
		if (d !== t) {
			alert("Alphanumeric characters only please.");
		}
		document.getElementById(docid).value=d;
	}
}