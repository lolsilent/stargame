<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

/*
//offence d0-19 timer = h0-19
//defence e0-19 timer = i0-19
//military k0-19 timer = l0-19

//c16 Increase attack slots
//c15 faster troop movement
//c14 decrease troop eating
//c13 war tactics
*/
//mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id`='115' LIMIT 1");

$total_offence=total_offence($row);
$total_defence=total_defence($row);
$travel_time=attack_timer($row);
$max_missions = $row->c13;
$max_war_slots = $row->c16;///TEST +10
$in_war = in_war($row->id);


if (!empty($_GET['intercept'])){
$intercept = clean_post($_GET['intercept']);
}
if (!empty($_GET['reinforce'])){
$reinforce = clean_post($_GET['reinforce']);
}

/*_______________-=TheSilenT.CoM=-_________________*/

//CALLBACK
if (!empty($_GET['callback'])){
$callback = clean_post($_GET['callback']);
	if($cmeresult = mysqli_query ($link, "SELECT * FROM `$tbl_war` WHERE `id`='$callback' and `mid`='$row->id' and `rid`!='$row->id' ORDER BY `id` ASC LIMIT 1")){
		if ($cmerow = mysqli_fetch_object ($cmeresult)) {
			mysqli_free_result ($cmeresult);

military_callback ($cmerow,$travel_time);
	
	//reinforcements and intercept
	if($riresult = mysqli_query ($link, "SELECT * FROM `$tbl_war` WHERE `wid`='$cmerow->id' and `mid`!=`rid` ORDER BY `id` ASC LIMIT 100")){
		while ($rirow = mysqli_fetch_object ($riresult)) {
military_callback ($rirow,$travel_time);
//print $rirow->id.' AAA';
		}
		mysqli_free_result ($riresult);
		
	}
	//mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id` LIMIT 100");
	//reinforcements and intercept
		}
	}
}
//CALLBACK
/*_______________-=TheSilenT.CoM=-_________________*/

//WAR FORM IN
if (!empty($_POST) and $in_war < $max_war_slots) {
	$k=array();
	$d=array();
	$mission='';
	$wid='';
	$recipient='';
	//print 'aaaaaaaaaaaaaaa';
	foreach ($_POST as $key=>$val) {
		$key = clean_post($key);
		$val = preg_replace("@[^0-9]@si","",clean_post($val));
		if ($key == 'mission') {
			//print "$key => $val <br>";
				$mission=$val;
		}
		if ($key == 'wid') {
			//print "$key => $val <br>";
				$wid=$val;
		}
		if ($key == 'recipient') {
			//print "$key => $val <br>";
				$recipient=$val;
		}
		
		if (isset($row->$key)) {
			if ($val >= 1 and $row->$key >= $val) {
				//print "$key => $val <br>";
				if (preg_match('@^k@',$key)) {
					$k[$key]=$val;
				}elseif (preg_match('@^d@',$key)) {
					$d[$key]=$val;
				}
			}
		}
	}

//print array_sum(array_values($k)).'<hr>';print array_sum(array_values($d)).'<hr>';print_r($_POST);print '<hr>';print_r($k);print '<hr>';print_r($d);print '<hr>';
if (isset($mission) and array_sum(array_values($k)) >= 1){
	if (empty($recipient) and !empty($wid)) {
		$travel_time=mission_timer($mission);
	}
	$inserto="NULL,'$row->id','$recipient'";
	if (!empty($wid)) {
		$inserto .= ",'$wid'";
	}else{
		$inserto .= ",0";
	}
	$inserto .= ",$mission,".($current_time+$travel_time).",0";
	for($i=0;$i<=19;$i++) {
		if (isset($k["k$i"])) {
			//print $k["k$i"].' ';
		if ($row->{"k$i"} >= $k["k$i"] and $k["k$i"] >= 1) {
			$inserto .= ", ".$k["k$i"];
			$row->{"k$i"}-=$k["k$i"];
			$to_update .= ", `k$i`=`k$i`-".$k["k$i"];
		}else{
			$inserto .= ", 0";
		}
		}else{
			$inserto .= ", 0";
		}
	}
	for($i=0;$i<=19;$i++) {
		if (isset($k["k$i"]) and isset($d["d$i"])) {
			//print $d["d$i"].'<hr> ';
		if ($row->{"d$i"} >= $d["d$i"] and $d["d$i"] >= 1 and $k["k$i"] >= $d["d$i"]) {
			//print $d["d$i"].'<hr> ';
			$inserto .= ", ".$d["d$i"];
			$row->{"d$i"}-=$d["d$i"];
			$to_update .= ", `d$i`=`d$i`-".$d["d$i"];
		}else{
			$inserto .= ", 0";
		}
		}else{
			$inserto .= ", 0";
		}
	}
$inserto .= ",0,0,0,0,0,0,0,0,0,0";//resources
//print $inserto;

mysqli_query ($link, "INSERT INTO `$tbl_war` VALUES ($inserto)") or die_nice(mysqli_error($link));

//print $missions[$mission].' - '.return_charname($recipient).' - '.$wid.' - '.$inserto;
	$in_war++;

}
//unset($_POST);
}
//WAR FORM IN



