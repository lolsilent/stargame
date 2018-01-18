<?php
#!/usr/local/bin/php
/*
mysqli_query ($link, "INSERT INTO `$tbl_war` (`id`, `mid`, `rid`, `wid`, `mission`, `timer`, `mtimer`, `k0`, `k1`, `k2`, `k3`, `k4`, `k5`, `k6`, `k7`, `k8`, `k9`, `k10`, `k11`, `k12`, `k13`, `k14`, `k15`, `k16`, `k17`, `k18`, `k19`, `d0`, `d1`, `d2`, `d3`, `d4`, `d5`, `d6`, `d7`, `d8`, `d9`, `d10`, `d11`, `d12`, `d13`, `d14`, `d15`, `d16`, `d17`, `d18`, `d19`, `a0`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`) VALUES 
('', ".rand(1,5).", 1, 0, ".rand(0,1).", $current_time+10, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', 1, ".rand(1,5).", 0, ".rand(0,1).", $current_time+20, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', ".rand(1,5).", 1, 0, ".rand(0,1).", $current_time+30, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', 1, ".rand(1,5).", 0, ".rand(0,1).", $current_time+40, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', ".rand(1,5).", 1, 0, ".rand(0,1).", $current_time+50, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', 1, ".rand(1,5).", 0, ".rand(0,1).", $current_time+60, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', ".rand(1,5).", 1, 0, ".rand(0,1).", $current_time+70, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', 1, ".rand(1,5).", 0, ".rand(0,1).", $current_time+80, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', ".rand(1,5).", 1, 0, ".rand(0,1).", $current_time+90, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', 1, ".rand(1,5).", 0, ".rand(0,1).", $current_time+100, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)") or die_nice(mysqli_error($link));
*/
//mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id` LIMIT 100");

/*_______________-=TheSilenT.CoM=-_________________*/

