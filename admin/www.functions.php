<?php
#!/usr/local/bin/php
/*_______________-=TheSilenT.CoM=-_________________*/
function inject_message($player_id,$message,$importance,$status) {
global $tbl_messages,$fld_messages,$gid,$current_date,$current_time,$link;
mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$player_id', '0', '$message', '$importance', '$status', '$current_date', $current_time-1, $current_time)") or die_nice(mysqli_error($link));
}

/*_______________-=TheSilenT.CoM=-_________________*/

function player_resources($row) {
	global $a_names;
print '<table width="100%">';
for ($i=0;$i<=9;$i++) {
	$max_resources=max_resources($i,$row);
	//if ($row->{"a$i"} >= 1) {
		print '<th'.($row->{"a$i"}<$max_resources?'':' class="maxed"').'><font size="-2">'.$a_names[$i].'<br><span id="xxr'.($i+1).'">'.number_format($row->{"a$i"}).'</span></font></th>';
	//}
}
print '</table>';
}

/*_______________-=TheSilenT.CoM=-_________________*/

function max_resources($i,$row) {
$r=1.2;
if ($i== 0 or $i == 1 or $i == 10) {
	$r=(1+$row->b10)*pow(1.28,$row->b10);
}elseif ($i== 2 or $i == 11) {
	$r=(1+$row->b11)*pow(1.21,$row->b11);
}elseif ($i== 3 or $i == 12) {
	$r=(1+$row->b12)*pow(1.23,$row->b12);
}elseif ($i== 4 or $i == 5 or $i == 6 or $i == 13) {
	$r=(1+$row->b13)*pow(1.35,$row->b13);
}elseif ($i== 7 or $i == 14) {
	$r=(1+$row->b14)*pow(1.15,$row->b14);
}elseif ($i== 8 or $i == 15) {
	$r=(1+$row->b15)*pow(1.12,$row->b15);
}elseif ($i== 9 or $i == 16) {
	$r=(1+$row->b16)*pow(1.11,$row->b16);
}
$r=($r*1000);
return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

$allow_HTTP_REFERER =array(
			"https://thesilent.com/",
			"https://thesilent.com/",
			"http://thesilent.com/",
			"http://thesilent.com/",
			"http://localhost/",
			);

$allow_SERVER_ADDR =array(
			'85.214.207.15',
			'109.236.91.114',
			'127.0.0.1',
			);

function validate_referer () {global $allow_SERVER_ADDR,$allow_HTTP_REFERER;
if (empty($_SERVER['HTTP_REFERER'])) {header("Location: https://thesilent.com");exit;}
if (!in_array($_SERVER['SERVER_ADDR'],$allow_SERVER_ADDR)) {header("Location: https://thesilent.com");exit;}
foreach ($allow_HTTP_REFERER as $val) {
$val = addslashes($val);
if (!preg_match("@^$val@si",$_SERVER['HTTP_REFERER'])) {$nogo=1;}
}
if (empty($nogo)) {header("Location: https://thesilent.com");exit;}
}

/*_______________-=TheSilenT.CoM=-_________________*/

function production($i,$row) {
	global $cost_buildings;
	if (!isset($row->{"b$i"})) {$row->{"b$i"}=0;}
	$r = $cost_buildings[$i][2]*$row->{"b$i"}*pow($cost_buildings[$i][3],$row->{"b$i"});
	if ($row->{"c$i"} >= 1) {
		$r /= 100;
		$r *= (100+$row->{"c$i"});
	}
	if ($i <= 9 and $row->{"a".($i+10)} < 100) {
		$r /= 100;
		$r *= $row->{"a".($i+10)};
	}
	return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function requiresource($i,$row,$requiresource,$amounter) {

if ($i == 3) {//farm need water
$requiresource[2]+=$amounter*(production($i,$row)*2);
}

if ($i == 4 or $i == 5 or $i == 6) {//mines need food
$requiresource[3]+=$amounter*(production($i,$row)*2);
}

if ($i == 7 or $i == 8 or $i == 9) {//iron smith weapons smith gold smith need coal ore
$requiresource[4]+=$amounter*(production($i,$row)*2);
}

if ($i == 7) {//iron smith need iron ore
$requiresource[5]+=$amounter*(production($i,$row)*2);
}

if ($i == 8) {//weapon smith needs metal
$requiresource[7]+=$amounter*(production($i,$row)*2);
}

if ($i == 9) {//gold smith need gold ore
$requiresource[6]+=$amounter*(production($i,$row)*2);
}

return ($requiresource);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function timer_build($res,$multi) {
	global $row;
	//return 30+floor((($in+($multi*5))*3600*pow(1.5,$in))/2500);
	//$row->b19=15;$row->c19=15;
$r = ($res * 3600) / (2500 * ($row->b19 -1 * -1) * pow(1.11, $row->c19)); 
//$a = ($res * 3600) / (2500+$row->b19+($row->c19*2));
//print "$r - $a<br>";
	if ($row->b19 >= 1) {
		$r /= 100;
		$r *= (100-$row->b19);
	}
	if ($r < 30) {$r=30;}
	return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function timer_research($res,$multi) {
	global $row;
	//return 45+floor((($in+($multi*5))*3600) / (2500*$multi-1*-1)*pow(1.5,(1+$multi)));
$r = ($res * 3600) / (2500 * ($row->b18 -1 * -1) * pow(1.11, $row->c18));

	if ($row->b18 >= 1) {
		$r /= 100;
		$r *= (100-$row->b18);
	}
	if ($r < 30) {$r=30;}
	return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function cost_a0($in,$i) {
	global $row,$cost_buildings;
	$r = ($cost_buildings[$i][0]*pow($cost_buildings[$i][4], $in - 1));
	if ($row->b18 >= 1) {
		$r /= 100;
		$r *= (100-$row->b18);
	}
	return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function cost_a1($in,$i) {
	global $row,$cost_buildings;
	$r=floor($cost_buildings[$i][1]*pow($cost_buildings[$i][4], $in - 1));
	if ($row->b18 >= 1) {
		$r /= 100;
		$r *= (100-$row->b18);
	}
	return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function cost_a9($in,$i) {
	global $row,$cost_science;
	//$r=floor($cost_science[$i][0]*pow(1.111, $in - 1));
	$r=$cost_science[$i][0]*pow($cost_science[$i][1], $in - 1);
	if ($row->b18 >= 1) {
		$r /= 100;
		$r *= (100-$row->b18);
	}
	if ($r < 30) {$r=30;}
	return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function cost_research($in,$i) {
	global $row,$cost_science;
	$r=$cost_science[$i][0]*pow($cost_science[$i][1], $in - 1);
	if ($row->b18 >= 1) {
		$r /= 100;
		$r *= (100-$row->b18);
	}
	if ($r < 30) {$r=30;}
	return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function clockit ($s) {
	//$s= 3661;print $s.' ';
	if ($s < 1) {$s=1;}
	$c='';
	if ($s < 0) {$s=0;}
	if ($s >= 3600) {
	$n=(int)($s/3600);
	$c.=($n<=9?'0'.$n:$n);
	$s %= 3600;
	}else {$c.='00';}
		$c .= ':';
	if ($s >= 60) {
	$n=(int)($s/60);
	$c.=($n<=9?'0'.$n:$n);
	$s %= 60;	
	}else {$c.='00';}
		$c .= ':';
	if ($s <= 9) {
	$c .= '0'.$s;
	}else {$c .= $s;}
	return $c;
}

/*_______________-=TheSilenT.CoM=-_________________*/
$search=array("'fuck'i","'nigger'i","'vagina'i","'pussy'i","'penis'i");
$replace=array("","","","","","","","","","",);

function clean_post($in){
	global $search,$replace;
$in=preg_replace($search,$replace,$in);
$in=htmlentities($in,ENT_QUOTES);
$in=strip_tags($in);
$in=trim($in);
$in=addslashes($in);
return $in;
}

/*_______________-=TheSilenT.CoM=-_________________*/

function die_nice($in) {
	include_once 'admin/template.header.php';
print '<table width="100%" cellpadding="0" cellspacing="1" border="0" align="center" height="75%"><tr><td align="center" valign="center"><form method="post" action="index.php"><input type="submit" value="Home" style="width:150;height:50;"></form><form method="post" action="logout.php"><input type="submit" value="Logout" style="width:150;height:50;"></form>
Error code '.$in.'<br>Problems with login? Try logout.<br>';
if (!empty($_COOKIE)){
foreach ($_COOKIE as $key=>$val){print '_COOKIE '.$key.' '.$val.'<br>';}
}
if (!empty($_GET)){
foreach ($_GET as $key=>$val){print '_GET '.$key.' '.$val.'<br>';}
}
if (!empty($_POST)){
foreach ($_POST as $key=>$val){print '_POST '.$key.' '.$val.'<br>';}
}
/*if (!empty($_SERVER)){
foreach ($_SERVER as $key=>$val){print '_SERVER '.$key.' '.$val.'<br>';}
}*/
print '</td></tr></table></center>';

	include_once 'admin/template.footer.php';
exit;
}

/*_______________-=TheSilenT.CoM=-_________________*/

function sk($key) {

		$sk=0;
		if (strlen($key) == 2) {
			$sk = substr($key,-1);
		}elseif(strlen($key) == 3) {
			$sk = substr($key,-2);
		}
		if ($sk < 0 or $sk > 19) {
			$sk=0;
		}
return $sk;
}

/*_______________-=TheSilenT.CoM=-_________________*/

function imagine($in) {
$filename='images/'.$in.'.jpg';
if (!file_exists($filename)) {
	$filename='images/default'.rand(1,9).'.jpg';	
}

return '<img src="'.$filename.'" width="100" height="100" border="0">';
}

/*_______________-=TheSilenT.CoM=-_________________*/
/*
function imagine_google($in) {
	global $row;
$url = file_get_contents('https://images.google.com/images?hl=en&safe=on&q='.$in,'r');
$url = explode("dyn.Img",$url);
$url = preg_grep("/^\(.*?\)\;$/", $url);
	//print_r($url);print '<hr>';
$max=count($url);
$rander = rand(1,$max);
if (isset($url[$rander])) {
$image = explode("\",\"",$url[$rander]);
array_walk($image, 'trim');
	//print_r($image);print '<hr>';
if ($row->j12 == 0) {
	$filename=$image[3]; //original from site
}else{
	$filename=preg_replace("@ @si","",$image[14].'?q=tbn:'.$image[2].$image[3]);//from google thumbs
}
//print '<img src="'.$filename.'" width="100" height="100">';
return $filename;
}
}
*/
/*_______________-=TheSilenT.CoM=-_________________*/

function imagine_bg($in) {
	if ($in == 0) {
		$filename='images/bg'.rand(0,52).'.jpg';
	}else{
		$filename='images/bg'.date("j").'.jpg';
	}
	if (!file_exists($filename)) {
		$filename='images/bg'.date("j").'.jpg';	
	}
	//$filename='images/bg55.jpg';
return $filename;
}

/*_______________-=TheSilenT.CoM=-_________________*/


function in_build($row) {
	global $current_time;
$in_build = 0;
for ($i=0;$i<=19;$i++) {
	if ($row->{"f$i"} >= $current_time) {$in_build++;}//buildings
	//if ($row->{"h$i"} >= $current_time) {$in_build++;}//offence moved to pets training
	if ($row->{"i$i"} >= $current_time) {$in_build++;}//defence
}
return $in_build;
}

/*_______________-=TheSilenT.CoM=-_________________*/

function merchant_cargo($in) {
	return floor(($in*5000)*pow(1.3,$in));
}

/*_______________-=TheSilenT.CoM=-_________________*/

function merchant_max($row) {
global $tbl_merchant,$tbl_trade,$link;
$r=0;
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_merchant` WHERE `mid`='$row->id' ORDER BY `id` DESC LIMIT 50")) {
$r += mysqli_num_rows ($meresult);
mysqli_free_result ($meresult);
}
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_trade` WHERE `mid`='$row->id' ORDER BY `id` DESC LIMIT 50")) {
$r += mysqli_num_rows ($meresult);
mysqli_free_result ($meresult);
}
return $r;
}

/*_______________-=TheSilenT.CoM=-_________________*/

function merchant_carry($merow) {
global $a_names;
$r='';
for ($i=0;$i<=9;$i++) {
	if ($merow->{"a$i"} >= 1) {
		$r.= $a_names[$i].': '.number_format($merow->{"a$i"}).' ';
	}
}
return $r;
}

/*_______________-=TheSilenT.CoM=-_________________*/

function merchant_check() {
	global $tbl_merchant,$tbl_members,$tbl_messages,$gid,$current_date,$current_time,$txt_merchant,$link;
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_merchant` WHERE `timer`<= $current_time ORDER BY `id` ASC LIMIT 100")){
	if(mysqli_num_rows($meresult) >= 1) {
		while ($merow = mysqli_fetch_object ($meresult)) {
			mysqli_query ($link, "DELETE FROM `$tbl_merchant` WHERE `id`='$merow->id' LIMIT 1");
$up_date = '';
for ($i=0;$i<=9;$i++) {
	if ($merow->{"a$i"} >= 1) {
		if (!empty($up_date)) {$up_date .= ", ";}
		$up_date .= "`a$i`=`a$i`+".$merow->{"a$i"};
	}
}
if (!empty($up_date)) {
	mysqli_query ($link, "UPDATE `$tbl_members` SET $up_date WHERE `id`='$merow->rid' LIMIT 1") or die_nice(mysqli_error($link).' CODE '.$up_date);
	$message = merchant_carry($merow).'
	'.$txt_merchant[12];

	if ($merow->rid == $merow->mid) {
		mysqli_query ($link, "INSERT INTO `$tbl_messages` VALUES (NULL, '$gid', '$merow->mid', '0', '$txt_merchant[10]: $message
		$txt_merchant[15]', '0', '6', '$current_date', $current_time+1, $current_time)") or die_nice(mysqli_error($link));
	}else{
	if(!empty($merow->rid)) {
		$recipient = return_charname($merow->mid);
		mysqli_query ($link, "INSERT INTO `$tbl_messages` VALUES (NULL, '$gid', '$merow->rid', '0', '$txt_merchant[4]: $message 
		$recipient', '0', '6', '$current_date', $current_time+1, $current_time)") or die_nice(mysqli_error($link));
	}
	if(!empty($merow->mid)) {
		mysqli_query ($link, "INSERT INTO `$tbl_messages` VALUES (NULL, '$gid', '$merow->mid', '0', '$txt_merchant[10]: $message
		$txt_merchant[14]', '0', '6', '$current_date', $current_time+1, $current_time)") or die_nice(mysqli_error($link));
	}
	}

	
}
		}
		mysqli_free_result ($meresult);
	}
}

}

/*_______________-=TheSilenT.CoM=-_________________*/

function return_charname($in) {
	global $tbl_members,$link;
	$r='Unknown';
if($mresult = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE `id`='$in' ORDER BY `id` ASC LIMIT 1")){
	if(mysqli_num_rows($mresult) >= 1) {
		//print 'AAAAAAAAAAAAA';
		if ($mrow = mysqli_fetch_object ($mresult)) {
		mysqli_free_result ($mresult);
		$r = (!empty($mrow->clan)?'['.$mrow->clan.'] ':'').$mrow->sex.' '.$mrow->charname;
		}
	}
}
return $r;
}

/*_______________-=TheSilenT.CoM=-_________________*/

function travel_time($in) {
 $r=1000-pow(1.3,$in);
 if ($r < 10){$r=10;}
 return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function merchant_callback ($in,$tbl_merchant) {
	global $current_time,$travel_time,$row,$link;
	if($cmeresult = mysqli_query ($link, "SELECT * FROM `$tbl_merchant` WHERE `id`='$in' and `mid`='$row->id' and `rid`!='$row->id' ORDER BY `id` ASC LIMIT 1")){
		if ($cmerow = mysqli_fetch_object ($cmeresult)) {
			mysqli_free_result ($cmeresult);
$callback_time = $travel_time-($cmerow->timer-$current_time);

//print "$cmerow->id $in $callback_time $cmerow->timer ".($current_time+$callback_time)." $current_time ++ ".clockit($callback_time)." ".clockit($cmerow->timer-$current_time)." ".clockit($travel_time)." ";

$set_it = "`timer`=".($current_time+$callback_time);

if ($cmerow->mid !== $cmerow->rid) {
$set_it .= ", `rid`='$row->id'";
}

mysqli_query ($link, "UPDATE `$tbl_merchant` SET $set_it WHERE `id`='$cmerow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR');

		}
	}
}

/*_______________-=TheSilenT.CoM=-_________________*/

function military_offence_power($in) {
	global $military_units;
	return pow($military_units[$in][3],$military_units[$in][4])+array_sum($military_units[$in]);
}

function military_defence_power($in) {
	global $military_units;
	return pow($military_units[$in][2],$military_units[$in][4])+array_sum($military_units[$in]);
}

function timer_military($in,$amo) {
global $military_units,$row;
$r = pow($military_units[$in][2]+$military_units[$in][3],$military_units[$in][4])+array_sum($military_units[$in])*$amo;
	if ($row->c17 >= 1) {
		$r /= 100;
		$r *= (100-$row->c17);
	}

return floor($r);
}

function military_training($row) {
global $current_time;
$r=0;
for ($i=0;$i<=19;$i++) {
	if ($row->{"l$i"} > $current_time) {$r++;}//military
	if ($row->{"h$i"} > $current_time) {$r++;}//offence
}
return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function defence_defence_power($in) {
	global $defence_units;
	return $defence_units[$in][0]+($defence_units[$in][1]*2)+($defence_units[$in][2]*3)+($defence_units[$in][3]*4);
}
function timer_defence($in,$amo) {
global $defence_units;
return $defence_units[$in][0]+($defence_units[$in][1]*2)+($defence_units[$in][2]*3)+($defence_units[$in][3]*4)*$amo;
}
function defence_training($row) {
global $current_time;
$r=0;
for ($i=0;$i<=19;$i++) {
	if ($row->{"i$i"} > $current_time) {
		$r++;
	}
}
return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function offence_offence_power($in) {
	global $offence_units;
	return $offence_units[$in][0]+($offence_units[$in][1]*2)+($offence_units[$in][2]*3)+($offence_units[$in][3]*4);
}
function timer_offence($in,$amo) {
global $offence_units;
return $offence_units[$in][0]+($offence_units[$in][1]*2)+($offence_units[$in][2]*3)+($offence_units[$in][3]*4)*$amo;
}
function offence_training($row) {
global $current_time;
$r=0;
for ($i=0;$i<=19;$i++) {
	if ($row->{"h$i"} > $current_time) {
		$r++;
	}
}
return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function total_offence($row) {
	$total_offence=0;
for ($i=0;$i<=19;$i++) {
if (isset($row->{"k$i"}) and $row->{"k$i"} >=1) {
	$total_offence+=military_offence_power($i)*$row->{"k$i"};
if (isset($row->{"d$i"}) and $row->{"d$i"} >=1) {
	$total_offence+offence_offence_power($i)*$row->{"d$i"};
}
}
}
return floor($total_offence);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function total_defence($row) {
	$total_defence=0;
for ($i=0;$i<=19;$i++) {
if (isset($row->{"k$i"}) and $row->{"k$i"} >=1) {
	$total_defence+=military_defence_power($i)*$row->{"k$i"};
if (isset($row->{"e$i"}) and $row->{"e$i"} >=1) {
	$total_defence+=defence_defence_power($i)*$row->{"k$i"};
}
}
}
return floor($total_defence);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function attack_timer($row) {
 $r=(3600*3)-pow(1.3,$row->c15);//3600

if ($row->c15 >= 1) {
	$r /= 100;
	$r *= (100-$row->c15);
}
 if ($r < 10){$r=10;}
 return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function mission_timer($in) {
	global $mission_timer;
 $r=$mission_timer[$in];
 if ($r < 10){$r=10;}
 return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function in_war($in) {
global $tbl_war,$link;
$r=0;
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_war` WHERE `mid`='$in' ORDER BY `id` DESC LIMIT 500")) {
$r += mysqli_num_rows ($meresult);
mysqli_free_result ($meresult);
}
return floor($r);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function military_troops($irow,$header){
	global $military_units_names,$o_names,$missions,$a_names;
	//print_r($irow);
	//$r = $irow->id.($irow->wid>0?': '.$irow->wid:'').': '.$missions[$irow->mission].': ';
	$r = (isset($irow->mission)?'Mission :'.$irow->id.': '.$missions[$irow->mission].' '.($irow->wid>0?':'.$irow->wid:'').': ':'');
if (!empty($header)) {
	if ($irow->mid !== $irow->rid) {
		$r .= return_charname($irow->mid);
	}
	if ($irow->mid !== $irow->rid and $irow->wid == 0) {
		$r .= ' versus '.return_charname($irow->rid).': ';
	}elseif($irow->mid == $irow->rid){
		$r .= 'Returning: ';
	}
}

	for($i=0;$i<=19;$i++){
		if (isset($irow->{"k$i"}) and $irow->{"k$i"}>=1) {
			$r .= ' '.$military_units_names[$i].': '.number_format($irow->{"k$i"});
			if (isset($irow->{"d$i"}) and $irow->{"d$i"}>=1) {
				$r .= ' '.$o_names[$i].': '.number_format($irow->{"d$i"});
			}
		}
	}
	for($i=0;$i<=9;$i++){
		if (isset($irow->{"a$i"}) and $irow->{"a$i"}>=1) {
			if (empty($cargo)) {
				$r .= '<br><br>Resource: ';
				$cargo=1;
			}
			$r .= ' '.$a_names[$i].': '.number_format($irow->{"a$i"});
		}
	}
return $r;
}

/*_______________-=TheSilenT.CoM=-_________________*/
function military_callback ($cmerow,$travel_time) {
global $current_time,$tbl_war,$link;

$set_it='';
if ($cmerow->timer >= $current_time) {
	$callback_time = $travel_time-($cmerow->timer-$current_time);
}else{
	$callback_time = $travel_time;
}

if ($cmerow->mission == 2 or $cmerow->mission == 3) {
	$callback_time = mission_timer($cmerow->mission)-($cmerow->timer-$current_time);
	$set_it = "`mtimer`='0',`wid`='0',";
}

$set_it .= "`timer`=".($current_time+$callback_time);

if ($cmerow->mid !== $cmerow->rid) {
$set_it .= ", `rid`='$cmerow->mid'";
}

mysqli_query ($link, "UPDATE `$tbl_war` SET $set_it WHERE `id`='$cmerow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR callback');

}
/*_______________-=TheSilenT.CoM=-_________________*/
function military_consumption($row) {
	global $military_units;
	$r[2]=0;
	$r[3]=0;
for ($i=0;$i<=19;$i++) {
	if ($row->{"k$i"}>=1) {
		$r[2]+=$military_units[$i][0]*$row->{"k$i"};
		$r[3]+=$military_units[$i][1]*$row->{"k$i"};
		if ($row->c14 >= 1) {
			$r[2]=($r[2]/100)*(100-$row->c14);
			$r[3]=($r[3]/100)*(100-$row->c14);
		}
	}
}
return array(floor($r[2]),floor($r[3]));
}

/*_______________-=TheSilenT.CoM=-_________________*/

?>