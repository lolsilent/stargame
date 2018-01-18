<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

//mysqli_query ($link, "UPDATE `$tbl_members` SET `j0`=1, `j6`=1, `j8`=1, `j10`=1, `j11`=1 WHERE `id` LIMIT 100") or die_nice(mysqli_error($link).' Game update 1!'.$update_it);

print '<table>';

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
//j10 external small images on
//j11 original or google

if ($row->j2 == 0) {
	$to_update .= ", `j0`=1, `j2`=".($current_time+$noob_time).", `j6`=1, `j8`=1, `j10`=1, `j11`=1";
	print '<tr><th colspan="2">'.$title.'</th></tr><tr class="buildings"><td colspan="2">'.welcome_note($row).'</td></tr>';
}elseif ($row->j2 >= $current_time) {
	print '<tr><th>'.$txt_game[9].'</th><th><span id="xxt'.$xxt.'">'.clockit($row->j2-$current_time).'</span></th></tr>';$xxt++;
}

	print '<tr><th>M.A.C.</th><th>'.number_format($row->j3).'/'.$mac.'</th></tr>';
	
	//MESSAGES
require_once 'admin/functions.messaging.php';

foreach ($message_functions as $val) {
	if (in_array($val,$status_array)) {
		$message_amount=message_amount($val);
		if ($message_amount>=1 & empty($mtitle)){
			$mtitle=1;print '<tr><th colspan="2">'.ucfirst($txt_messages[2]).'</th></tr>';
		}
		print ($message_amount >=1 ?'<tr class="buildings"><td><a href="messages.php?'.$val.'">'.ucfirst($val).'</a></td><td nowrap>'.number_format($message_amount).' '.($message_amount>1?$txt_messages[2]:$txt_messages[1]).'</td></tr>':'');
	}
}
	//MESSAGES

	//BUILDINGS
$max_build = 1+$row->b17;
$in_build = in_build($row);

print $in_build>=1?'<tr class="buildings"><th>'.$txt_game[0].'</th><th nowrap>'.$in_build.'/'.$max_build.'</th></tr>':'';

$b_namesxk=array_keys($b_namesx);
for ($i=0;$i<=19;$i++) {
	if ($row->{"f$i"} >= $current_time) {
		print '<tr class="buildings"><td>'.
		($i<=9?$b_names[$i]:$b_namesxk[($i-10)]).'
		('.$txt_buildings[1].' '.($row->{"b$i"}+1).') </td><td nowrap><span id="xxt'.$xxt.'" class="timer">'.clockit($row->{"f$i"}-$current_time).'</span></td></tr>';
		$xxt++;
	}
	if ($row->{"i$i"} >= $current_time) {
		print '<tr class="buildings"><td>'.$defence_units_names[$i].' ('.number_format($row->{"e$i"}+1).')</td><td nowrap><span id="xxt'.$xxt.'" class="timer">'.clockit($row->{"i$i"}-$current_time).'</span></td></tr>';
		$xxt++;
	}
}
	//BUILDINGS

	//SCIENCE
$in_research=0;
for ($i=0;$i<=19;$i++) {
	if ($row->{"g$i"} > $current_time) {
		$in_research++;
	}
}

print $in_research>=1?'<tr class="buildings"><th>'.$txt_game[1].'</th><th nowrap>'.$in_research.'/'.$row->b18.'</th></tr>':'';

