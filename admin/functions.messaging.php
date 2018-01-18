<?php
#!/usr/local/bin/php
/*
###_______________-=TheSilenT.CoM=-_______________###
Project name	: Messaging Funcion
Script name	: Script name
Version		: 1.00
Release date	: 2-15-2008 03:32:55
Last Update	: 3-13-2008 04:45:02
Email		: admin@thesilent.com
Homepage	: https://thesilent.com
Created by	: TheSilent
Last modified by	: TheSilent
###_______________COPYRIGHT NOTICE_______________###
# Redistributing this software in part or in whole strictly prohibited.
# You may use and modified my software as you wish. 
# If you want to make money from my work please ask first. 
# By using this free software you agree not to blame me for any
# liability that might arise from it's use.
# In all cases this copyright notice and the comments above must remain intact.
# Copyright (c) 2001 TheSilenT.CoM.  All Rights Reserved.
###_______________COPYRIGHT NOTICE_______________###
*/
$message_days = 3; //days to keep messages
$message_days_secs = $message_days*84600;//days to keep messages UNIX
$message_limit = 25; //max number of messages to keep/display

$delay_timer = 5; //wait seconds before the second message is allowed to send





$message_functions = array($txt_messages[5],$txt_messages[6],$txt_messages[7],$txt_messages[35],$txt_messages[45],$txt_messages[46],$txt_messages[47]);

$status_array = array(
$txt_messages[5] => 0,
$txt_messages[6] => 1,
$txt_messages[7] => 2,
$txt_messages[35] => 3,
//4 = deleted messages
$txt_messages[45] => 5,
$txt_messages[46] => 6,
$txt_messages[47] => 7,
);

/*
function inbox_amount() {
	global $row,$tbl_messages,$gid,$current_time,$message_limit;

$mquery="SELECT `id` FROM `$tbl_messages` WHERE (`gid`='$gid' AND `rid`='$row->id' AND `status`='0' AND `delay_timer`<='$current_time') ORDER BY `id` DESC LIMIT $message_limit";
if($mresult=mysqli_query($link, $mquery)){
return $num_rows = mysqli_num_rows($mresult);
mysqli_free_result($mresult);
}

}
*/
/*_______________-=TheSilenT.CoM=-_________________*/

function message_amount($in) {
	global $row,$tbl_messages,$gid,$current_time,$message_limit,$status_array,$txt_messages,$link;

if ($in == $txt_messages[5]) {
	$mid_rid = 'rid';
}else{
	$mid_rid = 'mid';
}

$mquery="SELECT `id` FROM `$tbl_messages` WHERE (`gid`='$gid' AND `$mid_rid`='$row->id' AND `status`='".$status_array[$in]."'  AND `delay_timer`<='$current_time') ORDER BY `id` DESC LIMIT $message_limit";

if($mresult=mysqli_query($link, $mquery)){
	$num_rows = mysqli_num_rows($mresult);
return $num_rows;
	
mysqli_free_result($mresult);
}

}
/*_______________-=TheSilenT.CoM=-_________________*/

