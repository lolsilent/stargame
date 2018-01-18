<?php
#!/usr/local/bin/php
/*_______________-=TheSilenT.CoM=-_________________*/

function update_game() {
	global $tbl_members,$current_time,$uptime,$txt_productionman,$military_units,$mac,$military_units_names,$goldinterest,$tbl_messages,$link;

if ($uresult = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE (`updater`<=$current_time-$uptime) ORDER BY `id` DESC LIMIT 10000")) {
	while ($urow = mysqli_fetch_object ($uresult)) {
		$update_it ="`updater`=$current_time";
		$message ='';
		$capacity=array(0,0,0,0,0,0,0,0,0,0);//9
		$have=array(0,0,0,0,0,0,0,0,0,0);//9
		$produced=array(0,0,0,0,0,0,0,0,0,0);//9
		$used=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);//14 10,11 empty 12,13 desertion 14 empty
		$decayed=array(0,0,0,0,0,0,0,0,0,0);//9
		$emergency=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);//19
		$amounter = floor(($current_time-$urow->updater)/$uptime);

//buildings
for ($i=0;$i<=9;$i++) {
	$used=requiresource($i,$urow,$used,$amounter);
}
//buildings

//military
list ($mil[2],$mil[3]) =military_consumption($urow,$used);
$used[2]+=($amounter*$mil[2]);
$used[3]+=($amounter*$mil[3]);
//military

for ($i=0;$i<=9;$i++) {
	$capacity[$i]=$amounter*(max_resources($i,$urow));
	$have[$i]=$urow->{"a$i"};
	if ($urow->{"b$i"} >= 1) {
		$produced[$i]=$amounter*production($i,$urow);
	}
}

//INTEREST
$interest=0;
if ($urow->b16 >= 1 and $have[9] >= 100) {
	$interest = (($urow->a9/100)*($urow->b16))/$goldinterest;
	if ($have[9]+$interest <= $capacity[9]) {
		$produced[9] += $interest;
	}
}
//INTEREST

//RESOURCE CHECK
/*
if ($produced[3]*2 <= $have[2]) {
	$produced[3]=0;
}
if ($produced[4]*2 <= $have[3]) {
	$produced[4]=0;
}
if ($produced[5]*2 <= $have[3]) {
	$produced[5]=0;
}
if ($produced[6]*2 <= $have[3]) {
	$produced[6]=0;
}
if ($produced[7]*2 <= $have[4] or $produced[7]*2 <= $have[5]) {
	$produced[7]=0;
}
if ($produced[8]*2 <= $have[4] or $produced[8]*2 <= $have[7]) {
	$produced[8]=0;
}
if ($produced[9]*2 <= $have[4] or $produced[9]*2 <= $have[6]) {
	$produced[9]=0;
}
*/
//RESOURCE CHECK

//MAC j3
$upj3=0;
if ($urow->j3 <> 0) {
	if ($amounter >= $mac) {
		$upj3 = 0;
	}else{
		$upj3 = ($urow->j3-(1*$amounter));
		if ($upj3 < 0) {
		$upj3=0;
		}
	}
	$update_it .= ", `j3`='$upj3'";
}
//MAC j3

//VALUE CHANGE DETECTION
for ($i=0;$i<=9;$i++) {
	$change=array(0,0,0,0,0,0,0,0,0,0);

//PRODUCED CAPACITY CHECK
	if ($produced[$i] >= 1) {
		$capacity[$i] = max_resources($i,$urow);
		if ($have[$i]+$produced[$i] > $capacity[$i]) {
			$produced[$i] = $capacity[$i]-$have[$i];
			$emergency[$i]=$txt_productionman[7];
		}

		$have[$i]+=$produced[$i];
		$change[$i]+=$produced[$i];
	}
//PRODUCED CAPACITY CHECK

//USED < HAVE
	if($used[$i] >= 1) {
		if ($used[$i] <= $have[$i]) {
			$have[$i] -= $used[$i];
			$change[$i] -= $used[$i];
		}else{
			$emergency[$i]=$txt_productionman[9];
			//$have[$i]=0;
			//PRODUCE VS HAVE
			if ($i == 2) {
				$produced[3]=0;
			}elseif ($i == 3) {
				$produced[4]=0;$produced[5]=0;$produced[6]=0;
			}elseif ($i == 4) {
				$produced[7]=0;$produced[8]=0;$produced[9]=0;
			}elseif ($i == 5) {
				$produced[7]=0;
			}elseif ($i == 6) {
				$produced[9]=0;
			}elseif ($i == 7) {
				$produced[8]=0;
			}
			//PRODUCE VS HAVE
			//$change[$i] -= $used[$i];		
		}
	}
//USED < HAVE

//DECAYED
if ($have[$i] > $capacity[$i]) {
	$emergency[$i]=$txt_productionman[8];
	$decayed[$i] = floor($have[$i]/100);
	if ($have[$i]-$decayed[$i] < $capacity[$i]) {
		$decayed[$i] = $have[$i]-$capacity[$i];
	}
	if ($decayed[$i] <= $have[$i]) {
		$have[$i] -= $decayed[$i];
		$change[$i] -= $decayed[$i];
	}else{
		$have[$i]=0;
		$change[$i] -= $decayed[$i];		
	}
}
//DECAYED

if ($change[$i] <> 0 and $urow->{"a$i"} <> $have[$i]) {
	$update_it .= ", `a$i`=$have[$i]";
}
//print "pu - $produced[$i]/$used[$i] hc - $have[$i]/$capacity[$i]  dc - $decayed[$i]/$change[$i]<hr>";
}
//VALUE CHANGE DETECTION

//CHECK FOR DESERTION
$total_units = 0;
$deserted='';
//print ($have[2]+$produced[2]).' < '.($amounter*$mil[2]).' or '.($have[3]+$produced[3]).' < '.$amounter*$mil[3];
/*
if ($have[2]+$produced[2] < $amounter*$mil[2] or $have[3]+$produced[3] < $amounter*$mil[3]) {
	//print 'aaaaaaaaaa'.($amounter*$mil[2])/($have[2]+$produced[2]).' '.($amounter*$mil[3])/($have[3]+$produced[3]);
	$emergency[12]=$txt_productionman[12];
	$update_it .= ", `j4`=`j4`-1";
for ($m=0;$m<=19;$m++) {
	if ($urow->{"k$m"}>=2) {
		$total_units += $urow->{"k$m"};
		$deserting=0;
			if ($urow->{"k$m"}>=100) {
				$deserting = ($amounter*($urow->{"k$m"}/100));
				if ($deserting >= $urow->{"k$m"}) {
					$deserting = $urow->{"k$m"};
				}
				$update_it .= ", `k$m`=`k$m`-".$deserting;
				$used[12]+=$amounter*($urow->{"k$m"}/100);
			}else{
				$update_it .= ", `k$m`=`k$m`-1";
				$used[12]++;
			}
			if ($deserting >= 1) {
				$deserted .= ' '.$military_units_names[$m].': '.number_format($deserting).'/'.number_format($urow->{"k$m"});
			}
		}
	}
}
*/
//CHECK FOR DESERTION

if ($urow->j9 <= 0) {
global $a_names;//logging

$message .= '<table><tr><th colspan="8">'.$txt_productionman[0].' '.return_charname($urow->id).'</th></tr><tr><th>'.$txt_productionman[1].'</th><th>'.$txt_productionman[2].'</th><th>'.$txt_productionman[3].'</th><th>'.$txt_productionman[4].'</th><th>'.$txt_productionman[14].'</th><th>'.$txt_productionman[10].'</th><th>'.$txt_productionman[15].'</th><th>'.$txt_productionman[5].'</th></tr>';

for ($i=0;$i<=9;$i++) {
	$results[$i] =$produced[$i]-($used[$i]+$decayed[$i]);
$message .= '<tr class="buildings"><td>'.$a_names[$i].'</td><td>'.number_format($capacity[$i]).'</td><td>'.number_format($have[$i]).'</td><td>'.number_format($produced[$i]).'</td><td>'.number_format($used[$i]).'</td><td>'.number_format($decayed[$i]).'</td><td>'.number_format($results[$i]).'</td><td>'.(!empty($emergency[$i])?'<span class="maxed">'.$emergency[$i].'</span>':'').'</td></tr>';
}

$message .= '<tr class="buildings"><td></td><td>'.number_format(array_sum($capacity)).'</td><td>'.number_format(array_sum($have)).'</td><td>'.number_format(array_sum($produced)).'</td><td>'.number_format(array_sum($used)).'</td><td>'.number_format(array_sum($decayed)).'</td><td>'.number_format(array_sum($results)).'</td><td></td></tr>';

$message .= !empty($interest)?'<tr><th colspan="8">'.$txt_productionman[11].' '.number_format($interest).'</th></tr>':'';
$message .= !empty($emergency[12])?'<tr><th colspan="8" class="maxed">'.$emergency[12].': '.$deserted.' Total: '.number_format($used[12]).'/'.number_format($total_units).'</th></tr>':'';
$message .= '</tr></table>';

//print $message.' '.$update_it.'<hr>';
inject_message($urow->id,$message,0,3);
}

mysqli_query ($link, "UPDATE `$tbl_members` SET $update_it WHERE `id`='$urow->id' LIMIT 1") or die_nice(mysqli_error($link).' Game update 1!'.$update_it);

//REMOVE OLD MESSAGES

if($mresult=mysqli_query ($link, "SELECT `id` FROM `$tbl_messages` WHERE (`timer`<'".($current_time-2500)."' AND `rid`=0) ORDER BY `id` DESC LIMIT 1")){

if (mysqli_num_rows($mresult) >= 1) {
mysqli_query ($link, "DELETE FROM `$tbl_messages` WHERE (`timer`<'".($current_time-2500)."' AND `rid` = 0) LIMIT 10000") or die(mysqli_error($link));
}
mysqli_free_result ($mresult);

}

//REMOVE OLD MESSAGES

	}//while
	mysqli_free_result ($uresult);
}//if


