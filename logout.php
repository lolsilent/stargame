<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/template.header.php';
?><table><tr class="buildings"><td><?php
if (!empty($_COOKIE)) {
	foreach ($_COOKIE as $key=>$val){
		print 'Cookie name '.$key.' with value '.substr($val,0,3).'.. deleted.<br>';
		setcookie ($key, "",$current_time-(84600*360)) or die_nice('Cookie removal failure!');
	}
	print 'All cookies should have been removed, logout success!<br>';
}else{
	print 'No cookies found, you are already logged out!<br>';
}

?>Thank you for your time, we hope to see you back again soon.<br>
<br>
<b>If you like this game please tell your friends.</b>
<br>
And don't forget to add this site to you favorites!</td></tr>
</table>
<?php

require_once 'admin/template.footer.php';
?>