function message_inbox($mid) {
	global $row,$tbl_messages,$gid,$current_time,$message_limit,$txt_messages,$zzt,$link;
$linkstart = '?'.$txt_messages[5];

$mquery="SELECT * FROM `$tbl_messages` WHERE (`gid`='$gid' AND `rid`='$row->id' AND `status`='0' AND `delay_timer`<='$current_time') ORDER BY `id` DESC LIMIT $message_limit";

if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	while ($mrow=mysqli_fetch_object($mresult)){
		$linkstart .='&did='.$mrow->id;
print '<table class="messages"><tr class="messages">'.($mrow->mid>=1?'<th><a href="'.$linkstart.'&'.$txt_messages[10].'">'.ucfirst($txt_messages[10]).'</a></th>':'').'<th><a href="'.$linkstart.'&'.$txt_messages[41].'&'.$txt_messages[11].'">'.ucfirst($txt_messages[11]).'</a></th><th><a href="'.$linkstart.'&'.$txt_messages[12].'">'.ucfirst($txt_messages[12]).'</a></th><th>'.$mrow->dater.' - <span id="zzt'.$zzt.'" class="timer">'.message_dater($mrow->timer).'</span></th></tr><tr class="messagesb"><td colspan="4">'.message_post($mrow->body);$zzt++;

if(isset($_GET['delete']) or isset($_GET['delete_all'])){
	if(!empty($_GET['did']) or isset($_GET['delete_all'])) {
		if (empty($_GET['did'])){$_GET['did']='';}
		if($_GET['did'] == $mrow->id or isset($_GET['delete_all'])) {
mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='2',`mid`='$row->id', `rid`='' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'3');
print '<p>'.$txt_messages[13].'</p>';
		}
	}
}/*elseif($row->j1 <= 0) {
	mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='2',`mid`='$row->id', `rid`='' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'3');
}*/

print '</td></tr></table>';
	}
	mysqli_free_result($mresult);
} else {
print '<p>'.$txt_messages[14].'</p>';
}
}

}

/*_______________-=TheSilenT.CoM=-_________________*/

function message_outbox($mid) {
	global $row,$tbl_messages,$gid,$current_time,$message_limit,$db_main,$dbm_main,$tbl_members,$txt_messages,$zzt,$link;
$linkstart = '?'.$txt_messages[6];

$mquery="SELECT * FROM `$tbl_messages` WHERE (`gid`='$gid' AND `rid` AND `mid`='$row->id' AND `status`='1' AND `delay_timer`<='$current_time') ORDER BY `id` DESC LIMIT $message_limit";

$arid = array();
$out_boxed = '';
if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	while ($mrow=mysqli_fetch_object($mresult)){
		if(!in_array($mrow->rid,$arid)) {
			$arid[$mrow->rid]='@\[ARID\]'.$mrow->rid.'\[\/ARID\]@si';
		}
		$linkstart .='&did='.$mrow->id;
$out_boxed .= '<table class="messages"><tr class="messages"><th><a href="'.$linkstart.'&'.$txt_messages[41].'&'.$txt_messages[11].'">'.ucfirst($txt_messages[11]).'</a></th><th><a href="'.$linkstart.'&'.$txt_messages[12].'">'.ucfirst($txt_messages[12]).'</a></th><th>[ARID]'.$mrow->rid.'[/ARID]</th><th>'.$mrow->dater.' - <span id="zzt'.$zzt.'" class="timer">'.message_dater($mrow->timer).'</span></th></tr><tr class="messagesb"><td colspan="4">'.message_post($mrow->body);$zzt++;

if(isset($_GET['delete']) or isset($_GET['delete_all'])){
	if(!empty($_GET['did']) or isset($_GET['delete_all'])) {
		if (empty($_GET['did'])){$_GET['did']='';}
		if($_GET['did'] == $mrow->id or isset($_GET['delete_all'])) {
mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='2',`mid`='$row->id', `rid`='' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'3');
$out_boxed .= '<p>'.$txt_messages[13].'</p>';
		}
	}
}/*elseif($row->j1 <= 0) {
	mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='2',`mid`='$row->id', `rid`='' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'3');
}*/
$out_boxed .= '</td></tr></table>';
	}
	mysqli_free_result($mresult);

//RECIPIENT
$mids = '';
ksort($arid);
foreach ($arid as $key=>$val) {
if (!empty($mids)) {$mids .= ' OR ';}
$mids .= "`id`='$key'";
}
//print $mids;

$minfo = array();

$iquery="SELECT `id`,`charname` FROM `$tbl_members` WHERE ($mids) ORDER BY `id` ASC LIMIT $message_limit";
if($iresult=mysqli_query($iquery)) {
if (mysqli_num_rows($iresult) >= 1) {
	while ($irow=mysqli_fetch_object($iresult)){
		//$minf= $irow->id.'';
		$minf=$irow->charname;
		$minfo[$irow->id]=$minf;
	}
	mysqli_free_result($iresult);
}
}