for ($i=0;$i<=19;$i++) {
//UPDATE BUILDINGS
mysqli_query ($link, "UPDATE `$tbl_members` SET `b$i`=`b$i`+1,`f$i`=0 WHERE (`f$i` >= 1 AND `f$i`<=$current_time) LIMIT 100000") or die_nice(mysqli_error($link).' Game update mass!');
//UPDATE SCIENCE
mysqli_query ($link, "UPDATE `$tbl_members` SET `c$i`=`c$i`+1,`g$i`=0 WHERE (`g$i` >= 1 AND `g$i`<=$current_time) LIMIT 10000") or die_nice(mysqli_error($link).' Game update mass!');
//UPDATE military
mysqli_query ($link, "UPDATE `$tbl_members` SET `k$i`=`k$i`+1,`l$i`=0 WHERE (`l$i` >= 1 AND `l$i`<=$current_time) LIMIT 10000") or die_nice(mysqli_error($link).' Game update mass!');
//UPDATE offence
mysqli_query ($link, "UPDATE `$tbl_members` SET `d$i`=`d$i`+1,`h$i`=0 WHERE (`h$i` >= 1 AND `h$i`<=$current_time) LIMIT 10000") or die_nice(mysqli_error($link).' Game update mass!');
//UPDATE defence
mysqli_query ($link, "UPDATE `$tbl_members` SET `e$i`=`e$i`+1,`i$i`=0 WHERE (`i$i` >= 1 AND `i$i`<=$current_time) LIMIT 10000") or die_nice(mysqli_error($link).' Game update mass!');
}


}

/*_______________-=TheSilenT.CoM=-_________________*/

?>