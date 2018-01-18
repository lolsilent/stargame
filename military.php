<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

//offence d0-19 timer = h0-19
//defence e0-19 timer = i0-19
//military k0-19 timer = l0-19
	
$max_purgeable_units = $row->c10;
$max_training=$row->b15;
$military_training=military_training($row);


//CANCEL
if (!empty($_GET['cancel'])) {
	$cancel = clean_post($_GET['cancel']);
	$sk=sk($cancel);
	if ($row->{"l$sk"} >= $current_time) {
		$cost_a8 = $military_units[$sk][2];
		$cost_a9 = $military_units[$sk][3];
		$military_training--;
		$to_update .= ", `a8`=`a8`+$cost_a8,`a9`=`a9`+$cost_a9,`l$sk`='0'";
		$row->{"l$sk"}=0;
		$row->a8+=$cost_a8;
		$row->a9+=$cost_a9;
		print '<input type="hidden" id="xxr9a" value="'.$cost_a8.'"><input type="hidden" id="xxr10a" value="'.$cost_a9.'"><script src="script.php?resourcer&ac"></script>';
	}
}
//CANCEL

if (!empty($_GET) and empty($_GET['cancel'])) {
	$total_cost8=0;
	$total_cost9=0;
foreach ($_GET as $key=>$val) {
	$key = clean_post($key);
	$val = clean_post($val);
	if (isset($row->$key) and $military_training < $row->b15) {
		$sk=sk($key);
		$amount=1;

		if (preg_match("@^k@",$key) and $sk <= $max_purgeable_units) {
			$cost_a8 = $military_units[$sk][2];
			$cost_a9 = $military_units[$sk][3];
			$timer_military = timer_military($sk,$amount);
			if ($sk <= 19 and $row->a8 >= $total_cost8+$cost_a8 and $row->a9 >= $total_cost9+$cost_a9 and $row->{"l$sk"} < $current_time) {
				$total_cost8+=$cost_a8;
				$total_cost9+=$cost_a9;
				$row->{"l$sk"} = $current_time+$timer_military;
				$to_update .= ", `l$sk`=".$row->{"l$sk"};
				$military_training++;
			}
		}
	}
}

if ($row->a9 >= $total_cost9 and $total_cost9 >= 1) {
	if ($row->j0 <= 0) {
		$message = '<table><tr><th colspan="4">Military Training</th></tr><tr><th>Resource</th><th>Cost</th><th>In Stock</th><th>Result</th></tr><tr class="buildings"><td>'.$a_names[8].'</td><td>'.number_format($total_cost8).'</td><td>'.number_format($row->a8).'</td><td>'.number_format($row->a8-$total_cost8).'</td></tr><tr class="buildings"><td>'.$a_names[9].'</td><td>'.number_format($total_cost9).'</td><td>'.number_format($row->a9).'</td><td>'.number_format($row->a9-$total_cost9).'</td></tr></table>';
		inject_message($row->id,$message,0,7);
	}
	$row->a8-=$total_cost8;
	$row->a9-=$total_cost9;
	$to_update .= ", `a8`=`a8`-$total_cost8, `a9`=`a9`-$total_cost9";
	print '<input type="hidden" id="xxr9r" value="'.$total_cost8.'"><input type="hidden" id="xxr10r" value="'.$total_cost9.'"><script src="script.php?resourcer&ac"></script>';
}
unset($_GET);
}

print '<table><tr><th colspan="2">Military</th><th><a href="?';for($i=0;$i<=19;$i++) {print 'k'.$i.'&';}print '"><span id="xxs'.$xxs.'">'.number_format($military_training).'</span>/'.number_format($max_training).'</a></th></tr>';$xxs++;
foreach ($military_units as $key=>$val) {
$off=military_offence_power($key);
$def=military_defence_power($key);
$tim=timer_military($key,1);
$cargo=($off+$def)/1.5;

print '<tr class="buildings"><td>'.imagine('m'.$key).'</td><td><b>'.$military_units_names[$key].'</b>
<br>Units: '.number_format($row->{"k$key"}).'
<br>Upkeep Cost: '.$a_names[2].': '.number_format($military_units[$key][0]).'
'.$a_names[3].': '.number_format($military_units[$key][1]).'
<br>Train Cost: '.$a_names[8].': '.number_format($military_units[$key][2]).'
'.$a_names[9].': '.number_format($military_units[$key][3]).'
<br>Military Offence Power: '.number_format($off).'
<br>Military Defence Power: '.number_format($def).'
<br>Military Cargo: '.number_format($cargo).'
<br>Train duration: '.clockit($tim).'
</td>
<td>';
if($key <= $max_purgeable_units){
	if ($row->{"l$key"} > $current_time) {
		$fresh_timer=$row->{"l$key"}-$current_time;
		if ($fresh_timer<$refresh_timer) {
			$refresh_timer=$fresh_timer;
		}
	print '<span id="xxt'.$xxt.'" class="timer">'.clockit($fresh_timer).'</span>';$xxt++;
	}else{
		if ($military_training < $max_training) {
	print ($row->a2>=$military_units[$key][0]&&$row->a3>=$military_units[$key][1]&&$row->a8>=$military_units[$key][2]&&$row->a9>=$military_units[$key][3]?'<a href="?k'.$key.'">Train</a>':'Resource Shortage');
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