<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

require_once 'admin/functions.messaging.php';



//RECIPIENTS SERVER DEPENDEND
if(isset($_GET[$txt_messages[41]])){

$alfa='';
$recipient='';

if(!empty($_POST['alfa'])){
	$alfa=message_clean($_POST['alfa']);
	if(strlen($alfa) < 2){
		$alfa='';
	}
}
if(!empty($_POST['recipient'])){
	$recipient=message_clean($_POST['recipient']);
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


}
//RECIPIENTS SERVER DEPENDED



//REMOVE OLD MESSAGES
if($mresult=mysqli_query ($link, "SELECT `id` FROM `$tbl_messages` WHERE (`timer`<'".($current_time-$message_days_secs)."') ORDER BY `id` DESC LIMIT 1")){

if (mysqli_num_rows($mresult) >= 1) {
mysqli_query ($link, "DELETE FROM `$tbl_messages` WHERE (`timer`<'".($current_time-$message_days_secs)."') LIMIT 10000") or die(mysqli_error($link));
}
mysqli_free_result ($mresult);

}
//REMOVE OLD MESSAGES

print '<table class="messages"><tr><th colspan="4">'.$txt_messages[3].'</th></tr>
<tr><th><a href="?'.$txt_messages[41].'">'.$txt_messages[4].'</a></th>';

$i=0;foreach ($message_functions as $val) {
	if ($i==3) {print '</tr><tr>';}
	if (in_array($val,$status_array)) {
		$message_amount=message_amount($val);
		print '<th><a href="?'.$val.'">'.ucfirst($val).'</a> ('.number_format($message_amount).($message_amount >=1 ?'<a href="?'.$val.'&delete_all" title="'.$txt_messages[8].'"> '.$txt_messages[9].'</a>':'').')</th>';
	}
$i++;}

print '</tr></table>';

if(isset($_GET[$txt_messages[11]])){
	message_forward($row->id);
}elseif(isset($_GET[$txt_messages[10]])){
	message_reply($row->id);
}elseif(isset($_GET[$txt_messages[41]])){
	message_create($row->id);
}elseif(isset($_GET[$txt_messages[6]])){
	message_outbox($row->id);
}elseif(isset($_GET[$txt_messages[7]])){
	message_deleted($row->id);
}elseif(isset($_GET[$txt_messages[35]])){
	message_production($row->id);
}elseif(isset($_GET[$txt_messages[45]])){
	message_war($row->id);
}elseif(isset($_GET[$txt_messages[46]])){
	message_merchants($row->id);
}elseif(isset($_GET[$txt_messages[47]])){
	message_costs($row->id);
}else{
	message_inbox($row->id);
}

require_once 'admin/game.footer.php';?>