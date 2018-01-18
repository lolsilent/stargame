<?php
#!/usr/local/bin/php

/*_______________-=TheSilenT.CoM=-_________________*/

function update_game() {
	global $tbl_members,$current_time,$uptime,$txt_productionman,$military_units,$mac;

if ($uresult = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE (`updater`<=$current_time-$uptime) ORDER BY `id` DESC LIMIT 10000")) {
	while ($urow = mysqli_fetch_object ($uresult)) {
		$update_it ="`updater`=$current_time-500";
		$message ='';
		$capacity=array(0,0,0,0,0,0,0,0,0,0);//9
		$have=array(0,0,0,0,0,0,0,0,0,0);//9
		$produced=array(0,0,0,0,0,0,0,0,0,0);//9
		$used=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);//14 10,11 empty 12,13 desertion 14 empty
		$decayed=array(0,0,0,0,0,0,0,0,0,0);//9
		$emergency=array(0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0);//19
		$amounter = floor(($current_time-$urow->updater)/$uptime);



		//print $amounter.' ';
//MAC j3
if ($urow->j3 >= 1) {
	if ($amounter >= $mac) {
		$upj3 = 0;
	}else{
		$upj3 = ($urow->j3-(1*$amounter));
	}
	$update_it .= ", `j3`='$upj3'";
}
//MAC j3

for ($i=0;$i<=9;$i++) {
	$emergency[$i]='';
	$capacity[$i]=floor($amounter*max_resources($i,$urow));
	$have[$i]=$urow->{"a$i"};
	if ($urow->{"b$i"} >= 1) {
		if ($have[$i] < $capacity[$i]) {
			$produced[$i] = floor(($amounter*production($i,$urow)));
		}

if ($i == 3) {//farm need water
if ($urow->a2 >= 1) {
	if ($urow->a2 <= $produced[$i]){
		$produced[$i]=$urow->a2;
		
	}
$urow->a2-=$produced[$i];
$used[2]+=$produced[$i];
//$update_it .= ", `a2`=`a2`-$produced[$i]";
}else{$produced[$i]=0;}
}

if ($i == 4 or $i == 5 or $i == 6) {//mines need food
if ($urow->a3 >= 1) {
	if ($urow->a3 <= $produced[$i]){
		$produced[$i]=$urow->a3;
		
	}
$urow->a3-=$produced[$i];
$used[3]+=$produced[$i];
//$update_it .= ", `a3`=`a3`-$produced[$i]";
}else{$produced[$i]=0;}
}

//print 'BUILDINGS'.$used[2].' '.$used[3].'<hr>';

if ($i == 7 or $i == 8 or $i == 9) {//smith weapon smith gold smith need coal ore
if ($urow->a4 >= 1) {
	if ($urow->a4 <= $produced[$i]) {
		$produced[$i]=$urow->a4;
		
	}
$urow->a4-=$produced[$i];
$used[4]+=$produced[$i];
//$update_it .= ", `a4`=`a4`-$produced[$i]";
}else{$produced[$i]=0;}
}

if ($i == 7) {//smith need iron ore
if ($urow->a5 >= 1){
	if ($urow->a5 <= $produced[$i]){
		$produced[$i]=$urow->a5;
		
	}
$urow->a5-=$produced[$i];
$used[5]+=$produced[$i];
//$update_it .= ", `a5`=`a5`-$produced[$i]";
}else{$produced[$i]=0;}
}

if ($i == 8) {//weapon smith needs metal
if ($urow->a7 >= 1){
	if ($urow->a7 <= $produced[$i]){
		$produced[$i]=$urow->a7;
		
	}

$urow->a7-=$produced[$i];
$used[7]+=$produced[$i];
//$update_it .= ", `a7`=`a7`-$produced[$i]";
}else{$produced[$i]=0;}
}

if ($i == 9) {//gold smith need gold ore
if ($urow->a6 >= 1){
	if ($urow->a6 <= $produced[$i]){
		$produced[$i]=$urow->a6;
		
	}
$urow->a6-=$produced[$i];
$used[6]+=$produced[$i];
//$update_it .= ", `a6`=`a6`-$produced[$i]";
}else{$produced[$i]=0;}
}

//DECAYED
if ($have[$i] > $capacity[$i]) {
	$emergency[$i]=$txt_productionman[8];
// 1 % decayed when resources kept out of the storage area
	$decayed[$i] = floor($have[$i]/100);
	if ($have[$i]-$decayed[$i] < $capacity[$i]) {
		//10001 > 10000 100 9900 1
		$decayed[$i] = $have[$i]-$capacity[$i];
	}
	$urow->{"a$i"}-=$decayed[$i];
}
//DECAYED

	}//buildings b >= 1

}//FOR buildings

//MILITARY FOOD AND WATER OR DESERTION

$total_units = 0;
	//check for desertion
for ($m=0;$m<=19;$m++) {
	if ($urow->{"k$m"}>=1) {
		$total_units += $urow->{"k$m"};
		$require2now=$amounter*($military_units[$m][0]*$urow->{"k$m"});
		if ($urow->a2+$produced[2] >= $require2now) {
			$used[2]+=$require2now;
		}else{
			$emergency[12]=$txt_productionman[12];
			if ($urow->{"k$m"}>=100) {
				$desertion12 = ($amounter*($urow->{"k$m"}/100));
				if ($desertion12 >= $urow->{"k$m"}) {
					$desertion12 = $urow->{"k$m"};
				}
				$update_it .= ", `k$m`=`k$m`-".$desertion12;
				$used[12]+=$amounter*($urow->{"k$m"}/100);
			}elseif ($urow->{"k$m"}>=10) {
				$update_it .= ", `k$m`=`k$m`-1";
				$used[12]++;
			}
		}
		$require3now=$amounter*($military_units[$m][1]*$urow->{"k$m"});
		if ($urow->a3+$produced[3] >= $require3now) {
			$used[3]+=$require3now;
		}else{
				$emergency[13]=$txt_productionman[13];//print 'AAAAA';
				if ($urow->{"k$m"}>=100) {
					$desertion13 = ($amounter*($urow->{"k$m"}/100));
					if ($desertion13 >= $urow->{"k$m"}) {
						$desertion13 = $urow->{"k$m"};
					}
					$update_it .= ", `k$m`=`k$m`-".$desertion13;
					$used[13]+=$amounter*($urow->{"k$m"}/100);
			}elseif ($urow->{"k$m"}>=10) {
				$update_it .= ", `k$m`=`k$m`-1";
				$used[13]++;
			}
		}
//print "$urow->id $urow->a2 $urow->a3 $require2now $require3now $used[2] $used[3]<br>";
	}
}
	//check for desertion

if ($used[2] >= 1) {
	if ($urow->a2 >= $used[2]) {
		if ($urow->c14 >= 1) {
			$used[2]=($used[2]/100)*(100-$urow->c14);
		}
		$used[2] += $used[2];
	}else{
		$emergency[12]=$txt_productionman[12];
		$used[2] += $urow->a2;
	}
}
if ($used[3] >= 1) {
	if ($urow->a3 >= $used[3]) {
		if ($urow->c14 >= 1) {
			$used[3]=($used[3]/100)*(100-$urow->c14);
		}
		$used[3] += $used[3];
	}else{
		$emergency[13]=$txt_productionman[13];//print 'BBBBB';
		$used[3] += $urow->a3;
	}
}
//MILITARY FOOD AND WATER OR DESERTION
//print 'MILITARY'.$urow->a2.' '.$used[2].' '.$urow->a3.' '.$used[3].'<hr>';

//INTEREST
if ($urow->b16 >= 1 and $urow->a9 >= 51) {
$interest = ($urow->a9/100)*($urow->b16);
if ($urow->a9 <= max_resources(9,$urow)) {
$produced[9] += $interest;
$urow->{"a9"}+=$interest;
//$update_it .= ", `a9`=`a9`+$interest";
}
}
//INTEREST

/*
	$capacity=array(0,0,0,0,0,0,0,0,0,0);
	$have=array(0,0,0,0,0,0,0,0,0,0);
	$produced=array(0,0,0,0,0,0,0,0,0,0);
	$used=array(0,0,0,0,0,0,0,0,0,0);
	$decayed=array(0,0,0,0,0,0,0,0,0,0);
*/

//VALUE CHANGE DETECTION
for ($i=0;$i<=9;$i++) {
	$change=array(0,0,0,0,0,0,0,0,0,0);

	if($used[$i] >= 1) {
		if ($used[$i] <= $have[$i]) {
			$have[$i] -= $used[$i];
			$change[$i] -= $used[$i];
		}else{
			$emergency[$i]=$txt_productionman[9];
			$have[$i]=0;
			$change[$i] -= $used[$i];		
		}
	}
	
	if($decayed[$i] >= 1) {
		if ($decayed[$i] <= $have[$i]) {
			$have[$i] -= $decayed[$i];
			$change[$i] -= $decayed[$i];
		}else{
			$have[$i]=0;
			$change[$i] -= $decayed[$i];		
		}
	}
	
	if ($produced[$i] >= 1) {
		$capacity[$i] = max_resources($i,$urow);
		if (($have[$i]+$produced[$i]) > $capacity[$i]) {
			$produced[$i] = $capacity[$i]-$have[$i];
			$emergency[$i]=$txt_productionman[7];
		}
		$have[$i]+=$produced[$i];
		$change[$i]+=$produced[$i];
	}


if ($change[$i] <> 0) {
	$update_it .= ", `a$i`=$have[$i]";
}
}
//VALUE CHANGE DETECTION

if ($urow->j9 <= 0) {
global $a_names;//logging

$message .= '<table><tr><th colspan="8">'.$txt_productionman[0].' '.return_charname($urow->id).'</th></tr><tr><th>'.$txt_productionman[1].'</th><th>'.$txt_productionman[2].'</th><th>'.$txt_productionman[3].'</th><th>'.$txt_productionman[4].'</th><th>'.$txt_productionman[14].'</th><th>'.$txt_productionman[10].'</th><th>'.$txt_productionman[15].'</th><th>'.$txt_productionman[5].'</th></tr>';

for ($i=0;$i<=9;$i++) {
	$results[$i] =$produced[$i]-($used[$i]+$decayed[$i]);
$message .= '<tr class="buildings"><td>'.$a_names[$i].'</td><td>'.number_format($capacity[$i]).'</td><td>'.number_format($have[$i]).'</td><td>'.number_format($produced[$i]).'</td><td>'.number_format($used[$i]).'</td><td>'.number_format($decayed[$i]).'</td><td>'.number_format($results[$i]).'</td><td>'.(!empty($emergency[$i])?'<span class="maxed">'.$emergency[$i].'</span>':'').'</td></tr>';
}

$message .= '<tr class="buildings"><td></td><td>'.number_format(array_sum($capacity)).'</td><td>'.number_format(array_sum($have)).'</td><td>'.number_format(array_sum($produced)).'</td><td>'.number_format(array_sum($used)).'</td><td>'.number_format(array_sum($decayed)).'</td><td>'.number_format(array_sum($results)).'</td><td></td></tr>';

$message .= !empty($interest)?'<tr><th colspan="8">'.$txt_productionman[11].' '.number_format($interest).'</th></tr>':'';
$message .= !empty($emergency[12])?'<tr><th colspan="8" class="maxed">'.$emergency[12].': '.number_format($used[12]).'/'.number_format($total_units).'</th></tr>':'';
$message .= !empty($emergency[13])?'<tr><th colspan="8" class="maxed">'.$emergency[13].': '.number_format($used[13]).'/'.number_format($total_units).'</th></tr>':'';
$message .= '</tr></table>';

//print $message.' '.$update_it.'<hr>';
inject_message($urow->id,$message,0,3);
}

mysqli_query ($link, "UPDATE `$tbl_members` SET $update_it WHERE `id`='$urow->id' LIMIT 1") or die_nice(mysqli_error($link).' Game update 1!'.$update_it);

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