//print '<hr>';print_r($arid);print '<hr>';print_r($minfo);print '<hr>';
ksort($minfo);

print preg_replace (array_values($arid),array_values($minfo),$out_boxed);
//RECIPIENT
//print $out_boxed;
} else {
print '<p>'.$txt_messages[15].'</p>';
}
}
}

/*_______________-=TheSilenT.CoM=-_________________*/

function message_deleted($mid) {
	global $row,$tbl_messages,$gid,$current_time,$message_limit,$txt_messages,$zzt,$link;
$linkstart = '?'.$txt_messages[7];

$mquery="SELECT * FROM `$tbl_messages` WHERE (`gid`='$gid' AND !`rid` AND `mid`='$row->id' AND `status`='2' AND `delay_timer`<='$current_time') ORDER BY `id` DESC LIMIT $message_limit";

if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	while ($mrow=mysqli_fetch_object($mresult)){
		$linkstart .='&did='.$mrow->id;
print '<table class="messages"><tr class="messages"><th><a href="'.$linkstart.'&'.$txt_messages[41].'&'.$txt_messages[11].'">'.ucfirst($txt_messages[11]).'</a></th><th><a href="'.$linkstart.'&'.$txt_messages[12].'">'.ucfirst($txt_messages[16]).'</a></th><th>'.$mrow->dater.' - <span id="zzt'.$zzt.'" class="timer">'.message_dater($mrow->timer).'</span></th></tr><tr class="messagesb"><td colspan="4">'.message_post($mrow->body);$zzt++;

if(isset($_GET['delete']) or isset($_GET['delete_all'])){
	if(!empty($_GET['did']) or isset($_GET['delete_all'])) {
		if (empty($_GET['did'])){$_GET['did']='';}
		if($_GET['did'] == $mrow->id or isset($_GET['delete_all'])) {
//mysqli_query ($link, "DELETE FROM `$tbl_messages` WHERE `id`='$mrow->id' LIMIT 1");
mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='4', `timer`='$current_time' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'4');
print '<p>'.$txt_messages[18].'</p>';
		}
	}
}

print '</td></tr></table>';
	}
	mysqli_free_result($mresult);
} else {
print '<p>'.$txt_messages[19].'</p>';
}
}

}

