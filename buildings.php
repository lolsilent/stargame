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

$max_build = 1+$row->b17;
$in_build = in_build($row);

//CANCEL
if (!empty($_GET['cancel'])) {
	$cancel = clean_post($_GET['cancel']);
	$sk=sk($cancel);
	if ($row->{"f$sk"} >= $current_time) {
		$cost_a0 = cost_a0($row->{"b$sk"},$sk);
		$cost_a1 = cost_a1($row->{"b$sk"},$sk);
		//print $sk.' '.$cost_a0.' '.$cost_a1;
		$in_build--;
		$to_update .= ", `a0`=`a0`+$cost_a0, `a1`=`a1`+$cost_a1, `f$sk`='0'";
		$row->{"f$sk"}=0;
		$row->a0+=$cost_a0;
		$row->a1+=$cost_a1;
		print '<input type="hidden" id="xxr1a" value="'.$cost_a0.'"><input type="hidden" id="xxr2a" value="'.$cost_a1.'"><script src="script.php?resourcer&ac"></script>';
	}
}
//CANCEL

if (!empty($_GET) and empty($_GET['cancel'])) {
	$total_cost0=0;
	$total_cost1=0;
foreach ($_GET as $key=>$val) {
	$key = clean_post($key);
	$val = clean_post($val);
	if (isset($row->$key) and $in_build < $max_build) {
		$sk=sk($key);
	
	//print ' KEY '.$key.' SK '.$sk.' F '.$row->{"f$sk"}.' T '.$current_time;
		if (preg_match("@^b@",$key)) {
			//print ' A1 ';
			$cost_a0 = cost_a0($row->$key,$sk);
			$cost_a1 = cost_a1($row->$key,$sk);
			$timer_build = timer_build($cost_a0+$cost_a1+$row->$key,$sk);
			
			if ($row->a0 >= $total_cost0+$cost_a0 and $row->a1 >= $total_cost1+$cost_a1 and $row->{"f$sk"} < $current_time) {
				$total_cost0 +=$cost_a0;
				$total_cost1 +=$cost_a1;
				$row->{"f$sk"} = $current_time+$timer_build;
				$to_update .= ", `f$sk`=".$row->{"f$sk"};
				$in_build++;
			}
		}
	}
}

if ($row->a0 >= $total_cost0 and $row->a1 >= $total_cost1 and $total_cost0 >= 1 and $total_cost1 >= 1) {
	if ($row->j0 <= 0) {
		$message = '<table><tr><th colspan="4">Building Construction</th></tr><tr><th>Resource</th><th>Cost</th><th>In Stock</th><th>Result</th></tr>		<tr class="buildings"><td>'.$a_names[0].'</td><td>'.number_format($total_cost0).'</td><td>'.number_format($row->a0).'</td><td>'.number_format($row->a0-$total_cost0).'</td></tr>		<tr class="buildings"><td>'.$a_names[1].'</td><td>'.number_format($total_cost1).'</td><td>'.number_format($row->a1).'</td><td>'.number_format($row->a1-$total_cost1).'</td></tr></table>';
		inject_message($row->id,$message,0,7);
	}
	$row->a0 -= $total_cost0;
	$row->a1 -= $total_cost1;
	$to_update .= ", `a0`=$row->a0, `a1`=$row->a1";
	print '<input type="hidden" id="xxr1r" value="'.$total_cost0.'"><input type="hidden" id="xxr2r" value="'.$total_cost1.'"><script src="script.php?resourcer&ac"></script>';
}
unset($_GET);
}


print '<table>
<tr>
<th colspan="2">'.$txt_buildings[0].'</th><th><a href="?';for($i=0;$i<=19;$i++) {print 'b'.$i.'&';}print '"><span id="xxs'.$xxs.'">'.$in_build.'</span>/'.$max_build.'</a></th>
</tr>';$xxs++;