//RECIPIENTS SERVER DEPENDEND
if ($in_war < $max_war_slots) {
$alfa='';
$recipient='';

if(!empty($_POST['alfa'])){
	$alfa=clean_post($_POST['alfa']);
	if(strlen($alfa) < 2){
		$alfa='';
	}
}
if(!empty($_POST['recipient'])){
	$recipient=clean_post($_POST['recipient']);
}

$recipient_select = '';

if (!empty($alfa)) {
	
if($presult = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE (`charname`!='$row->charname' and `j2`<='$current_time' and `j3`<='$mac'  and `charname` LIKE CONVERT (_utf8 '%$alfa%' USING latin1) COLLATE latin1_swedish_ci) ORDER BY `charname` ASC LIMIT 100")){
if(mysqli_num_rows($presult) >= 1) {
$recipient_select = '<select name="recipient">';
	while ($prow = mysqli_fetch_object ($presult)) {
if ($recipient == $prow->id) {
$recipient_select .= '<option value="'.$prow->id.'" selected>'.$prow->charname.'</option>';
}else{
$recipient_select .= '<option value="'.$prow->id.'">'.$prow->charname.'</option>';
}
	}
$recipient_select .= '</select>';
}
mysqli_free_result ($presult);
}

}
}//no mission and in_war < max
//RECIPIENTS SERVER DEPENDED


print '<form method="post"><table><tr><th>War</th><th><span id="xxs'.$xxs.'">'.number_format($in_war).'</span>/'.number_format($max_war_slots).'</th></tr>
<tr class="buildings"><td colspan="2">Total Offence Power: '.number_format($total_offence).'<br>Total Defense Power: '.number_format($total_defence).'<br>Travel Time: '.clockit($travel_time).'<br>
M.A.C.: '.number_format($row->j3).'/'.$mac.'<br>
Military Morale: '.number_format($row->j4).'</td></tr><tr><td colspan="2">
';$xxs++;


//ROAD TRIP
//  and `timer`>$current_time
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_war` WHERE `rid`='$row->id' ORDER BY `timer` ASC LIMIT 100")){
	if(mysqli_num_rows($meresult) >= 1) {
		print '<table><tr><th colspan="2">Incoming Forces</th></tr>';
		while ($merow = mysqli_fetch_object ($meresult)) {
			//print_r($merow);print'<hr>';
			print '<tr class="buildings"><td>'.military_troops($merow,1).'</td><td>';
			if ($merow->timer > $current_time) {
				print '<span id="xxt'.$xxt.'" class="timer">'.clockit($merow->timer-$current_time).'</span>';
			}else{
				if ($merow->mtimer > $current_time) {
					print 'Finished in: <span id="xxt'.$xxt.'" class="maxed">'.clockit($merow->mtimer-$current_time).'</span>';
				}else{
					print '<b>Arrived</b>';
				}
			}
			if ($merow->mid == $row->id) {
				if ($merow->mid !== $merow->rid) {
					print ' <span id="extra'.$xxt.'"><a href="?callback='.$merow->id.'">'.$txt_merchant[11].'</a></span>';
				}
			}else{
					print ($in_war < $max_war_slots?' <a href="?intercept='.$merow->id.'">Intercept</a>':'');
			}
			print '</td></tr>';
			$xxt++;
		}
		mysqli_free_result ($meresult);
	print '</table>';
	}
}
//ROAD TRIP

//ROAD TRIP
//  and `timer`>$current_time
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_war` WHERE `mid`='$row->id' and `rid`!='$row->id' ORDER BY `timer` ASC LIMIT 100")){
	if(mysqli_num_rows($meresult) >= 1) {
		print '<table><tr><th colspan="2">Outgoing Forces</th></tr>';
		while ($merow = mysqli_fetch_object ($meresult)) {
			//print "$merow->mid $merow->rid";
			//print_r($merow);print'<hr>';
			print '<tr class="buildings"><td>'.military_troops($merow,1).'</td><td>';
			if ($merow->timer > $current_time) {
				print '<span id="xxt'.$xxt.'" class="timer">'.clockit($merow->timer-$current_time).'</span>';
			}else{
				if ($merow->mtimer > $current_time) {
					print 'Finished in: <span id="xxt'.$xxt.'" class="maxed">'.clockit($merow->mtimer-$current_time).'</span> '.($in_war < $max_war_slots?'<a href="?reinforce='.$merow->id.'">Reinforce</a> ':'');
				}
			}
			if ($merow->mid == $row->id) {
				if ($merow->mid !== $merow->rid) {
					print ' <span id="extra'.$xxt.'"><a href="?callback='.$merow->id.'">'.$txt_merchant[11].'</a></span>';
				}
			}
			print '</td></tr>';
			$xxt++;
		}
		mysqli_free_result ($meresult);
	print '</table>';
	}
}
//ROAD TRIP


