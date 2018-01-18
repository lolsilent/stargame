<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

$j_names = array(
'Receive Cost Message','Auto Delete Seen Game Messages','','','',
'Auto Reload When a Timer Goes Zero','Background Image Rotate','Background Image','Floating Menu','Receive Production Reports Messages',
'','','','','',
'','','','','',
);

//j2 noob timer 5 days
//j3 max attacks
//j4 military morale

//j = option

//j0 == cost message
//j1 == auto delete seen messages
//j5 == auto delete seen messages
//j6 == background
//j7 = background on off

//j8 == float
//j9 receive production reports
//j10 external small images on //External Small Images
//j11 original or google //Original Image Leech

if(!empty($_POST)){
	foreach($_POST as $key=>$val){
		$key=clean_post($key);
		$val=preg_replace("@[^0-9]@si","",clean_post($val));
		if(isset($row->$key)){
			if($row->$key !== $val){
				$to_update .= ", `$key`='$val'";
				$row->$key=$val;
			}
		}
	}
}

print '<form method="post"><table><tr><th colspan="2">Options</th></tr>';

for ($i=0;$i<=19;$i++) {
if(!empty($j_names[$i])){
	print '<tr class="buildings"><td>'.$j_names[$i].'</td><td><select name="j'.$i.'">';
	if($row->{"j$i"} < 1){
print '<option value="0" selected>On</option>';
print '<option value="1">Off</option>';
	}else{
print '<option value="1" selected>Off</option>';
print '<option value="0">On</option>';
	}
	print '</select></td></tr>';
}
}

print '<tr class="buildings"><td colspan="2" align="center"><input type="submit" value="Send"></td></tr></table></form>';

/*
if (!empty($reset)) {
foreach ($row as $key=>$val) {
	if ($key !== 'id' and $key !== 'username' and $key !== 'password' and $key !== 'sex' and $key !== 'charname' and $key !== 'email') {
		$vali = 0;
		if ($key == 'a0'){
			$vali = 500;
		}elseif ($key == 'a1'){
			$vali = 250;
		}elseif ($key == 'timer' or $key == 'updater') {
			$vali = $current_time;
		}
		$reset .= ",$key=$vali";
	}
}
mysqli_query ($link, "UPDATE `$tbl_members` SET $reset WHERE `id` LIMIT 1000000") or die_nice(mysqli_error($link).' Game reset 1!'.$reset);
}
*/

require_once 'admin/game.footer.php';?>