for ($i=0;$i<=9;$i++) {
	$production[$i]=production($i,$row);
	$cost_a0=cost_a0($row->{"b$i"},$i);
	$cost_a1=cost_a1($row->{"b$i"},$i);
	$timer_build=timer_build($cost_a0+$cost_a1+$row->{"b$i"},$i);
	print '<tr class="buildings"><td><a href="buildingsinfo.php?tip=b'.$i.'">'.imagine('b'.$i).'</a></td>';
//BUILDINGS
	print '<td><b><a href="buildingsinfo.php?tip=b'.$i.'">'.$b_names[$i].'</a></b> ('.$txt_buildings[1].' '.number_format($row->{"b$i"}).')
	<br>'.$txt_buildings[2].': '.$a_names[$i].': '.number_format($production[$i]).
	((!empty($r_names[$i]))?'<br>'.$txt_buildings[3].': '.$r_names[$i].': '.number_format($production[$i]*2):'').'
	<br>'.$txt_buildings[4].': '.$a_names[0].': '.number_format($cost_a0).' '.$a_names[1].': '.number_format($cost_a1).'
	<br>'.$txt_buildings[6].': '.clockit($timer_build).'
	<br>';
		
	print '</td><td>';
	
	if ($row->{"f$i"} >= $current_time) {
		$fresh_timer=$row->{"f$i"}-$current_time;
		if ($fresh_timer<$refresh_timer) {
			$refresh_timer=$fresh_timer;
		}
	print $txt_buildings[7].' <span id="xxt'.$xxt.'" class="timer">'.clockit($fresh_timer).'</span> <span id="extra'.$xxt.'"><a href="?cancel=b'.$i.'">'.$txt_buildings[20].'</a></span>';
	$xxt++;
	} else {
		if (cost_a0($row->{"b$i"},$i) <= $row->a0 and cost_a1($row->{"b$i"},$i) <= $row->a1) {
			if ($in_build < $max_build) {
				print '<a href="?b'.$i.'">'.$txt_buildings[8].'</a> ';
			}else{
				print $txt_buildings[11];
			}
		} else {
			print $txt_buildings[9];
		}
	}
	
	print '</td>';
//BUILDINGS


	print '</tr>';
	
}

$i=10;
foreach ($b_namesx as $key=>$val) {
	$cost_a0=cost_a0($row->{"b$i"},$i);
	$cost_a1=cost_a1($row->{"b$i"},$i);
	$timer_build=timer_build($cost_a0+$cost_a1+$row->{"b$i"},$i);
print '<tr class="buildings"><td><a href="buildingsinfo.php?tip=b'.$i.'">'.imagine('b'.$i).'</a></td><td><a href="buildingsinfo.php?tip=b'.$i.'"><b>'.$key.'</b></a> ('.$txt_buildings[1].' '.number_format($row->{"b$i"}).')
<br>'.$val;

print ($i<17)?'<br>'.$txt_buildings[10].': '.number_format(max_resources($i,$row)):'';
print ($i==15)?'<br>'.$txt_buildings[17].': '.number_format($row->{"b$i"}):'';
print ($i==16)?'<br>'.$txt_buildings[18].': '.number_format(($row->{"b$i"}/$goldinterest),2).'%':'';
print ($i==17)?'<br>'.$txt_buildings[16].': '.number_format($row->{"b$i"}+1):'';
print ($i==18)?'<br>'.$txt_buildings[24].': '.number_format($row->{"b$i"}).'<br>'.$txt_buildings[19].': '.number_format($row->{"b$i"}).'%'.'<br>'.$txt_buildings[22].': '.number_format($row->{"b$i"}).'%':'';
print ($i==19)?'<br>'.$txt_buildings[15].': '.number_format(merchant_cargo($row->{"b$i"})).'<br>'.$txt_buildings[21].': '.number_format($row->{"b$i"}).'%':'';

print '<br>'.$txt_buildings[4].': '.$a_names[0].': '.number_format($cost_a0).' '.$a_names[1].': '.number_format($cost_a1).'
<br>'.$txt_buildings[6].': '.clockit($timer_build).'</td><td>';

	if ($row->{"f$i"} >= $current_time) {
		$fresh_timer=$row->{"f$i"}-$current_time;
		if ($fresh_timer<$refresh_timer) {
			$refresh_timer=$fresh_timer;
		}
	print $txt_buildings[7].' <span id="xxt'.$xxt.'" class="timer">'.clockit($fresh_timer).'</span> <span id="extra'.$xxt.'"><a href="?cancel=b'.$i.'">'.$txt_buildings[20].'</a></span>';
	$xxt++;
	} else {
		if (cost_a0($row->{"b$i"},$i) <= $row->a0 and cost_a1($row->{"b$i"},$i) <= $row->a1) {
			if ($in_build < $max_build) {
				print '<a href="?b'.$i.'">'.$txt_buildings[8].'</a> ';
			}else{
				print $txt_buildings[11];
			}
		} else {
			print $txt_buildings[9];
		}
	}

print '</td></tr>';
$i++;
}

print '</table>';

require_once 'admin/game.footer.php';?>