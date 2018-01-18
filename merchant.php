<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

//$to_update .= ", b19=b19+1";

if ($row->b19 < 1) {
 print $txt_merchant[0];
}else{
$merchant_cargo = merchant_cargo($row->b19);
$merchant_max=merchant_max($row);
$travel_time=travel_time($row->b19);

/*_______________-=TheSilenT.CoM=-_________________*/
//CALLBACK
if (!empty($_GET['callback'])){
$callback = clean_post($_GET['callback']);
//merchant_callback ($callback,$tbl_merchant);
}
//CALLBACK
/*_______________-=TheSilenT.CoM=-_________________*/
if (!empty($_POST['recipient']) and $row->b19 > $merchant_max) {
	$recipient = '';
	$inserto='';
	$t_cargo=0;
foreach ($_POST as $key=>$val) {
	//print "$key = $val<br>";
	$key = clean_post($key);
	$val = clean_post($val);
	if ($key == 'recipient') {
		$recipient=$val;
	}
	//print ' KEY '.$key.' VAL '.$val.'<br>';
	if (isset($row->$key)) {
		$val = preg_replace("@[^0-9]@si","",$val);
		if ($row->$key >= $val and $val >= 1) {
		$sk=sk($key);
		//print ' KEY '.$key.' SK '.$sk.' VAL '.$val.'<br>';
		$to_update .= ",`$key`=`$key`-$val";
		$inserto .=", $val";
		$row->$key -= $val;
		print '<input type="hidden" id="xxr'.($sk+1).'r" value="'.$val.'">';
		$t_cargo+=$val;
		}else{
			$inserto .=", 0";
		}
	}
}
//print "$t_cargo <= $merchant_cargo<br>";
print '<script src="script.php?resourcer&ac"></script>';
if (!empty($recipient) and !empty($inserto) and $t_cargo <= $merchant_cargo and $t_cargo >= 1) {
mysqli_query ($link, "INSERT INTO `$tbl_merchant` VALUES (NULL, '$row->id', '$recipient', $current_time+$travel_time $inserto)") or die_nice(mysqli_error($link).$inserto);
//print 'TC '.$t_cargo.' INSERTO '.$inserto;
$merchant_max++;
}

//$to_update .= ",";
}
/*_______________-=TheSilenT.CoM=-_________________*/
print '<form method="post"><table><tr><th>'.$txt_merchant[1].'</th><th><span id="xxs'.$xxs.'">'.number_format($merchant_max).'</span>/'.number_format($row->b19).'
</th></tr>
<tr class="buildings"><td colspan="2">'.$txt_merchant[2].': <span id="mxcargo">'.number_format($merchant_cargo).'</span> 
<br>'.$txt_merchant[3].': '.clockit($travel_time).'</td></tr><tr><td colspan="2">';$xxs++;

//ON THE ROAD
if($meresult = mysqli_query ($link, "SELECT * FROM `$tbl_merchant` WHERE `mid`='$row->id' or `rid`='$row->id' and `timer`>$current_time ORDER BY `timer` ASC LIMIT 100")){
	if(mysqli_num_rows($meresult) >= 1) {
		print '<table>';
		$merchant_max=merchant_max($row);
		while ($merow = mysqli_fetch_object ($meresult)) {
			print '<tr class="buildings"><td>';
			if ($merow->rid==$row->id) {
				print $txt_merchant[4].' '.$txt_merchant[33].' '.return_charname($merow->mid);
			}else{
				print $txt_merchant[10].' '.$txt_merchant[32].' '.return_charname($merow->rid);
			}
			print ': '.merchant_carry($merow).'</td><td><span id="xxt'.$xxt.'" class="timer">'.clockit($merow->timer-$current_time).'</span>';
			if ($merow->mid == $row->id) {
				if ($merow->mid !== $merow->rid) {
					print ' <span id="extra'.$xxt.'"><a href="?callback='.$merow->id.'">'.$txt_merchant[11].'</a></span>';
				}
			}
			print '</td></tr>';
			$xxt++;
		}
		mysqli_free_result ($meresult);
	print '</table>';
	}
}
//ON THE ROAD

if($merchant_max < $row->b19) {
//SEND RESOURCE
//RECIPIENTS SERVER DEPENDEND

$alfa='';
$recipient='';

if(!empty($_POST['alfa'])){
	$alfa=clean_post($_POST['alfa']);
	if(strlen($alfa) < 2){
		$alfa='';
	}
}
if(!empty($_POST['recipient'])){
	$recipient=clean_post($_POST['recipient']);
}

$recipient_select = '';

if (!empty($alfa)) {
	
if($presult = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE `charname`!='$row->charname' and `charname` LIKE CONVERT (_utf8 '%$alfa%' USING latin1) COLLATE latin1_swedish_ci ORDER BY `charname` ASC LIMIT 100")){
if(mysqli_num_rows($presult) >= 1) {
$recipient_select = '<select name="recipient">';
	while ($prow = mysqli_fetch_object ($presult)) {
if ($recipient == $prow->id) {
$recipient_select .= '<option value="'.$prow->id.'" selected>'.$prow->charname.'</option>';
}else{
$recipient_select .= '<option value="'.$prow->id.'">'.$prow->charname.'</option>';
}
	}
$recipient_select .= '</select>';
}
mysqli_free_result ($presult);
}

}

//RECIPIENTS SERVER DEPENDED
print '<table><tr><th colspan="3">'.$txt_merchant[7].'</th></tr>';

if (empty($recipient_select)) {
print '<tr class="buildings"><td width="50%" align="right"><input type="text" name="alfa" value="'.$alfa.'" maxlength="10"></td><td><input type="submit" value="'.$txt_messages[20].'"></td></tr><td colspan="2">
'.$txt_messages[21].'</td></tr>';
}else{

for ($i=0;$i<=9;$i++) {
print '<tr class="buildings"><td>'.$a_names[$i].'</td><td align="center"><a onclick="maxthis(\'a'.($i+1).'\','.($i+1).');">'.$txt_merchant[13].'</a></td><td><input type="text" id="a'.($i+1).'" name="a'.$i.'" onkeyup="resourcev(this.id,'.($i+1).');" maxlength="10"></td></tr>';
}

print '<tr class="buildings"><td colspan="2">'.$txt_merchant[9].'</td><td><span id="txcargo">'.number_format($merchant_cargo).'</span></td></tr>

<tr class="buildings"><td colspan="2"><input type="submit" name="action" value="'.$txt_merchant[8].'"></td><td>'.$recipient_select.'</td></tr><script src="script.php?resourcev&ac"></script>';
}

print '</table>';
//SEND RESOURCE

}else{print $txt_merchant[28];}//check availble merchants
print '</td></tr><table></form>';
}//b19 upgraded


require_once 'admin/game.footer.php';?>