/*_______________-=TheSilenT.CoM=-_________________*/
function message_costs($mid) {
	global $row,$tbl_messages,$gid,$current_time,$message_limit,$txt_messages,$zzt,$link;
$linkstart = '?'.$txt_messages[47];

$mquery="SELECT * FROM `$tbl_messages` WHERE (`gid`='$gid' AND `mid`='$row->id' AND `status`='7') ORDER BY `id` DESC LIMIT $message_limit";

if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	while ($mrow=mysqli_fetch_object($mresult)){
		$linkstart .='&did='.$mrow->id;
print '<table class="messages"><tr class="messages"><th><a href="'.$linkstart.'&'.$txt_messages[41].'&'.$txt_messages[11].'">'.ucfirst($txt_messages[11]).'</a></th><th><a href="'.$linkstart.'&'.$txt_messages[12].'">'.ucfirst($txt_messages[16]).'</a></th><th>'.$mrow->dater.' - <span id="zzt'.$zzt.'" class="timer">'.message_dater($mrow->timer).'</span></th></tr><tr class="messagesb"><td colspan="4">'.message_post($mrow->body);$zzt++;

if(isset($_GET['delete']) or isset($_GET['delete_all'])){
	if(!empty($_GET['did']) or isset($_GET['delete_all'])) {
		if (empty($_GET['did'])){$_GET['did']='';}
		if($_GET['did'] == $mrow->id or isset($_GET['delete_all'])) {
mysqli_query ($link, "DELETE FROM `$tbl_messages` WHERE `id`='$mrow->id' LIMIT 1");
//mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='4', `timer`='$current_time' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'4');
print '<p>'.$txt_messages[18].'</p>';
		}
	}
}elseif($row->j1 <= 0) {
	mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='2',`mid`='$row->id', `rid`='' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'3');
}

print '</td></tr></table>';
	}
	mysqli_free_result($mresult);
} else {
print '<p>'.$txt_messages[19].'</p>';
}
}

}
/*_______________-=TheSilenT.CoM=-_________________*/
function message_merchants($mid) {
	global $row,$tbl_messages,$gid,$current_time,$message_limit,$txt_messages,$zzt,$link;
$linkstart = '?'.$txt_messages[46];

$mquery="SELECT * FROM `$tbl_messages` WHERE (`gid`='$gid' AND `mid`='$row->id' AND `status`='6') ORDER BY `id` DESC LIMIT $message_limit";

if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	while ($mrow=mysqli_fetch_object($mresult)){
		$linkstart .='&did='.$mrow->id;
print '<table class="messages"><tr class="messages"><th><a href="'.$linkstart.'&'.$txt_messages[41].'&'.$txt_messages[11].'">'.ucfirst($txt_messages[11]).'</a></th><th><a href="'.$linkstart.'&'.$txt_messages[12].'">'.ucfirst($txt_messages[16]).'</a></th><th>'.$mrow->dater.' - <span id="zzt'.$zzt.'" class="timer">'.message_dater($mrow->timer).'</span></th></tr><tr class="messagesb"><td colspan="4">'.message_post($mrow->body);$zzt++;

if(isset($_GET['delete']) or isset($_GET['delete_all'])){
	if(!empty($_GET['did']) or isset($_GET['delete_all'])) {
		if (empty($_GET['did'])){$_GET['did']='';}
		if($_GET['did'] == $mrow->id or isset($_GET['delete_all'])) {
mysqli_query ($link, "DELETE FROM `$tbl_messages` WHERE `id`='$mrow->id' LIMIT 1");
//mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='4', `timer`='$current_time' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'4');
print '<p>'.$txt_messages[18].'</p>';
		}
	}
}elseif($row->j1 <= 0) {
	mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='2',`mid`='$row->id', `rid`='' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'3');
}

print '</td></tr></table>';
	}
	mysqli_free_result($mresult);
} else {
print '<p>'.$txt_messages[19].'</p>';
}
}

}
/*_______________-=TheSilenT.CoM=-_________________*/
function message_war($mid) {
	global $row,$tbl_messages,$gid,$current_time,$message_limit,$txt_messages,$zzt,$link;
$linkstart = '?'.$txt_messages[45];

$mquery="SELECT * FROM `$tbl_messages` WHERE (`gid`='$gid' AND `mid`='$row->id' AND `status`='5') ORDER BY `id` DESC LIMIT $message_limit";

if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	while ($mrow=mysqli_fetch_object($mresult)){
		$linkstart .='&did='.$mrow->id;
print '<table class="messages"><tr class="messages"><th><a href="'.$linkstart.'&'.$txt_messages[41].'&'.$txt_messages[11].'">'.ucfirst($txt_messages[11]).'</a></th><th><a href="'.$linkstart.'&'.$txt_messages[12].'">'.ucfirst($txt_messages[16]).'</a></th><th>'.$mrow->dater.' - <span id="zzt'.$zzt.'" class="timer">'.message_dater($mrow->timer).'</span></th></tr><tr class="messagesb"><td colspan="4">'.message_post($mrow->body);$zzt++;

if(isset($_GET['delete']) or isset($_GET['delete_all'])){
	if(!empty($_GET['did']) or isset($_GET['delete_all'])) {
		if (empty($_GET['did'])){$_GET['did']='';}
		if($_GET['did'] == $mrow->id or isset($_GET['delete_all'])) {
mysqli_query ($link, "DELETE FROM `$tbl_messages` WHERE `id`='$mrow->id' LIMIT 1");
//mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='4', `timer`='$current_time' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'4');
print '<p>'.$txt_messages[18].'</p>';
		}
	}
}elseif($row->j1 <= 0) {
	mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='2',`mid`='$row->id', `rid`='' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'3');
}

print '</td></tr></table>';
	}
	mysqli_free_result($mresult);
} else {
print '<p>'.$txt_messages[19].'</p>';
}
}

}
/*_______________-=TheSilenT.CoM=-_________________*/
function message_production($mid) {
	global $row,$tbl_messages,$gid,$current_time,$message_limit,$txt_messages,$zzt,$link;
$linkstart = '?'.$txt_messages[35];

$mquery="SELECT * FROM `$tbl_messages` WHERE (`gid`='$gid' AND `mid`='$row->id' AND `status`='3') ORDER BY `id` DESC LIMIT $message_limit";

if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
	while ($mrow=mysqli_fetch_object($mresult)){
		$linkstart .='&did='.$mrow->id;
print '<table class="messages"><tr class="messages"><th><a href="'.$linkstart.'&'.$txt_messages[41].'&'.$txt_messages[11].'">'.ucfirst($txt_messages[11]).'</a></th><th><a href="'.$linkstart.'&'.$txt_messages[12].'">'.ucfirst($txt_messages[16]).'</a></th><th>'.$mrow->dater.' - <span id="zzt'.$zzt.'" class="timer">'.message_dater($mrow->timer).'</span></th></tr><tr class="messagesb"><td colspan="4">'.message_post($mrow->body);$zzt++;

if(isset($_GET['delete']) or isset($_GET['delete_all'])){
	if(!empty($_GET['did']) or isset($_GET['delete_all'])) {
		if (empty($_GET['did'])){$_GET['did']='';}
		if($_GET['did'] == $mrow->id or isset($_GET['delete_all'])) {
mysqli_query ($link, "DELETE FROM `$tbl_messages` WHERE `id`='$mrow->id' LIMIT 1");
//mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='4', `timer`='$current_time' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'4');
print '<p>'.$txt_messages[18].'</p>';
		}
	}
}elseif($row->j1 <= 0) {
	mysqli_query ($link, "UPDATE `$tbl_messages` SET `status`='2',`mid`='$row->id', `rid`='' WHERE `id`='$mrow->id' LIMIT 1") or die_nice(mysqli_error($link).'3');
}

print '</td></tr></table>';
	}
	mysqli_free_result($mresult);
} else {
print '<p>'.$txt_messages[19].'</p>';
}
}

}