if ($in_war < $max_war_slots) {
if (empty($recipient_select) and empty($reinforce) and empty($intercept)) {
print '<table><tr class="buildings"><td width="50%" align="right"><input type="text" name="alfa" value="'.$alfa.'" maxlength="10"></td><td><input type="submit" value="'.$txt_messages[20].'"></td></tr><tr><td colspan="2">
'.$txt_messages[21].'</td></tr></table>';
}else{
//SELECT SEND ARMY
print '<input type="hidden" name="alfa" value="'.$alfa.'"><table><tr><th colspan="3">Military Units</th><th colspan="3">Pets <input type="checkbox" id="checkit" class="checkit" checked></th></tr>';

$mili=0;for($i=0;$i<=19;$i++){
	if ($row->{"k$i"}>=1) {$mili++;
		print '<tr class="buildings"><td>'.$military_units_names[$i].'</td><td><a id="mk'.($i+1).'" onclick="maxmil('.($i+1).');">'.number_format($row->{"k$i"}).'</a></td><td><input type="text" id="k'.($i+1).'" name="k'.$i.'" maxlength="10" onkeyup="mil('.($i+1).');"></td>';
	if ($row->{"d$i"}>=1) {
		if ($row->{"k$i"} < $row->{"d$i"}) {
			$row->{"d$i"}=$row->{"k$i"};
		}
		print '<td>'.$o_names[$i].'</td><td><a id="md'.($i+1).'" onclick="maxpet('.($i+1).');">'.number_format($row->{"d$i"}).'</a></td><td><input type="text" id="d'.($i+1).'" name="d'.$i.'" maxlength="10" onkeyup="mil('.($i+1).');"></td>';
	}else{print '<td colspan="3"></td>';}
	print '<td><a onclick="max('.($i+1).');">max</a></td></tr>';
	}
}

if ($mili <= 0) {
	
}
print '<tr><th colspan="6">Mission: ';
if (!empty($recipient_select)) {
	print '<select name="mission">';
	$m=0;foreach ($missions as $val) {
		if ($max_missions >= $m) {
			print '<option value="'.$m.'">'.$val.'</option>';
			$m++;
		}else{break;}
	}
	print '</select> Target: '.$recipient_select;
}elseif(!empty($intercept)) {
	print $missions[3].'<input type="hidden" name="mission" value="3"><input type="hidden" name="wid" value="'.$intercept.'">';
}elseif(!empty($reinforce)) {
	print $missions[2].'<input type="hidden" name="mission" value="2"><input type="hidden" name="wid" value="'.$reinforce.'">';
}else{
	print 'Unknown';
}
print ' <input type="submit" value="Send Army"></th></tr><table><script src="script.php?war&ac"></script>';
//SELECT SEND ARMY
}
}//no mission and in_war < max

print '</td></tr></table></form>';

/*
foreach ($row as $key=>$val) {
	if (strlen($key) <= 3) {
		if ($key !== 'id' and $key !== 'sex') {
			print $key.' ';
			$to_update .= ", $key=5";
		}
	}
}
*/

/*
if($presult = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE (`charname`!='$row->charname' and `j2`<='$current_time' and `j3`<='$mac') ORDER BY `charname` ASC LIMIT 100")){
	if(mysqli_num_rows($presult) >= 1) {
		while ($prow = mysqli_fetch_object ($presult)) {
			print $prow->id.' '.$prow->charname.'<br>';
		}
	}
mysqli_free_result ($presult);
}
*/
require_once 'admin/game.footer.php';?>