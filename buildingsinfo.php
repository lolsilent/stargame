<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

function xproduction($i,$sk,$row) {
	global $cost_buildings;
	if (!isset($row->{"b$i"})) {$row->{"b$i"}=0;}
	$r = $cost_buildings[$i][2]*$sk*pow($cost_buildings[$i][3],$sk);
	if ($row->{"c$i"} >= 1) {
		$r /= 100;
		$r *= (100+$row->{"c$i"});
	}
	if ($i <= 9 and $row->{"a".($i+10)} <= 100) {
		$r /= 100;
		$r *= $row->{"a".($i+10)};
	}
	return floor($r);
}

//resources a0-19 
//buildings b0-19 timer = f0-19

if (!empty($_GET['tip'])) {

foreach ($_GET as $key=>$val) {
	if (isset($row->$val)) {
		$sk=sk($val);
		$j=$row->$val;
		$min=$j-5;$max=$j+10;
		if($j<=5){$min=0;$max=15;}
		
		print '<table><tr><th>'.($sk<=9?$b_names[$sk]:$b_namesxa[$sk-10].'<br>'.$b_namesx[$b_namesxa[$sk-10]]).'<br>'.imagine($val).' </th></tr>';
		
		for ($i=$min;$i<=$max;$i++) {
			$cost_a0=cost_a0($i,$sk);
			$cost_a1=cost_a1($i,$sk);
			$timer_build=timer_build($cost_a0+$cost_a1+$i,$sk);
if ($sk >= 0 and $sk <= 9) {
			$production[$sk]=xproduction($sk,$i,$row);
print '<tr class="buildings"><td'.($i==$j?' class="mylevel"':'').'>'.$txt_buildings[1].' '.$i.'
<br>'.$txt_buildings[2].': '.$a_names[$sk].': '.number_format($production[$sk]).
((!empty($r_names[$sk]))?'<br>'.$txt_buildings[3].': '.$r_names[$sk].': '.number_format($production[$sk]):'')
.'<br>'.$txt_buildings[4].': '.$a_names[0].': '.number_format($cost_a0).' '.$a_names[1].': '.number_format($cost_a1).'
<br>'.$txt_buildings[6].': '.clockit($timer_build).'</td></tr>';
}elseif ($sk >= 10 and $sk <= 19) {
print '<tr class="buildings"><td'.($i==$j?' class="mylevel"':'').'>'.$txt_buildings[1].' '.$i;

if ($sk<=17) {
	$row->{"b$sk"}=$i;
	print '<br>'.$txt_buildings[10].': '.number_format(max_resources($sk,$row));
}
if ($sk==15) {
	$row->{"b$sk"}=$i;
	print '<br>'.$txt_buildings[17].': '.number_format($row->{"b$sk"});
}
if ($sk==16) {
	$row->{"b$sk"}=$i;
	print '<br>'.$txt_buildings[18].': '.number_format($row->{"b$sk"}).'%';
}
if ($sk==17) {
	$row->{"b$sk"}=$i;
	print '<br>'.$txt_buildings[16].': '.number_format($row->{"b$sk"}+1);
}
if ($sk==18) {
	$row->{"b$sk"}=$i;
	print '<br>'.$txt_buildings[24].': '.number_format($row->{"b$sk"}).'<br>'.$txt_buildings[19].': '.number_format($row->{"b$sk"}).'%'.'<br>'.$txt_buildings[22].': '.number_format($row->{"b$sk"}).'%';
}
if ($sk==19) {
	$row->{"b$sk"}=$i;
	print '<br>'.$txt_buildings[15].': '.number_format(merchant_cargo($row->{"b$sk"})).'<br>'.$txt_buildings[21].': '.number_format($row->{"b$sk"}).'%';
}

print '<br>'.$txt_buildings[4].': '.$a_names[0].': '.number_format($cost_a0).' '.$a_names[1].': '.number_format($cost_a1).'<br>'.$txt_buildings[6].': '.clockit($timer_build).'</td></tr>';
}

		}
		
		print '</table>';
	break;
	}
}

}

require_once 'admin/game.footer.php';?>