/*_______________-=TheSilenT.CoM=-_________________*/
function message_create($mid) {
	global $row,$tbl_messages,$fld_messages,$gid,$current_time,$current_date,$message_limit,$alfa,$recipient_select,$txt_messages,$link;

$message='';
if(!empty($_POST['message'])){
	$message=message_clean($_POST['message']);
}
if(!empty($_POST['recipient'])){
	$recipient=message_clean($_POST['recipient']);
}

$max_characters = 5000;
$delivery_time = 5;

if (empty($alfa) or empty($recipient_select)) {
print '<form method="post">
<table width="250">
<tr class="messages"><td width="50%" align="right"><input type="text" name="alfa" value="'.$alfa.'" maxlength="10"></td><td><input type="submit" value="'.$txt_messages[20].'"></td></tr><td colspan="2">
'.$txt_messages[21].'</td></tr></table></form>';
if (!empty($alfa) and empty($recipient_select)) {
print $txt_messages[22];
}
}else{
print '<form method="post" name="message_form">
<table class="messages"><tr class="messages"><th colspan="3">'.$txt_messages[23].'</th></tr>
<input type=hidden name="alfa" value="'.$alfa.'" maxlength="10">
<tr class="messages"><td width="100">'.$txt_messages[24].'</td><td colspan="2">'.$recipient_select.'</td></tr>
<tr class="messages"><td width="100">'.$txt_messages[25].'</td><td colspan="2"><textarea cols="50" rows="5" onKeyDown="count(document.message_form.message,document.message_form.counter,'.$max_characters.')"
onKeyUp="count(document.message_form.message,document.message_form.counter,'.$max_characters.')" name="message">'.$message.'</textarea>
</td></tr>
<tr class="messages"><td>'.$txt_messages[26].'</td><td><input disabled readonly type="text" name="counter" class="counter" size="5" maxlength="5" value="'.($max_characters-strlen($message)).'">
</td><td><input type="submit" value="'.$txt_messages[27].'"></td></tr>
</table>
</form>
<script language="javascript">
<!--
function count(field,counter,maxlimit) {
if (field.value.length > maxlimit)
field.value = field.value.substring(0, maxlimit);
else
counter.value = maxlimit - field.value.length;
}
//-->
</script>
';
}

//SEND MESSAGE
if (!empty($message) and !empty($recipient)) {
	if (strlen($message) <= $max_characters) {

$last_send=0;
if($pmresult=mysqli_query ($link, "SELECT `id` FROM `$tbl_messages` WHERE (`delay_timer`>'$current_time') ORDER BY `id` DESC LIMIT 1")){
$last_send = mysqli_num_rows($pmresult);
mysqli_free_result ($pmresult);
}

		if ($last_send <= 0) {

$message .= '

'.$txt_messages[28].',
'.$row->clan.' '.$row->sex.' '.$row->charname;

	mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$row->id', '$recipient', '$message', '0', '0', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	
	mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$row->id', '$recipient', '$message', '0', '1', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	
	//TEST SEND A COPY TO MYSELF
	//mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$recipient', '$row->id', '$message', '0', '0', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	print '<span class="maxed">'.$txt_messages[31].'</span>';
		}else{
			print '<span class="maxed">'.$txt_messages[29].'</span>';
		}
	}else{
	print '<span class="maxed">'.$txt_messages[30].'</span>';
	}
}
//SEND MESSAGE
}

