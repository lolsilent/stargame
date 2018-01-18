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

//BUY
if(!empty($_GET['buy'])) {
//SEND A MERCHANT TO GET THE STUFF
$buy = preg_replace("@[^0-9]@si","",clean_post($_GET['buy']));
if($teresult = mysqli_query ($link, "SELECT * FROM `$tbl_trade` WHERE `id`='$buy' and `mid`!='$row->id' ORDER BY `id` DESC LIMIT 1")){
	if(mysqli_num_rows($teresult) >= 1) {
		if ($terow = mysqli_fetch_object ($teresult)) {
		mysqli_free_result ($teresult);


if($heres = mysqli_query ($link, "SELECT `id`,`b19` FROM `$tbl_members` WHERE `id`='$terow->mid' and `id`!='$row->id' ORDER BY `id` DESC LIMIT 1")){
	if(mysqli_num_rows($heres) >= 1) {
		if ($herow = mysqli_fetch_object ($heres)) {
		mysqli_free_result ($heres);
$hetravel_time=travel_time($herow->b19);
$hemerchant_cargo = merchant_cargo($herow->b19);
$hemerchant_max=merchant_max($herow);
		}
	}
}
//print "$hemerchant_max <= $herow->b19 and $hemerchant_cargo >= $terow->oamo and $merchant_cargo >= $terow->samo";
if (!empty($herow)) {
if ($hemerchant_max <= $herow->b19 and $hemerchant_cargo >= $terow->oamo and $merchant_cargo >= $terow->samo) {
	mysqli_query ($link, "DELETE FROM `$tbl_trade` WHERE `id`='$terow->id' LIMIT 1");
$oinserto='';
$sinserto='';
for ($i=0;$i<=9;$i++) {
	if ($i == $terow->sres) {
		$oinserto .=", $terow->samo";
		$sinserto .=', 0';
	}elseif ($i == $terow->ores) {
		$sinserto .=", $terow->oamo";
		$oinserto .=', 0';
	}else{
		$oinserto .=', 0';
		$sinserto .=', 0';
	}
}


//TRADES CAN NOT BE CALLED BACK
//$oinserto ="'', '0', '$herow->id', $current_time+$travel_time $oinserto";
//$sinserto ="'', '0', '$row->id', $current_time+$hetravel_time $sinserto";

//TRADES CAN BE CALLED BACK
$oinserto ="NULL, '$row->id', '$herow->id', $current_time+$travel_time $oinserto";
$sinserto ="NULL, '$herow->id', '$row->id', $current_time+$hetravel_time $sinserto";

mysqli_query ($link, "INSERT INTO `$tbl_merchant` VALUES ($oinserto)") or die_nice(mysqli_error($link)."111");
mysqli_query ($link, "INSERT INTO `$tbl_merchant` VALUES ($sinserto)") or die_nice(mysqli_error($link)."111");

//print '<br> OINSERTO '.$oinserto.'<br> SINSERTO '.$sinserto;


$to_update .= ", `a$terow->sres`=`a$terow->sres`-$terow->samo";
print '<input type="hidden" id="xxr'.($terow->sres+1).'r" value="'.$terow->samo.'">';
print '<script src="script.php?resourcer&ac"></script>';
$merchant_max++;
}else{
if ($hemerchant_cargo < $terow->oamo){
	print $txt_merchant[30].' '.return_charname($herow->id);
}elseif ($merchant_cargo < $terow->samo){
	print $txt_merchant[29];
}elseif($hemerchant_max < $herow->b19) {
	print return_charname($herow->id).' '.$txt_merchant[34];
}
}
}else{mysqli_query ($link, "DELETE FROM `$tbl_trade` WHERE `id`='$terow->id' LIMIT 1");}//non member
		}
	}
}
}
//BUY

