<?php
#!/usr/local/bin/php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$link = mysqli_connect($db_host, $db_user, $db_password, $db_main) or die_nice('DB Error');

//UPDATE GAME
require_once 'www.update.php';
update_game();
//UPDATE GAME

//UPDATE MERCHANTS
merchant_check();
//UPDATE MERCHANTS

//UPDATE MILITARY
require_once 'www.war.php';
military_check();
//UPDATE MILITARY

if (!empty($_COOKIE['username'])){
$username = clean_post($_COOKIE['username']);
}
if (!empty($_COOKIE['password'])){
$password = clean_post($_COOKIE['password']);
}
if (!empty($_COOKIE['session'])){
$session = clean_post($_COOKIE['session']);
}

if(empty($username) or empty($session)){
die_nice('1');
}

if ($result = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE (`username`='$username') ORDER BY `id` DESC LIMIT 1")) {
	if ($row = mysqli_fetch_object ($result)) {
		mysqli_free_result ($result);

//print "$row->timer >= $session-1 and $row->timer <= $session+1";
//if ($row->timer >= $session-5 and $row->timer <= $session+5) {
if (isset($password) AND crypt($row->password,$row->username) == $password) {
$to_update="`timer`='$current_time'";
setcookie ("session", "$current_time",$current_time+86400) or die_nice('cookie set failed');
$_COOKIE['session']=$current_time;
//print ' CT '.$current_time.' CS '.$_COOKIE['session'].' RT '.$row->timer;
}else{die_nice('220');}

	}else{die_nice('200');}
}else{die_nice('300');}


print '<html><head><title>'.$title.' '.date("H:i:s").'</title><style>';
include_once 'admin/script.css.php';
print '</style></head><body background="#000000"><center>';

player_resources($row);


print '<table width="100%"><tr><td width="125" valign="top">';

if ($row->j8 <= 0){
print '<script>
if (!document.layers)
document.write(\'<div id="floatmenu" style="position:absolute">\')
</script>
<layer id="floatmenu">';
}
print '<table>';
print '<tr><th class="menux">'.return_charname($row->id).'</th></tr>
<tr><th>';

$i=0;$j=0;foreach ($files as $val) {
	if ($i==5) {
		print '</tr></tr><tr><th> </th></tr><tr><th>';
		$i=0;
	}
	print '<a href="'.$val.'">'.$txt_files[$j].'</a><br>';
	$i++;$j++;
}
		$fresh_timer=$uptime-($current_time-$row->updater);
		/*if ($fresh_timer<$refresh_timer) {
			$refresh_timer=$fresh_timer;
		}*/
print '</th></tr>
<tr><th>'.$txt_menu[0].' <span id="xxt'.$xxt.'" class="timer">'.clockit($fresh_timer).'</th></tr>';
$xxt++;
print '</table>';

if ($row->j8 <= 0){
print '</layer>
<script src="script.php?float"></script>
';
}
print '</td><td valign="top">';

/*
mysqli_query ($link, "
INSERT INTO `$tbl_war` (`id`, `mid`, `rid`, `wid`, `mission`, `timer`, `mtimer`, `k0`, `k1`, `k2`, `k3`, `k4`, `k5`, `k6`, `k7`, `k8`, `k9`, `k10`, `k11`, `k12`, `k13`, `k14`, `k15`, `k16`, `k17`, `k18`, `k19`, `d0`, `d1`, `d2`, `d3`, `d4`, `d5`, `d6`, `d7`, `d8`, `d9`, `d10`, `d11`, `d12`, `d13`, `d14`, `d15`, `d16`, `d17`, `d18`, `d19`, `a0`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`, `a9`) VALUES 
('', ".rand(1,7).", 1, 0, ".rand(0,1).", $current_time+30, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('', 1, ".rand(1,7).", 0, ".rand(0,1).", $current_time+30, 0, 5000, 0, 0, 0, 1000, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)") or die_nice(mysqli_error($link));
*/

/*
$setit="`a0`=10, `a1`=10, `a2`=10, `a3`=10, `a4`=10, `a5`=10, `a6`=10, `a7`=10, `a8`=10, `a9`=10, `a10`=10, `a11`=10, `a12`=10, `a13`=10, `a14`=10, `a15`=10, `a16`=10, `a17`=10, `a18`=10, `a19`=10, `b0`=10, `b1`=10, `b2`=10, `b3`=10, `b4`=10, `b5`=10, `b6`=10, `b7`=10, `b8`=10, `b9`=10, `b10`=10, `b11`=10, `b12`=10, `b13`=10, `b14`=10, `b15`=10, `b16`=10, `b17`=10, `b18`=10, `b19`=10, `c0`=10, `c1`=10, `c2`=10, `c3`=10, `c4`=10, `c5`=10, `c6`=10, `c7`=10, `c8`=10, `c9`=10, `c10`=10, `c11`=10, `c12`=10, `c13`=10, `c14`=10, `c15`=10, `c16`=10, `c17`=10, `c18`=10, `c19`=10, `d0`=10, `d1`=10, `d2`=10, `d3`=10, `d4`=10, `d5`=10, `d6`=10, `d7`=10, `d8`=10, `d9`=10, `d10`=10, `d11`=10, `d12`=10, `d13`=10, `d14`=10, `d15`=10, `d16`=10, `d17`=10, `d18`=10, `d19`=10, `e0`=10, `e1`=10, `e2`=10, `e3`=10, `e4`=10, `e5`=10, `e6`=10, `e7`=10, `e8`=10, `e9`=10, `e10`=10, `e11`=10, `e12`=10, `e13`=10, `e14`=10, `e15`=10, `e16`=10, `e17`=10, `e18`=10, `e19`=10, `f0`=10, `f1`=10, `f2`=10, `f3`=10, `f4`=10, `f5`=10, `f6`=10, `f7`=10, `f8`=10, `f9`=10, `f10`=10, `f11`=10, `f12`=10, `f13`=10, `f14`=10, `f15`=10, `f16`=10, `f17`=10, `f18`=10, `f19`=10, `g0`=10, `g1`=10, `g2`=10, `g3`=10, `g4`=10, `g5`=10, `g6`=10, `g7`=10, `g8`=10, `g9`=10, `g10`=10, `g11`=10, `g12`=10, `g13`=10, `g14`=10, `g15`=10, `g16`=10, `g17`=10, `g18`=10, `g19`=10, `h0`=10, `h1`=10, `h2`=10, `h3`=10, `h4`=10, `h5`=10, `h6`=10, `h7`=10, `h8`=10, `h9`=10, `h10`=10, `h11`=10, `h12`=10, `h13`=10, `h14`=10, `h15`=10, `h16`=10, `h17`=10, `h18`=10, `h19`=10, `i0`=10, `i1`=10, `i2`=10, `i3`=10, `i4`=10, `i5`=10, `i6`=10, `i7`=10, `i8`=10, `i9`=10, `i10`=10, `i11`=10, `i12`=10, `i13`=10, `i14`=10, `i15`=10, `i16`=10, `i17`=10, `i18`=10, `i19`=10, `j19`=10, `k0`=10, `k1`=10, `k2`=10, `k3`=10, `k4`=10, `k5`=10, `k6`=10, `k7`=10, `k8`=10, `k9`=10, `k10`=10, `k11`=10, `k12`=10, `k13`=10, `k14`=10, `k15`=10, `k16`=10, `k17`=10, `k18`=10, `k19`=10";
*/

//mysqli_query ($link, "UPDATE `$tbl_members` SET $setit WHERE `id` LIMIT 1000");

?>