for ($i=0;$i<=19;$i++) {
	if ($row->{"g$i"} >= $current_time) {
		print '<tr class="buildings"><td>'.$c_names[$i].'</td><td nowrap><span id="xxt'.$xxt.'" class="timer">'.clockit($row->{"g$i"}-$current_time).'</span></td></tr>';
		$xxt++;
	}
}
	//SCIENCE

	//MERCHANTS
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_merchant` WHERE `mid`='$row->id' or `rid`='$row->id' ORDER BY `timer` ASC LIMIT 100")){
	if(mysqli_num_rows($meresult) >= 1) {
		//UPDATE MERCHANTS
		$merchant_max=merchant_max($row);
		print '<tr class="buildings"><th>'.$txt_merchant[1].'</th><th nowrap>'.number_format($merchant_max).'/'.number_format($row->b19).'</th></tr>';
		while ($merow = mysqli_fetch_object ($meresult)) {
			print '<tr class="buildings"><td>'.($merow->rid==$row->id?$txt_merchant[4]:$txt_merchant[10]).': '.merchant_carry($merow).'</td><td nowrap><span id="xxt'.$xxt.'" class="timer">'.clockit($merow->timer-$current_time).'</span></td></tr>';
			$xxt++;
		}
		mysqli_free_result ($meresult);
	}
}
	//MERCHANTS

//military info
list ($requiresource[2],$requiresource[3]) =military_consumption($row);

print array_sum($requiresource)>=1?'<tr class="buildings"><th colspan="2">'.$txt_game[8].'</th></tr><tr class="buildings"><td>'.$txt_game[2].'</td><td>'.number_format(total_offence($row)).'</td></tr><tr class="buildings"><td>'.$txt_game[3].'</td><td>'.number_format(total_defence($row)).'</td></tr><tr class="buildings"><th colspan="2">'.$txt_game[4].'</th></tr><tr class="buildings"><td>'.$a_names[2].'</td><td>'.number_format($requiresource[2]).'</td></tr><tr class="buildings"><td>'.$a_names[3].'</td><td>'.number_format($requiresource[3]).'</td></tr>':'';


//military info

//MILITARY TRAINING
$max_training=$row->b15;
$military_training=military_training($row);

if ($military_training >= 1) {
print '<tr><th>Military Training</th><th>'.number_format($military_training).'/'.number_format($max_training).'</th></tr>';
for ($i=0;$i<=19;$i++) {
	if ($row->{"l$i"} >= $current_time) {
		print '<tr class="buildings"><td>'.$military_units_names[$i].' ('.number_format($row->{"k$i"}+1).')</td><td nowrap><span id="xxt'.$xxt.'" class="timer">'.clockit($row->{"l$i"}-$current_time).'</span></td></tr>';
		$xxt++;
	}
	if ($row->{"h$i"} >= $current_time) {
		print '<tr class="buildings"><td>'.$offence_units_names[$i].' ('.number_format($row->{"b$i"}+1).')</td><td nowrap><span id="xxt'.$xxt.'" class="timer">'.clockit($row->{"h$i"}-$current_time).'</span></td></tr>';
		$xxt++;
	}
}
}

//MILITARY TRAINING

//ROAD TRIP
//  and `timer`>$current_time
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_war` WHERE `mid`='$row->id' or `rid`='$row->id' ORDER BY `timer` ASC LIMIT 100")){
	if(mysqli_num_rows($meresult) >= 1) {
$max_war_slots = $row->c16;///TEST +10
$in_war = in_war($row->id);
		print '<tr><th>'.$txt_game[5].'</th><th>'.number_format($max_war_slots).'/'.number_format($max_war_slots).'</th></tr>';
		$merchant_max=merchant_max($row);
		while ($merow = mysqli_fetch_object ($meresult)) {
			//print_r($merow);print'<hr>';
			print '<tr class="buildings"><td>'.$missions[$merow->mission].' '.return_charname($merow->mid).' '.$txt_game[6].' '.return_charname($merow->rid).'</td><td>';
			if ($merow->timer > $current_time) {
				print '<span id="xxt'.$xxt.'" class="timer">'.clockit($merow->timer-$current_time).'</span>';
			}else{
				if ($merow->mtimer > $current_time) {
					print $txt_game[7].': <span id="xxt'.$xxt.'" class="maxed">'.clockit($merow->mtimer-$current_time).'</span>';
				}
			}
			print '</td></tr>';
			$xxt++;
		}
		mysqli_free_result ($meresult);
	}
}
//ROAD TRIP

//logins signups
print '<tr><th colspan="2">Last 5 Logins</th></tr>
<tr><th>Charname</th><th>'.$a_names[0].'</th></tr>';
if($onresult = mysqli_query ($link, "SELECT `sex`,`charname`,`a0` FROM `$tbl_members` WHERE `id` ORDER BY `timer` DESC LIMIT 5")) {
	while ($onrow = mysqli_fetch_object ($onresult)){
		print '<tr class="buildings"><td>'.$onrow->sex.' '.$onrow->charname.'</td><td>'.number_format($onrow->a0).'</td></tr>';
	}
	mysqli_free_result ($onresult);
}
print '<tr><th colspan="2">Last 5 Signups</th></tr>
<tr><th>Charname</th><th>'.$a_names[0].'</th></tr>';
if($onresult = mysqli_query ($link, "SELECT `sex`,`charname`,`a0` FROM `$tbl_members` WHERE `id` ORDER BY `id` DESC LIMIT 5")) {
	while ($onrow = mysqli_fetch_object ($onresult)){
		print '<tr class="buildings"><td>'.$onrow->sex.' '.$onrow->charname.'</td><td>'.number_format($onrow->a0).'</td></tr>';
	}
	mysqli_free_result ($onresult);
}


print '</table>';
//logins signups

//print $row->j6.' '.imagine_bg($row->j6).' '.date("j");

require_once 'admin/game.footer.php';?>