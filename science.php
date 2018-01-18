<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';



if ($row->b18 < 1) {
	print $txt_science[0];
}else{
//research c0-19 timer = g0-19

$in_research=0;
for ($i=0;$i<=19;$i++) {
	if ($row->{"g$i"} > $current_time) {
		$in_research++;
	}
}

//CANCEL
if (!empty($_GET['cancel'])) {
	$cancel = clean_post($_GET['cancel']);
	$sk=sk($cancel);
	if ($row->{"g$sk"} >= $current_time) {
		$cost_a9 = cost_a9($row->{"c$sk"},$sk);
		$cost_research = cost_research($row->{"c$sk"},$sk);
		//print $sk.' '.$cost_a0.' '.$cost_a1;
		$in_research--;
		$to_update .= ", `a9`=`a9`+$cost_a9, `a$sk`=`a$sk`+$cost_research, `g$sk`='0'";
		$row->{"g$sk"}=0;
		$row->a9+=$cost_a9;
		$row->{"a$sk"}+=$cost_research;
		
		print '<input type="hidden" id="xxr10a" value="'.$cost_a9.'"><input type="hidden" id="xxr'.($sk+1).'a" value="'.$cost_research.'"><script src="script.php?resourcer&ac"></script>';
	}
}
//CANCEL

if (!empty($_GET) and empty($_GET['cancel'])) {
	$total_cost=array();
	$total_cost9=0;
foreach ($_GET as $key=>$val) {
	$key = clean_post($key);
	$val = clean_post($val);
	if (isset($row->$key) and $in_research < $row->b18) {
		$sk=sk($key);
	
	//print ' KEY '.$key.' SK '.$sk.' G '.$row->{"g$sk"}.' T '.$current_time;
		if (preg_match("@^c@",$key)) {
			//print ' A1 ';
			
			$cost_a9 = cost_a9($row->$key,$sk);
			if ($sk < 9) {
			$cost_research = cost_research($row->$key,$sk);
			}else{
			$cost_research = cost_a9($row->$key,$sk);
			}
			$timer_research = timer_research($cost_a9+$cost_research+$row->$key,$sk);
			
			if ($sk < 9 and $row->a9 >= $total_cost9+$cost_a9 and $row->{"a$sk"} >= $cost_research and $row->{"g$sk"} < $current_time) {
				if (isset($total_cost[$sk])) {
					$total_cost[$sk]+=$cost_research;
				} else {
					$total_cost[$sk]=$cost_research;
				}
				$total_cost9+=$cost_a9;
				$row->{"a$sk"}-=$cost_research;
				$row->{"g$sk"} = $current_time+$timer_research;
								
				print '<input type="hidden" id="xxr'.($sk+1).'r" value="'.$cost_research.'">';
				$to_update .= ", `a$sk`=`a$sk`-$cost_research, `g$sk`=".$row->{"g$sk"};
					//print " $cost_a9 $cost_research $timer_research $sk";
				$in_research++;
			}elseif ($sk >= 9 and $row->a9 >= $total_cost9+$cost_a9 and $row->{"g$sk"} < $current_time) {
				$total_cost9+=$cost_a9;
				$row->{"g$sk"} = $current_time+$timer_research;
				$to_update .= ", `g$sk`=".$row->{"g$sk"};
					//print " $cost_a9 $timer_research $sk";
				$in_research++;			
			}
		}
	}
}
//print_r($total_cost);
if ($row->a9 >= $total_cost9 and $total_cost9 >= 1) {
	if ($row->j0 <= 0) {
		$message = '<table><tr><th colspan="4">Researching</th></tr><tr><th>Resource</th><th>Cost</th><th>In Stock</th><th>Result</th></tr>';
		if (array_sum(array_values($total_cost)) >= 1) {foreach ($total_cost as $key=>$val) {
			if ($val>=1) {
				$message .= '<tr class="buildings"><td>'.$a_names[$key].'</td><td>'.number_format($val).'</td><td>'.number_format($row->{"a$key"}+$val).'</td><td>'.number_format($row->{"a$key"}).'</td></tr>';
			}
		}}
		$message .= '<tr class="buildings"><td>'.$a_names[9].'</td><td>'.number_format($total_cost9).'</td><td>'.number_format($row->a9).'</td><td>'.number_format($row->a9-$total_cost9).'</td></tr></table>';
		inject_message($row->id,$message,0,7);
	}
	$row->a9-=$total_cost9;
	$to_update .= ", `a9`=`a9`-$total_cost9";
	print '<input type="hidden" id="xxr10r" value="'.$total_cost9.'"><script src="script.php?resourcer&ac"></script>';
}
unset($_GET);
}

print '<table>
<tr>
<th colspan="2">'.$txt_science[1].'</th><th><a href="?';for($i=0;$i<=19;$i++) {print 'c'.$i.'&';}print '"><span id="xxs'.$xxs.'">'.$in_research.'</span>/'.$row->b18.'</a></th>
</tr>';$xxs++;

for ($i=0;$i<=19;$i++) {

	$cost_a9=cost_a9($row->{"c$i"},$i);
if ($i<9) {
	$cost_research=cost_research($row->{"c$i"},$i);
}else{
	$cost_research=cost_a9($row->{"c$i"},$i);
}
	$timer_research=timer_research($cost_a9+$cost_research+$row->{"c$i"},$i);
	
	print '<tr class="buildings"><td><a href="scienceinfo.php?tip=c'.$i.'">'.imagine('c'.$i).'</a></td>';

//SCIENCE
	print '<td><b><a href="scienceinfo.php?tip=c'.$i.'">'.ucfirst($c_names[$i]).'</a></b> ('.$txt_science[10].' '.number_format($row->{"c$i"}).')'.($i>9?'<br>'.$c_namesx[$i-10]:'').
	($i<=9?'<br>'.$a_names[$i].' '.$txt_science[2].': + '.number_format($row->{"c$i"}).'%':'');
	print '<br>'.$txt_science[9].': ';
	if ($i<9) {
		print $a_names[$i].': '.number_format($cost_research).' '.$a_names[9].': '.number_format($cost_a9);
	}else{
		print $a_names[9].': '.number_format($cost_a9);
	}
	print '<br>'.$txt_science[3].': '.clockit($timer_research).'
	</td><td>';
	
	if ($row->{"g$i"} >= $current_time) {
		$fresh_timer=$row->{"g$i"}-$current_time;
		if ($fresh_timer<$refresh_timer) {
			$refresh_timer=$fresh_timer;
		}
	print $txt_science[4].' <span id="xxt'.$xxt.'" class="timer">'.clockit($fresh_timer).'</span> <span id="extra'.$xxt.'"><a href="?cancel=b'.$i.'">'.$txt_buildings[20].'</a></span>';
	$xxt++;
	} else {
		if ($in_research >= $row->b18) {
			print $txt_science[8];
		}else{
			if ($i<9) {
				if ($cost_research <= $row->{"a$i"} and $cost_a9 <= $row->a9) {
					print '<a href="?c'.$i.'">'.$txt_science[5].'</a> ';
				}else{
					print $txt_science[7];
				}
			} else {
				if ($cost_a9 <= $row->a9) {
					print '<a href="?c'.$i.'">'.$txt_science[5].'</a> ';
				}else{
					print $txt_science[7];
				}
			}
		}
	}
	print '</td>';
//SCIENCE

	print '</tr>';
	
}
print '</table>';
}// need research lab



require_once 'admin/game.footer.php';?>