function military_check() {
	global $tbl_war,$tbl_members,$tbl_messages,$gid,$current_date,$current_time,$missions,$link;

if($wresult = mysqli_query ($link, "SELECT * FROM `$tbl_war` WHERE `timer`<=$current_time and `mtimer`<=$current_time ORDER BY `id` ASC LIMIT 1000")){
	if(mysqli_num_rows($wresult) >= 1) {
		while ($wrow = mysqli_fetch_object ($wresult)) {
			
			if ($wrow->mid==$wrow->rid){
				//CALLBACK
				mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id`='$wrow->id' LIMIT 1");
				$set_it='';
				foreach ($wrow as $key=>$val) {
					if ($val >= 1) {
						 if (preg_match('@^d@si',$key) or preg_match('@^k@si',$key) or preg_match('@^a@si',$key)) {
						 	if (!empty($set_it)) {
						 		$set_it .= ", ";
						 	}
							$set_it .= "`$key`=`$key`+$val";
						}
					}
				}
				if (!empty($set_it)) {
					//print $set_it.'<br>';
					mysqli_query ($link, "UPDATE `$tbl_members` SET $set_it WHERE `id`='$wrow->mid' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR');
					$message = military_troops($wrow,1);
					inject_message($wrow->mid,$message,0,5);
				}
				//CALLBACK
			}else{

				//ACTIVATE TIME PASSED
				$mission_timer=mission_timer($wrow->mission);
				if ($wrow->timer+$mission_timer <= $current_time){
					$mission_timer=$wrow->timer+$mission_timer;
					$wrow->mtimer=$mission_timer;
					//print 'AAA';
				}else{
					$mission_timer+=$current_time;
					//print 'BBB';
				}
				//ACTIVATE TIME PASSED
				
				if ($wrow->mtimer == 0) {
					//ACTIVATE MISSION
					mysqli_query ($link, "UPDATE `$tbl_war` SET `mtimer`='$mission_timer' WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 1');
					//ACTIVATE MISSION
				}else{
				//EXECUTE MISSION
				//print_r($wrow);

$orow='';
if ($wrow->mission == 2 or $wrow->mission == 3) {
if($oresult = mysqli_query ($link, "SELECT * FROM `$tbl_war` WHERE `id`='$wrow->wid' ORDER BY `id` ASC LIMIT 1")){
	if(mysqli_num_rows($oresult) >= 1) {
		if ($orow = mysqli_fetch_object ($oresult)) {
			mysqli_free_result($oresult);
		}
	}
}
}else{
if($oresult = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE `id`='$wrow->rid' ORDER BY `id` ASC LIMIT 1")){
	if(mysqli_num_rows($oresult) >= 1) {
		if ($orow = mysqli_fetch_object ($oresult)) {
			mysqli_free_result($oresult);
		}
	}
}
}
						
				if ($wrow->mission == 0) {
					//SPY REPORT
spy_report($wrow,$orow);
					//SPY REPORT
				}elseif ($wrow->mission == 1) { // == test >=
					//PLUNDER ATTACK
plunder_attack($wrow,$orow);
					//PLUNDER ATTACK
				}elseif ($wrow->mission == 2) {
					//REINFORCEMENTS wrow->wid
reinforcements($wrow,$orow);
					//REINFORCEMENTS wrow->wid
				}elseif ($wrow->mission == 3) {
					//INTERCEPT wrow->wid
intercept($wrow,$orow);
					//INTERCEPT wrow->wid
				}
				//EXECUTE MISSION
				}//mtimer on
			}
			//print_r($wrow);
		}
		mysqli_free_result($wresult);
	}
}

}
/*_______________-=TheSilenT.CoM=-_________________*/
function engage ($wrow,$orow,$battle) {
	global $military_units_names,$defence_units_names,$o_names;
for ($i=0;$i<=19;$i++) {
	$ddd=0;
	if ($wrow->{"k$i"} >= 1) {
		$ddd=military_offence_power($i)*$wrow->{"k$i"};
		$pets=0;if (isset($wrow->{"d$i"}) and $wrow->{"d$i"} >= 1) {
			if ($wrow->{"d$i"} >= $wrow->{"k$i"}) {
				$pets=$wrow->{"k$i"};
			}else{
				$pets=$wrow->{"d$i"};
			}
			$ddd += offence_offence_power($i)*$pets;
		}
$battle .= '<span class="attacker">'.$military_units_names[$i].': '.number_format($wrow->{"k$i"}).($pets >= 1?' '.$o_names[$i].': '.number_format($pets):'').' Strikes for '.number_format($ddd).' </span>';
		for ($j=0;$j<=19;$j++) {
			$eee=0;
			if (isset($orow->{"k$j"}) and $orow->{"k$j"} >= 1) {
				$eee=military_defence_power($j)*$orow->{"k$j"};
				$pets=0;if (isset($orow->{"e$j"}) and $orow->{"e$j"} >= 1) {
					if ($orow->{"e$j"} >= $orow->{"k$j"}) {
						$pets=$orow->{"k$j"};
					}else{
						$pets=$orow->{"e$j"};
					}
					$eee += defence_defence_power($j)*$pets;
				}
$battle .= '<span class="defender">'.$military_units_names[$j].': '.number_format($orow->{"k$j"}).($pets >= 1?' '.$defence_units_names[$j].': '.number_format($pets):'').' Blocks for '.number_format($eee).' </span>';

				if ($ddd >= $eee) {//def more off lose more
					//$battle .= 'AAAAA';
					$dper = floor(($ddd/$eee)*100);
					$battle .= number_format($dper).'%';
					if ($orow->{"k$j"} <= 10) {
						$killed = $orow->{"k$j"};
					}else{
						if ($dper >= 100) {
							$killed = $orow->{"k$j"};
						}elseif($dper > 1){
							$killed = floor(($orow->{"k$j"}/100)*(100-$dper));
						}
					}

				$dkilled=floor($killed/2);
				$battle .= ' <span class="attacker">RIP: '.number_format($dkilled).'</span> <span class="defender">RIP: '.number_format($killed).'</span> ';	

				if (isset($orow->{"e$j"}) and $orow->{"e$j"} >= 1) {
					if ($orow->{"e$j"} >= $killed) {
						$orow->{"e$j"} -= $killed;
						
					}else{
						$orow->{"e$j"} -= 0;
						$killed -= $orow->{"e$j"};
					}
				}

				if (isset($orow->{"k$j"}) and $orow->{"k$j"} >= 1) {
					if ($orow->{"k$j"} >= $killed) {
						$orow->{"k$j"} -= $killed;
					}else{
						$orow->{"k$j"} -= 0;
						$killed -= $orow->{"k$j"};
					}
				}
				
				if (isset($wrow->{"d$j"}) and $wrow->{"d$j"} >= 1) {
					if ($wrow->{"d$j"} >= $dkilled) {
						$wrow->{"d$j"} -= $dkilled;
					}else{
						$wrow->{"d$j"} -= 0;
						$dkilled -= $wrow->{"d$j"};
					}
				}

				if (isset($wrow->{"k$j"}) and $wrow->{"k$j"} >= 1) {
					if ($wrow->{"k$j"} >= $dkilled) {
						$wrow->{"k$j"} -= $dkilled;
					}else{
						$wrow->{"k$j"} -= 0;
						$dkilled -= $wrow->{"k$j"};
					}
				}
				
				}elseif ($ddd < $eee) {//off more def lose more
					//$battle .= 'BBBBB';
					$eper=floor(($eee/$ddd)*100);
					$battle .= number_format($eper).'%';
					if ($wrow->{"k$j"} <= 10) {
						$killed = $wrow->{"k$j"};
					}else{
						if ($eper >= 100) {
							$killed = $wrow->{"k$j"};
						}elseif($eper > 1){
							$killed = floor(($wrow->{"k$j"}/100)*(100-$eper));
						}
					}

				$dkilled=floor($killed/2);
				$battle .= ' <span class="attacker">RIP: '.number_format($dkilled).'</span> <span class="defender">RIP: '.number_format($killed).'</span> ';	

				if (isset($wrow->{"e$j"}) and $wrow->{"e$j"} >= 1) {
					if ($wrow->{"e$j"} >= $killed) {
						$wrow->{"e$j"} -= $killed;
					}else{
						$wrow->{"e$j"} -= 0;
						$killed -= $wrow->{"e$j"};
					}
				}

				if (isset($wrow->{"k$j"}) and $wrow->{"k$j"} >= 1) {
					if ($wrow->{"k$j"} >= $killed) {
						$wrow->{"k$j"} -= $killed;
					}else{
						$wrow->{"k$j"} -= 0;
						$killed -= $wrow->{"k$j"};
					}
				}
				
				if (isset($orow->{"d$j"}) and $orow->{"d$j"} >= 1) {
					if ($orow->{"d$j"} >= $dkilled) {
						$orow->{"d$j"} -= $dkilled;
					}else{
						$orow->{"d$j"} -= 0;
						$dkilled -= $orow->{"d$j"};
					}
				}

				if (isset($orow->{"k$j"}) and $orow->{"k$j"} >= 1) {
					if ($orow->{"k$j"} >= $dkilled) {
						$orow->{"k$j"} -= $dkilled;
					}else{
						$orow->{"k$j"} -= 0;
						$dkilled -= $orow->{"k$j"};
					}
				}
								
				}
			}
			$ddd -= $eee;
			if ($ddd <= 0) {
				break;
			}elseif($ddd > $eee/10) {
				//$battle .= "$ddd > $eee/10";
			}
		}//for j
	}
	//$battle .= '<br>';
}//for i
return array($wrow,$orow,$battle);
}
/*_______________-=TheSilenT.CoM=-_________________*/
function simulate_battle($wrow,$orow) {
//global $military_units_names,$defence_units_names,$o_names;

$dtotal_offence=total_offence($wrow);
$dtotal_defence=total_defence($wrow);
$dcargo=($dtotal_offence+$dtotal_defence)/1.5;

$ototal_offence=total_offence($orow);
$ototal_defence=total_defence($orow);
$ocargo=($ototal_offence+$ototal_defence)/1.5;

//BEFORE
$battle='<table><tr><th '.($dtotal_offence+$dtotal_defence>$ototal_offence+$ototal_defence?'class="attacker"':'class="defender"').'>Attacker: '.return_charname($wrow->mid).'</th><th '.($dtotal_offence+$dtotal_defence>$ototal_offence+$ototal_defence?'class="attacker"':'class="defender"').'>Defender: '.return_charname($wrow->rid).'</th></tr>';

$battle .= '<tr><th colspan="2">Before Battle Analysis</th></tr>';

$battle .= '<tr class="buildings"><td valign="top">Total Offence: '.number_format($dtotal_offence).' Total Defence: '.number_format($dtotal_defence).'</td><td valign="top">Total Offence: '.number_format($ototal_offence).' Total Defence: '.number_format($ototal_defence).'</td></tr>';

$battle .= '<tr class="buildings"><td valign="top">'.military_troops($wrow,0).'</td>';
$battle .= '<td valign="top">'.military_troops($orow,0).'</td></tr>';
//BEFORE
//BATTLEFIELD
$battle .= '<tr><th colspan="2">Battlefield Analysis</th></tr>';

$battle .= '<tr class="buildings"><td valign="top" colspan="2">';
		if ($dtotal_offence >= $ototal_defence) {//strikes first
list ($wrow,$orow,$battle) = engage ($wrow,$orow,$battle);
		}elseif ($ototal_defence >= $dtotal_offence) {//strikes first
list ($orow,$wrow,$battle) = engage ($orow,$wrow,$battle);
		}//strikes first
$battle .= '</td></tr>';
//BATTLEFIELD
//AFTERMATH
$battle .= '<tr><th colspan="2">Battlefield After Analysis</th></tr>';
$dtotal_offence=total_offence($wrow);
$dtotal_defence=total_defence($wrow);
$dcargo=($dtotal_offence+$dtotal_defence)/1.5;

$ototal_offence=total_offence($orow);
$ototal_defence=total_defence($orow);
$ocargo=($ototal_offence+$ototal_defence)/1.5;

$battle .= '<tr class="buildings"><td valign="top">Total Offence: '.number_format($dtotal_offence).' Total Defence: '.number_format($dtotal_defence).'</td><td valign="top">Total Offence: '.number_format($ototal_offence).' Total Defence: '.number_format($ototal_defence).'</td></tr>';

$battle .= '<tr class="buildings"><td valign="top">'.military_troops($wrow,0).'</td>';
$battle .= '<td valign="top">'.military_troops($orow,0).'</td></tr>';
//AFTERMATH

$battle .= '</table>';


return array($wrow,$orow,$battle);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function spy_report($wrow,$orow) {
global $a_names,$b_names,$b_namesxa,$military_units_names,$tbl_war,$missions,$current_time,$link;
$b_namez=array_merge($b_names,$b_namesxa);

$dtotal_offence=total_offence($wrow);
$dtotal_defence=total_defence($wrow);
$dcargo=($dtotal_offence+$dtotal_defence)/1.5;

$ototal_offence=total_offence($orow);
$ototal_defence=total_defence($orow);
$ocargo=($ototal_offence+$ototal_defence)/1.5;


//print "$wrow->id - $wrow->mission - $dtotal_offence $dtotal_defence - $ototal_offence $ototal_defence<br>";

if (($wrow->k0 >= 1 and $wrow->d0 >= 1) or $dtotal_offence+$dtotal_defence >= ($ototal_offence+$ototal_defence)/10) {
	if ($wrow->k0 >= 19) {
		$wrow->k0=19;
	}
	$message='<table><tr><th colspan="6">Spy Report versus '.return_charname($wrow->rid).'</th></tr>';
	for ($i=0;$i<=$wrow->k0;$i++) {
		$message .= '<tr class="buildings"><td>'.(!empty($a_names[$i])?$a_names[$i]:'Production '.$a_names[$i-10].'%').'</td><td>'.(!empty($orow->{"a$i"})?number_format($orow->{"a$i"}):'0').'</td><td>'.(!empty($b_namez[$i])?$b_namez[$i]:'').'</td><td>'.(!empty($orow->{"b$i"})?number_format($orow->{"b$i"}):'0').'</td><td>'.(!empty($military_units_names[$i])?$military_units_names[$i]:'0').'</td><td>'.(!empty($orow->{"k$i"})?number_format($orow->{"k$i"}):'0').'</td></tr>';
	}
	$message .= '</table>';
	mysqli_query ($link, "UPDATE `$tbl_war` SET `rid`='$wrow->mid',`timer`='$current_time+3600' WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 1');
}else{
	mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 2');
	$message='Failed: '.military_troops($wrow,0);
}
$messager= 'Mission: '.$missions[$wrow->mission].' by: '.return_charname($wrow->mid);
inject_message($wrow->mid,$message,0,5);
inject_message($wrow->rid,$messager,0,5);
}
/*_______________-=TheSilenT.CoM=-_________________*/
function plunder_attack($wrow,$orow) {
global $military_units_names,$a_names,$tbl_members,$tbl_war,$missions,$current_time,$link;

$dtotal_offence=total_offence($wrow);
$dtotal_defence=total_defence($wrow);
$dcargo=($dtotal_offence+$dtotal_defence)/1.5;

$ototal_offence=total_offence($orow);
$ototal_defence=total_defence($orow);
$ocargo=($ototal_offence+$ototal_defence)/1.5;

$messager= 'Forces from '.return_charname($wrow->mid).' sighted.';
if ($dtotal_offence+$dtotal_defence >= ($ototal_offence+$ototal_defence)/25) {
	$message='';
	$plunder_this = "";
	//military
list ($wrow,$orow,$battle) = simulate_battle($wrow,$orow);
	//military


$dtotal_offence=total_offence($wrow);
$dtotal_defence=total_defence($wrow);
$dcargo=($dtotal_offence+$dtotal_defence)/1.5;

$ototal_offence=total_offence($orow);
$ototal_defence=total_defence($orow);
$ocargo=($ototal_offence+$ototal_defence)/1.5;

	//update K D E
$w_up='';
$o_up='';
for ($i=0;$i<=19;$i++) {
if (isset($wrow->{"k$i"})) {
	$w_up .= ",`k$i`=".$wrow->{"k$i"};
}
if (isset($wrow->{"d$i"})) {
	$w_up .= ",`d$i`=".$wrow->{"d$i"};
}
if (isset($wrow->{"e$i"})) {
	$w_up .= ",`e$i`=".$wrow->{"e$i"};
}
if (isset($orow->{"k$i"})) {
	$o_up .= ",`k$i`=".$orow->{"k$i"};
}
if (isset($orow->{"d$i"})) {
	$o_up .= ",`d$i`=".$orow->{"d$i"};
}
if (isset($orow->{"e$i"})) {
	$o_up .= ",`e$i`=".$orow->{"e$i"};
}
}
	//update K D E

if ($dtotal_offence+$dtotal_defence >= $ototal_offence+$ototal_defence) {
	//resource
	$total_plundered=0;
	for ($i=0;$i<=9;$i++) {
		if (isset($orow->{"a$i"}) and $orow->{"a$i"} >= 1) {
			if ($orow->{"a$i"} >= 100 and $dtotal_offence+$dtotal_defence <= $ototal_offence+$ototal_defence and $ocargo > $total_plundered) {
				$plundered = $orow->{"a$i"}/(10-$i);
			} else {
				$plundered = $orow->{"a$i"};
			}
			$message .= ' '.$a_names[$i].': '.number_format($plundered).'/'.number_format($orow->{"a$i"});
			$plunder_this .= ", `a$i`=`a$i`+$plundered";
			$total_plundered += $plundered;
		}
	}
	//resource
}

$o_up .= $plunder_this;
$o_up .= ", `j3`=`j3`+1";
$o_up = preg_replace('@\+@',"-",preg_replace('@^\,@',"",$o_up));

mysqli_query ($link, "UPDATE `$tbl_members` SET $o_up WHERE `id`='$wrow->rid' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR plunder');


	$messager=$battle.$messager.' Lost: '.$message;
	$message=$battle.'Mission: '.$missions[$wrow->mission].' Captured: '.$message;
	$plunder_this = "`rid`='$wrow->mid',`timer`='$current_time+3600'".$plunder_this;
	mysqli_query ($link, "UPDATE `$tbl_war` SET $plunder_this$w_up WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 1');
	
}else{
	mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 2');
	$message='Failed: '.military_troops($wrow,0);
}

inject_message($wrow->mid,$message,0,5);
inject_message($wrow->rid,$messager,0,5);
}
/*_______________-=TheSilenT.CoM=-_________________*/
function reinforcements($wrow,$orow) {
	global $military_units_names,$a_names,$tbl_war,$current_time,$link;
if (!empty($orow) and !empty($orow)) {
	$message= military_troops($wrow,0).' merged with '.military_troops($orow,0);
	
	$setit='';
	for($i=0;$i<=19;$i++){
		if ($wrow->{"k$i"} >= 1) {
			$setit .= ", `k$i`=`k$i`+".$wrow->{"k$i"};
		}
		if ($wrow->{"d$i"} >= 1) {
			$setit .= ", `d$i`=`d$i`+".$wrow->{"d$i"};
		}
	}
	$setit=preg_replace('@^\,@si',"",$setit);

	mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 2');
	mysqli_query ($link, "UPDATE `$tbl_war` SET $setit WHERE `id`='$orow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 1');
}else{
	$message='Mission: '.(isset($wrow->mission)?$missions[$wrow->mission]:'').' Failed! We were lost!';
	mysqli_query ($link, "UPDATE `$tbl_war` SET `rid`='$wrow->mid',`timer`='$current_time+3600',`wid`='0' WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 1');
}
inject_message($wrow->mid,$message,0,5);
}
/*_______________-=TheSilenT.CoM=-_________________*/
function intercept($wrow,$orow) {
global $military_units_names,$a_names,$tbl_war,$missions,$current_time,$link;

$dtotal_offence=total_offence($wrow);
$dtotal_defence=total_defence($wrow);
$dcargo=($dtotal_offence+$dtotal_defence)/1.5;

$ototal_offence=total_offence($orow);
$ototal_defence=total_defence($orow);
$ocargo=($ototal_offence+$ototal_defence)/1.5;

$messager= 'Forces from '.return_charname($wrow->mid).' sighted.';
if ($dtotal_offence+$dtotal_defence >= ($ototal_offence+$ototal_defence)/25) {
	$message='';
	$plunder_this = "";
	//military
list ($wrow,$orow,$battle) = simulate_battle($wrow,$orow);
	//military

$dtotal_offence=total_offence($wrow);
$dtotal_defence=total_defence($wrow);
$dcargo=($dtotal_offence+$dtotal_defence)/1.5;

$ototal_offence=total_offence($orow);
$ototal_defence=total_defence($orow);
$ocargo=($ototal_offence+$ototal_defence)/1.5;

	//update K D E
$w_up='';
$o_up='';
for ($i=0;$i<=19;$i++) {
if (isset($wrow->{"k$i"})) {
	$w_up .= ", `k$i`=".$wrow->{"k$i"};
}
if (isset($wrow->{"d$i"})) {
	$w_up .= ", `d$i`=".$wrow->{"d$i"};
}
if (isset($wrow->{"e$i"})) {
	$w_up .= ", `e$i`=".$wrow->{"e$i"};
}
if (isset($orow->{"k$i"})) {
	$o_up .= ", `k$i`=".$orow->{"k$i"};
}
if (isset($orow->{"d$i"})) {
	$o_up .= ", `d$i`=".$orow->{"d$i"};
}
if (isset($orow->{"e$i"})) {
	$o_up .= ", `e$i`=".$orow->{"e$i"};
}
}
	//update K D E

	//resource
	$total_plundered=0;
	for ($i=0;$i<=9;$i++) {
		if (isset($orow->{"a$i"}) and $orow->{"a$i"} >= 1) {
			if ($orow->{"a$i"} >= 100 and $dtotal_offence+$dtotal_defence <= $ototal_offence+$ototal_defence and $ocargo > $total_plundered) {
				$plundered = $orow->{"a$i"}/(10-$i);
			} else {
				$plundered = $orow->{"a$i"};
			}
			$message .= ' '.$a_names[$i].': '.number_format($plundered).'/'.number_format($orow->{"a$i"});
			$plunder_this .= ", `a$i`=`a$i`+$plundered";
			$total_plundered +=$plundered;
		}
	}
	//resource
if ($ototal_offence+$ototal_defence >= 1) {
 $o_up .= $plunder_this;
 $o_up = preg_replace('@\+@',"-",preg_replace('@^\,@',"",$o_up));
	mysqli_query ($link, "UPDATE `$tbl_war` SET $o_up WHERE `id`='$wrow->wid' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR '.$plunder_this.' '.$o_up);
}else{
	mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id`='$wrow->wid' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 2');
}
	//print 'AAAAAAAAAAAAAA'.$plunder_this.' '.$o_up;


	$messager=$battle.$messager.' Lost: '.$message;
	$message=$battle.'Mission: '.$missions[$wrow->mission].' Captured: '.$message;
	$plunder_this = "`rid`='$wrow->mid',`timer`='$current_time+3600'".$plunder_this;
	mysqli_query ($link, "UPDATE `$tbl_war` SET $plunder_this$w_up WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 1');
	
	
}else{
	mysqli_query ($link, "DELETE FROM `$tbl_war` WHERE `id`='$wrow->id' LIMIT 1") or die_nice(mysqli_error($link).'DB ERROR 2');
	$message='Mission: '.$missions[$wrow->mission].' Failed! Your troops have been slain.';
}

//print_r($wrow);print'<hr>';print_r($orow);print'<hr>';

inject_message($wrow->mid,$message,0,5);
inject_message($wrow->rid,$messager,0,5);
}
/*_______________-=TheSilenT.CoM=-_________________*/
function plunder_food($wrow,$orow) {

}
/*_______________-=TheSilenT.CoM=-_________________*/
function burn_food($wrow,$orow) {

}
/*_______________-=TheSilenT.CoM=-_________________*/
function plunder_ore($wrow,$orow) {

}
/*_______________-=TheSilenT.CoM=-_________________*/
function attack_pets($wrow,$orow) {

}
/*_______________-=TheSilenT.CoM=-_________________*/
function demolish_defence($wrow,$orow) {

}
/*_______________-=TheSilenT.CoM=-_________________*/
function demolish_science($wrow,$orow) {

}
/*_______________-=TheSilenT.CoM=-_________________*/
function demolish_buildings($wrow,$orow) {

}
/*_______________-=TheSilenT.CoM=-_________________*/
function production_sabotage($wrow,$orow) {

}

/*_______________-=TheSilenT.CoM=-_________________*/
function steal_cargo($wrow,$orow) {

}
/*_______________-=TheSilenT.CoM=-_________________*/
?>