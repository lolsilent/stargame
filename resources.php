<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';


//resources a0-9
//production halt a10-19
//buildings b0-9 timer = f0-9
//buildings special b10-19 timer = f10-19

if (!empty($_POST)) {
foreach ($_POST as $key=>$val) {
	$key = clean_post($key);
	$val = clean_post($val);
	$key += 10;
	if (isset($row->{"a".$key}) and $val >=0 and $val <= 100) {
		if ($row->{"a".$key} !== $val) {
//print "TEST $key $val";
$to_update .= ", `a".$key."`=$val";
$row->{"a".$key}=$val;
		}
	}
}
}
//mysqli_query ($link, "UPDATE `$tbl_members` SET `a10`=100,`a10`=100,`a11`=100,`a12`=100,`a13`=100,`a14`=100,`a15`=100,`a16`=100,`a17`=100,`a18`=100,`a19`=100 WHERE `id` LIMIT 100") or die_nice(mysqli_error($link).' Game update 1!'.$update_it);

$txt_resources = array(
'Resources','Building','Resource','Production','Require',
'Result','Storage Capaciy','Totals','Send Order','aaaaa',
'Running',
);

print '<form method="post"><table>
<tr><th colspan="8">'.$txt_resources[0].'</th></tr>
<tr class="buildings"><td>'.$txt_resources[1].'</td><td>'.$txt_resources[10].'</td><td>'.$txt_resources[2].'</td><td>'.$txt_resources[3].'</td><td>'.$txt_resources[4].'</td><td>'.$txt_resources[5].'</td><td>'.$txt_resources[6].'</td></tr>
';

$requiresource=array(0,0,0,0,0,0,0,0,0,0);

//buildings
for ($i=0;$i<=9;$i++) {
	$requiresource=requiresource($i,$row,$requiresource,1);
}

//military
list ($mil[2],$mil[3]) =military_consumption($row);
$requiresource[2]+=$mil[2];
$requiresource[3]+=$mil[3];

for ($i=0;$i<=9;$i++) {
	$production[$i]=production($i,$row);
	$max_resources[$i]=max_resources($i,$row);
print '<tr class="buildings"><td>'.$b_names[$i].' ('.$row->{"b$i"}.')</td><td><select name="'.$i.'">';
	for ($j=0;$j<=100;$j++) {
		if ($row->{"a".($i+10)} == $j) {
			print '<option value="'.$j.'" selected>'.$j.' %</option>';
		}else{
			print '<option value="'.$j.'">'.$j.' %</option>';
		}
	}
print '</select></td><td>'.$a_names[$i].'</td><td>'.number_format($production[$i]).'</td><td>'.number_format($requiresource[$i]).'</td><td>'.number_format($production[$i]-$requiresource[$i]).'</td><td>'.number_format($max_resources[$i]).'</td></tr>';
}

print '<tr class="buildings"><td></td><td><input type="submit" value="'.$txt_resources[8].'"></td><td>'.$txt_resources[7].'</td><td>'.number_format(array_sum($production)).'</td><td>'.number_format(array_sum($requiresource)).'</td><td>'.number_format(array_sum($production)-array_sum($requiresource)).'</td><td>'.number_format(array_sum($max_resources)).'</td></tr></table><form>';

require_once 'admin/game.footer.php';?>