/*_______________-=TheSilenT.CoM=-_________________*/

function message_reply($mid) {
		global $row,$tbl_messages,$fld_messages,$gid,$current_time,$current_date,$message,$txt_messages,$link;

if(!empty($_GET['did'])) {

if(!empty($_GET['did'])){
	$did = clean_post($_GET['did']);
}

$mquery="SELECT * FROM `$tbl_messages` WHERE `id`='$did' ORDER BY `id` DESC LIMIT 1";

if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
if ($mrow=mysqli_fetch_object($mresult)){
mysqli_free_result ($mresult);

$message='';
if(!empty($_POST['message'])){
	$message=message_clean($_POST['message']);
}

$max_characters = 5000;
$delivery_time = 5;

print '<form method="post" action="?'.$txt_messages[10].'&did='.$did.'" name="message_form">
<table class="messages">
<tr class="messages"><th colspan="3">'.$txt_messages[32].'</th></tr>
<tr class="messages"><td width="100">'.$txt_messages[25].'</td><td colspan="2"><textarea cols="50" rows="5" onKeyDown="count(document.message_form.message,document.message_form.counter,'.$max_characters.')"
onKeyUp="count(document.message_form.message,document.message_form.counter,'.$max_characters.')" name="message">'.$message.'</textarea>
</td></tr>
<tr class="messages"><td>'.$txt_messages[26].'</td><td><input disabled readonly type="text" name="counter" class="counter" size="5" maxlength="5" value="'.($max_characters-strlen($message)).'">
</td><td><input type="submit" value="'.$txt_messages[33].'"></td></tr>
</table>';

//SEND MESSAGE
if (!empty($message)) {
	if (strlen($message) <= $max_characters) {

$last_send=0;
if($pmresult=mysqli_query ($link, "SELECT `id` FROM `$tbl_messages` WHERE (`delay_timer`>'$current_time') ORDER BY `id` DESC LIMIT 1")){
$last_send = mysqli_num_rows($pmresult);
mysqli_free_result ($pmresult);
}

		if ($last_send <= 0) {

$message .= '

'.$txt_messages[34].',
'.$row->clan.' '.$row->sex.' '.$row->charname;

	mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$row->id', '$mrow->mid', '$message', '0', '0', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	
	mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$row->id', '$mrow->mid', '$message', '0', '1', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	
	//TEST SEND A COPY TO MYSELF
	//mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$mrow->mid', '$row->id', '$message', '0', '0', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	print '<span class="maxed">'.$txt_messages[31].'</span>';
		}else{
			print '<span class="maxed">'.$txt_messages[29].'</span>';
		}
	}else{
	print '<span class="maxed">'.$txt_messages[30].'</span>';
	}
}
//SEND MESSAGE

print '<table class="messages">
<tr class="messages"><th>'.$txt_messages[36].'</th><th>'.$mrow->dater.' - '.message_dater($mrow->timer).'</th></tr>
<tr class="messagesb"><td colspan="2">'.message_post($mrow->body).'</td></tr></table>
</form>
<script language="javascript">
<!--
function count(field,counter,maxlimit) {
if (field.value.length > maxlimit)
field.value = field.value.substring(0, maxlimit);
else
counter.value = maxlimit - field.value.length;
}
//-->
</script>
';

}
}
}

}

}

