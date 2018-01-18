<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

//offence d0-19 timer = h0-19
//defence e0-19 timer = i0-19
//military k0-19 timer = l0-19
	
$max_purgeable_units = $row->c11;
$max_training=$row->b15;
$military_training=military_training($row);


//CANCEL
if (!empty($_GET['cancel'])) {
	$cancel = clean_post($_GET['cancel']);
	$sk=sk($cancel);
	if ($row->{"h$sk"} >= $current_time) {
		$cost_a0 = $offence_units[$sk][0];
		$cost_a1 = $offence_units[$sk][1];
		$cost_a7 = $offence_units[$sk][2];
		$cost_a9 = $offence_units[$sk][3];
		$military_training--;
		$to_update .= ", `a0`=`a0`+$cost_a0,`a1`=`a1`+$cost_a1,`a7`=`a7`+$cost_a7,`a9`=`a9`+$cost_a9,`h$sk`='0'";
		$row->{"h$sk"}=0;
		$row->a0+=$cost_a0;
		$row->a1+=$cost_a1;
		$row->a7+=$cost_a7;
		$row->a9+=$cost_a9;
		print '<input type="hidden" id="xxr1a" value="'.$cost_a0.'"><input type="hidden" id="xxr2a" value="'.$cost_a1.'"><input type="hidden" id="xxr8a" value="'.$cost_a7.'"><input type="hidden" id="xxr10a" value="'.$cost_a9.'"><script src="script.php?resourcer&ac"></script>';
	}
}
//CANCEL

if (isset($_GET) and empty($_GET['cancel'])) {
	$total_cost0=0;
	$total_cost1=0;
	$total_cost7=0;
	$total_cost9=0;
foreach ($_GET as $key=>$val) {
	$key = clean_post($key);
	$val = clean_post($val);
//	print "$key $val ".$row->$key." $military_training < $row->b15 ";
	if (isset($row->$key) and $military_training < $row->b15) {
		$sk=sk($key);
		$amount=1;
//print "$sk";
		if (preg_match("@^d@",$key) and $sk <= $max_purgeable_units) {
			$cost_a0 = $offence_units[$sk][0];
			$cost_a1 = $offence_units[$sk][1];
			$cost_a7 = $offence_units[$sk][2];
			$cost_a9 = $offence_units[$sk][3];
			$timer_offence = timer_offence($sk,$amount);
			if ($sk <= 19 and $row->a0 >= $total_cost0+$cost_a0 and $row->a1 >= $total_cost1+$cost_a1 and $row->a7 >= $total_cost7+$cost_a7 and $row->a9 >= $total_cost9+$cost_a9 and $row->{"h$sk"} < $current_time) {
				$total_cost0+=$cost_a0;
				$total_cost1+=$cost_a1;
				$total_cost7+=$cost_a7;
				$total_cost9+=$cost_a9;
				$row->{"h$sk"} = $current_time+$timer_offence;
				$to_update .= ", `h$sk`=".$row->{"h$sk"};
				$military_training++;
			}
		}
	}
}
if ($row->a9 >= $total_cost9 and $total_cost9 >= 1) {
	if ($row->j0 <= 0) {
		$message = '<table><tr><th colspan="4">Offensive Pet Training</th></tr><tr><th>Resource</th><th>Cost</th><th>In Stock</th><th>Result</th></tr><tr class="buildings"><td>'.$a_names[0].'</td><td>'.number_format($total_cost0).'</td><td>'.number_format($row->a0).'</td><td>'.number_format($row->a0-$total_cost0).'</td></tr><tr class="buildings"><td>'.$a_names[1].'</td><td>'.number_format($total_cost1).'</td><td>'.number_format($row->a1).'</td><td>'.number_format($row->a1-$total_cost1).'</td></tr><tr class="buildings"><td>'.$a_names[7].'</td><td>'.number_format($total_cost7).'</td><td>'.number_format($row->a7).'</td><td>'.number_format($row->a7-$total_cost7).'</td></tr><tr class="buildings"><td>'.$a_names[9].'</td><td>'.number_format($total_cost9).'</td><td>'.number_format($row->a9).'</td><td>'.number_format($row->a9-$total_cost9).'</td></tr></table>';
		inject_message($row->id,$message,0,7);
	}
	$row->a0-=$total_cost0;
	$row->a1-=$total_cost1;
	$row->a7-=$total_cost7;
	$row->a9-=$total_cost9;
	$to_update .= ",`a0`=`a0`-$total_cost0, `a1`=`a1`-$total_cost1, `a7`=`a7`-$total_cost7, `a9`=`a9`-$total_cost9";
				print '<input type="hidden" id="xxr1r" value="'.$total_cost0.'"><input type="hidden" id="xxr2r" value="'.$total_cost1.'"><input type="hidden" id="xxr8r" value="'.$total_cost7.'"><input type="hidden" id="xxr10r" value="'.$total_cost9.'"><script src="script.php?resourcer&ac"></script>';
}
unset($_GET);
}

print '<table><tr><th colspan="2">Offensive Pets</th><th><a href="?';for($i=0;$i<=19;$i++) {print 'd'.$i.'&';}print '"><span id="xxs'.$xxs.'">'.number_format($military_training).'</span>/'.number_format($max_training).'</a></th></tr>';$xxs++;
foreach ($offence_units as $key=>$val) {
$off=offence_offence_power($key);
$tim=timer_offence($key,1);
print '<tr class="buildings"><td>'.imagine('d'.$key).'</td><td><b>'.$offence_units_names[$key].'</b>
<br>Units: '.number_format($row->{"d$key"}).'
<br>Requirements: '.$a_names[0].': '.number_format($offence_units[$key][0]).'
'.$a_names[1].': '.number_format($offence_units[$key][1]).' '.$a_names[7].': '.number_format($offence_units[$key][2]).'
'.$a_names[9].': '.number_format($offence_units[$key][3]).'
<br>Offence Power: '.number_format($off).'
<br>Construction Time: '.clockit($tim).'
<br>Master Unit: '.$military_units_names[$key];
if ($row->{"k$key"} <= $row->{"e$key"}) {
print '<br><span class="maxed">Insufficient Masters</span>';
}
print '</td>
<td>';
if($key <= $max_purgeable_units){
	if ($row->{"h$key"} > $current_time) {
		$fresh_timer=$row->{"h$key"}-$current_time;
		if ($fresh_timer<$refresh_timer) {
			$refresh_timer=$fresh_timer;
		}
		print '<span id="xxt'.$xxt.'" class="timer">'.clockit($fresh_timer).'</span>';$xxt++;
	}else{
		if ($military_training < $row->b15){
	print ($row->a0>=$offence_units[$key][0]&&$row->a1>=$offence_units[$key][1]&&$row->a7>=$offence_units[$key][2]&&$row->a9>=$offence_units[$key][3]?'<a href="?d'.$key.'">Train '.$o_names[$key].'</a>':'Insufficient resource');
	}else{
		print 'No Training Facility';
	}
	}
}else{
	print 'Not Available';
}
print '</td></tr>';

}
print '</table>';

require_once 'admin/game.footer.php';?>