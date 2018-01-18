<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

if (!empty($_GET['tip'])) {

foreach ($_GET as $key=>$val) {
	if (isset($row->$val)) {
		$sk=sk($val);
		$j=$row->$val;
		$min=$j-3;$max=$j+6;
		if($j<=3){$min=0;$max=10;}
		print '<table><tr><th colspan="2">'.$c_names[$sk].($i>9?'<br>'.$c_namesx[$i-10]:'').'</th></tr>';
		for ($i=$min;$i<=$max;$i++) {

	$cost_a9=cost_a9($i,$sk);
if ($sk<9) {
	$cost_research=cost_research($i,$sk);
}else{
	$cost_research=cost_a9($i,$sk);
}
	$timer_research=timer_research($cost_a9+$cost_research+$i,$sk);

	print '<tr class="buildings"><td'.($i==$j?' class="mylevel"':'').'>'.$txt_science[10].' '.number_format($i).($sk<=9?'<br>'.$a_names[$sk].' '.$txt_science[2].': + '.number_format($i).'%':'').'
	<br>'.$txt_science[9].': ';
	if ($sk<9) {
		print $a_names[$sk].': '.number_format($cost_research).' '.$a_names[9].': '.number_format($cost_a9);
	}else{
		print $a_names[9].': '.number_format($cost_a9);
	}
	print '<br>'.$txt_science[3].': '.clockit($timer_research).'
	</td></tr>';
		}
		print '</table>';
		break;
	}
}

}

require_once 'admin/game.footer.php';?>