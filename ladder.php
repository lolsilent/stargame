<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/template.header.php';


//logins signups
print '<table><tr><th>Charname</th><th>Power</th></tr>';

$link = mysqli_connect($db_host, $db_user, $db_password, $db_main) or die_nice('DB Error');

if($onresult = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE `id` ORDER BY `timer` DESC LIMIT 25")) {
	while ($onrow = mysqli_fetch_object ($onresult)){
		print '<tr class="buildings"><td>'.$onrow->sex.' '.$onrow->charname.'</td><td>';

$ppowers=0;
for ($i=0;$i<=19;$i++) {
	$ppowers += ($onrow->{"a$i"}/100000)+($onrow->{"b$i"}/10)+($onrow->{"c$i"}/10)+($onrow->{"d$i"}/10)+($onrow->{"e$i"}/10)+($onrow->{"k$i"}/10);
}
print number_format($ppowers/10000,2);

		print '</td></tr>';
	}
	mysqli_free_result ($onresult);
}

	mysqli_close($link);

print '</table>';
//logins signups

require_once 'admin/template.footer.php';?>