/*_______________-=TheSilenT.CoM=-_________________*/

function message_forward($mid) {
		global $row,$tbl_messages,$fld_messages,$gid,$current_time,$current_date,$message,$alfa,$recipient_select,$recipient,$message,$txt_messages,$link;

if(!empty($_GET['did'])) {

if(!empty($_GET['did'])){
	$did = clean_post($_GET['did']);
}

$mquery="SELECT * FROM `$tbl_messages` WHERE `id`='$did' ORDER BY `id` DESC LIMIT 1";

if($mresult=mysqli_query($link, $mquery)) {
if (mysqli_num_rows($mresult) >= 1) {
if ($mrow=mysqli_fetch_object($mresult)){
mysqli_free_result ($mresult);

$message='';
if(!empty($_POST['message'])){
	$message=message_clean($_POST['message']);
}

$max_characters = 5000-strlen($mrow->body);
$delivery_time = 5;

if (empty($alfa) or empty($recipient_select)) {
print '<form method="post">
<table width="250">
<tr class="messages"><td width="50%" align="right"><input type="text" name="alfa" value="'.$alfa.'" maxlength="10"></td><td><input type="submit" value="Find player"></td></tr>
</table>Use at least two characters to find a player containing these characters.
</form>';
if (!empty($alfa) and empty($recipient_select)) {
print 'No players found containing your search term.';
}
}else{
print '<form method="post" name="message_form">
<table class="messages"><tr class="messages"><th colspan="3">'.$txt_messages[37].'</th></tr>
<input type="hidden" name="alfa" value="'.$alfa.'" maxlength="10">
<tr class="messages"><td width="100">Recipient</td><td colspan="2">'.$recipient_select.'</td></tr>
<tr class="messages"><td width="100">'.$txt_messages[38].'</td><td colspan="2"><textarea cols="50" rows="5" onKeyDown="count(document.message_form.message,document.message_form.counter,'.$max_characters.')"
onKeyUp="count(document.message_form.message,document.message_form.counter,'.$max_characters.')" name="message">'.$message.'</textarea>
</td></tr>
<tr class="messages"><td>'.$txt_messages[26].'</td><td><input disabled readonly type="text" name="counter" class="counter" size="5" maxlength="5" value="'.($max_characters-strlen($message)).'">
</td><td><input type="submit" value="Send message"></td></tr>
</table>
</form>
<script language="javascript">
<!--
function count(field,counter,maxlimit) {
if (field.value.length > maxlimit)
field.value = field.value.substring(0, maxlimit);
else
counter.value = maxlimit - field.value.length;
}
//-->
</script>
';
}

//SEND MESSAGE
if (!empty($message) and !empty($recipient)) {
	if (strlen($message) <= $max_characters) {

$last_send=0;
if($pmresult=mysqli_query ($link, "SELECT `id` FROM `$tbl_messages` WHERE (`delay_timer`>'$current_time') ORDER BY `id` DESC LIMIT 1")){
$last_send = mysqli_num_rows($pmresult);
mysqli_free_result ($pmresult);
}

		if ($last_send <= 0) {

$message .= '

'.$txt_messages[39].',
'.$row->clan.' '.$row->sex.' '.$row->charname;

	mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$row->id', '$recipient', '$mrow->body<hr>$message', '0', '0', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	
	mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$row->id', '$recipient', '$mrow->body<hr>$message', '0', '1', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	
	//TEST SEND A COPY TO MYSELF
	//mysqli_query ($link, "INSERT INTO `$tbl_messages` ($fld_messages) VALUES (NULL, '$gid', '$recipient', '$row->id', '$message', '0', '0', '$current_date', $current_time+$delivery_time, $current_time)") or die_nice(mysqli_error($link));
	print '<span class="maxed">'.$txt_messages[31].'</span>';
		}else{
			print '<span class="maxed">'.$txt_messages[29].'</span>';
		}
	}else{
	print '<span class="maxed">'.$txt_messages[30].'</span>';
	}
}
//SEND MESSAGE

print '<table class="messages">
<tr class="messages"><th>'.$txt_messages[40].'</th><th>'.$mrow->dater.' - '.message_dater($mrow->timer).'</th></tr>
<tr class="messagesb"><td colspan="2">'.message_post($mrow->body).'</td></tr></table>
</form>
<script language="javascript">
<!--
function count(field,counter,maxlimit) {
if (field.value.length > maxlimit)
field.value = field.value.substring(0, maxlimit);
else
counter.value = maxlimit - field.value.length;
}
//-->
</script>
';

}
}
}

}
}