//CANCEL
if(!empty($_GET['callback'])) {
$callback = preg_replace("@[^0-9]@si","",clean_post($_GET['callback']));
if($teresult = mysqli_query ($link, "SELECT * FROM `$tbl_trade` WHERE `id`='$callback' and `mid`='$row->id' ORDER BY `id` DESC LIMIT 50")){
	if(mysqli_num_rows($teresult) >= 1) {
		if ($terow = mysqli_fetch_object ($teresult)) {
			mysqli_query ($link, "DELETE FROM `$tbl_trade` WHERE `id`='$terow->id' LIMIT 1");
			$to_update .= ", `a$terow->ores`=`a$terow->ores`+$terow->oamo";
				print '<input type="hidden" id="xxr'.($terow->ores+1).'a" value="'.$terow->oamo.'">';
				print '<script src="script.php?resourcer&ac"></script>';
				$merchant_max--;
		}
		mysqli_free_result ($teresult);
	}
}
}
//CANCEL
			
print '<form method="post">';

//AUCTION
$ores=0;
$sres=1;

if (empty($recipient_select)) {
if (!empty($_POST) and !empty($_POST['oamo']) and !empty($_POST['samo'])) {
if($merchant_max < $row->b19) {
	foreach ($_POST as $key=>$val) {
	$key = clean_post($key);
	$val = clean_post($val);
	$$key = preg_replace("@[^0-9]@si","",$val);
	//print $$key." $key $val<br>";
	}
	if(!empty($oamo) and isset($ores) and !empty($samo) and isset($sres)) {
		if ($ores <= 9 and $ores >= 0 and $sres <= 9 and $sres >= 0) {
			if($row->{"a$ores"} >= $oamo and $oamo >= 1) {
				mysqli_query ($link, "INSERT INTO `$tbl_trade` VALUES (NULL, '$row->id', 0,'$current_time','$oamo','$ores','$samo',$sres)") or die_nice(mysqli_error($link)."111");
				$to_update .= ", `a$ores`=`a$ores`-$oamo";
				print '<input type="hidden" id="xxr'.($ores+1).'r" value="'.$oamo.'">';
				print '<script src="script.php?resourcer&ac"></script>';
				$merchant_max++;
			}
		}
	}
}else{print $txt_merchant[28];}
}

print '<table><tr><th colspan="3">'.$txt_merchant[16].' '.$txt_merchant[20].'</th><th><span id="xxs'.$xxs.'">'.number_format($merchant_max).'</span>/'.number_format($row->b19).'
</th></tr>
<tr class="buildings"><td colspan="4">'.$txt_merchant[2].': <span id="mxcargo">'.number_format($merchant_cargo).'</span> 
<br>'.$txt_merchant[3].': '.clockit($travel_time).'</td></tr><tr><td colspan="4">';$xxs++;

if($merchant_max < $row->b19) {
print '<table><tr class="buildings"><td>'.$txt_merchant[17].'</td><td><input type="text" name="oamo" id="oamo" maxlength="10"></td><td><select name="ores">';
for ($i=0;$i<=9;$i++) {
	if ($i == $ores) {
		print '<option value="'.$i.'" selected>'.$a_names[$i].'</option>';
	}else{
		print '<option value="'.$i.'">'.$a_names[$i].'</option>';
	}
}
print '</select></td><td align="center"><a onclick="maxthat(\'oamo\');">'.$txt_merchant[13].'</a></td></tr>
<tr class="buildings"><td>'.$txt_merchant[18].'</td><td><input type="text" name="samo" id="samo" maxlength="10"></td><td><select name="sres">';
for ($i=0;$i<=9;$i++) {
	if ($i == $sres) {
		print '<option value="'.$i.'" selected>'.$a_names[$i].'</option>';
	}else{
		print '<option value="'.$i.'">'.$a_names[$i].'</option>';
	}
}
print '</td><td align="center"><a onclick="maxthat(\'samo\');">'.$txt_merchant[13].'</a></td></tr><tr class="buildings"><td colspan="4" align="center"><input type="submit" value="'.$txt_merchant[20].' '.$txt_merchant[16].'"></td></tr></table>';
}else{print '<table><tr class="buildings"><td colspan="4">'.$txt_merchant[28].'</td></tr></table>';}
print '<script src="script.php?trade&ac"></script>';


	$rowsPerPage = 10;
	$pageNum = 1;
	if(isset($_GET['page'])) {
		$pageNum = $_GET['page'];
	}
	$offset = ($pageNum - 1) * $rowsPerPage;

print '<table><tr><th colspan="7">'.$txt_merchant[16].' '.$txt_merchant[19].'</th></tr>
<tr class="buildings"><td colspan="2">'.$txt_merchant[17].'</td><td colspan="2">'.$txt_merchant[18].'</td><td>'.$txt_merchant[21].'</td><td>'.$txt_merchant[22].'</td><td>'.$txt_merchant[23].'</td></tr>';
//ON THE ROAD
if($teresult = mysqli_query ($link, "SELECT * FROM `$tbl_trade` WHERE `id` and `rid`='' ORDER BY `id` DESC LIMIT $offset, $rowsPerPage")){
	if(mysqli_num_rows($teresult) >= 1) {
		while ($terow = mysqli_fetch_object ($teresult)) {
			
			if ($terow->timer <= $current_time-$max_trade_timer) {
mysqli_query ($link, "DELETE FROM `$tbl_trade` WHERE `id`='$terow->id' LIMIT 1");			
			}else{

			print '<tr class="buildings"><td>'.$a_names[$terow->ores].'</td><td>'.number_format($terow->oamo).'</td><td>'.$a_names[$terow->sres].'</td></td><td>'.number_format($terow->samo).'</td><td>'.return_charname($terow->mid).'</td><td><span id="zzt'.$zzt.'" class="timer">'.clockit($current_time-($terow->timer-1)).'</span></td><td>';
			if ($terow->mid == $row->id) {
					print ' <a href="?callback='.$terow->id.'">'.$txt_merchant[25].'</a>';
			}
			if ($terow->mid !== $row->id) {
				if ($row->{"a$terow->sres"} >= $terow->samo) {
					if ($terow->oamo > $merchant_cargo) {
						print $txt_merchant[31];
					}else{
						if($merchant_max < $row->b19) {
							print ' <a href="?buy='.$terow->id.'">'.$txt_merchant[26].'</a>';
						}else{
							print $txt_merchant[28];
						}
					}
				}else{
					print $txt_merchant[27];
				}
			}
			print '</td></tr>';
			$zzt++;
}//else
		}
		mysqli_free_result ($teresult);

// how many rows we have in database
$squery   = "SELECT COUNT(`id`) AS numrows FROM `$tbl_trade` WHERE `id` and `rid`='' LIMIT 10000";
if ($sresult  = mysqli_query($link, $squery)) {
	//print mysqli_num_rows($sresult);
	if (mysqli_num_rows($sresult) >= 10) {
		$numrows = mysqli_num_rows($sresult);

// how many pages we have when using paging?
$maxPage = ceil($numrows/$rowsPerPage);

// print the link to access each page
$nav  = '';

for($page = 1; $page <= $maxPage; $page++) {
   if ($page == $pageNum)  {
      $nav .= " $page "; // no need to create a link to current page
   } else {
      $nav .= " <a href=\"?page=$page\">$page</a> ";
   } 

}

if ($pageNum > 1){
   $page  = $pageNum - 1;
   $prev  = " <a href=\"?page=$page\"><</a> ";
   } else{
   $prev  = '&nbsp;'; // we're on page one, don't print previous link
  }

if ($pageNum < $maxPage){
   $page = $pageNum + 1;
   $next = " <a href=\"?page=$page\">></a> ";
  } else{
   $next = '&nbsp;'; // we're on the last page, don't print next link
}

// print the navigation link
echo '<tr><th colspan="7">' . $prev . $nav . $next . '</th></tr>';
	}
}
	}
}
//ON THE ROAD
print '</table>';
}
//AUCTION

print '</td></tr><table></form>';
}//b19 upgraded


require_once 'admin/game.footer.php';?>