/*_______________-=TheSilenT.CoM=-_________________*/


function message_post($in) {
$hi=array (
'@\n@si',
'@\[quote\](.*?)\[/quote\]@si',
'@\[img\](http:\/\/.*?)\[/img\]@si',
'@\[url\](http:\/\/.*?)\[/url\]@si',
'@\[url=(http:\/\/.*?)\](.*?)\[/url\]@si',
'@\[email\](.*?\@.*?\..*?)\[/email\]@si',
'@\[c=(.*?)\](.*?)\[/c\]@si',
);

$ha=array (
'<br>',
'<blockquote><hr>\1<hr></blockquote>',
'<img src="\1" border="0">',
'<a href="\1" target="_blank">\1</a>',
'<a href="\1" target="_blank">\2</a>',
'<a href="mailto:\1\">\1</a>',
'<font color="\1">\2</font>',
);
$in=preg_replace($hi, $ha, $in);

return stripslashes($in);
}

/*_______________-=TheSilenT.CoM=-_________________*/

function message_clean ($in){

$in=htmlentities("$in",ENT_QUOTES);
$in=strip_tags($in);
$in=trim($in);
$in=addslashes($in);
return $in;
}

/*_______________-=TheSilenT.CoM=-_________________*/

function message_dater($secs){
global $current_time;
$s='';$i=0;
if ($current_time-$secs < 0){
$secs=round($secs-$current_time);
}else{
$secs=round($current_time-$secs);
}

if($secs>= 3600){
$n=(int)($secs/3600);$s .=($n<=9?'0':'').$n.':';$secs %= 3600;
}else{$s.='00:';}

if($secs>= 60){
$n=(int)($secs/60);$s .=($n<=9?'0':'').$n.':';$secs %= 60;
}else{$s.='00:';}

if($secs>=1){
$s .=($secs<=9?'0':'').$secs;
}elseif($secs<=0){
$s .='00';
}
return trim($s);
}


/*_______________-=TheSilenT.CoM=-_________________*/
?>