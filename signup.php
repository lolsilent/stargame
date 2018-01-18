<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';

$username='';
$password='';
$email='';
$charname='';
$session='';


$minimum_len=4;
$to_output='';

if (!empty($_COOKIE['username'])) {
	$username=clean_post($_COOKIE['username']);
}

if (!empty($_COOKIE['password'])) {
	$password=clean_post($_COOKIE['password']);
}

if (!empty($_COOKIE['session'])) {
	$session=clean_post($_COOKIE['session']);
}

if (!empty($_POST['username'])) {
	$username=clean_post($_POST['username']);
}
if (!empty($_POST['sex'])) {
	$sex=clean_post($_POST['sex']);
}
if (!empty($_POST['charname'])) {
	$charname=clean_post($_POST['charname']);
}

if (!empty($_POST['password'])) {
	$password=clean_post($_POST['password']);
}

if (!empty($_POST['email'])) {
	$email=clean_post($_POST['email']);
}

if (!empty($username) and strlen($username) >= $minimum_len and strlen($password) >= $minimum_len) {

$link = mysqli_connect($db_host, $db_user, $db_password, $db_main) or die_nice (mysqli_error($link).'db select');

if($result = mysqli_query ($link, "SELECT * FROM `$tbl_members` WHERE `username`='$username' ORDER BY `id` DESC LIMIT 1")) {
	if(mysqli_num_rows($result) >= 1) {
		if($row = mysqli_fetch_object ($result)){
			mysqli_free_result ($result);
			if ($username == $row->username and $password == $row->password) {
				mysqli_query ($link, "UPDATE `$tbl_members` SET `timer`='$current_time' WHERE `id`='$row->id' LIMIT 1") or die_nice (mysqli_error($link).'db update');
				setcookie ("username", "$row->username",$current_time+86400) or die_nice('cookie set failed');
				setcookie ("password", crypt($row->password,$row->username),$current_time+86400) or die_nice('cookie set failed');
				setcookie ("session", "$current_time",$current_time+86400) or die_nice('cookie set failed');
				$_COOKIE['username']=$row->username;
				$_COOKIE['password']=crypt($row->password,$row->username);
				$_COOKIE['session']=$current_time;
				$SuCcEsLoGiNOkE=1;
			}else{
				if ($username == $row->username and $session == $row->timer) {
					mysqli_query ($link, "UPDATE `$tbl_members` SET `timer`='$current_time' WHERE `id`='$row->id' LIMIT 1") or die_nice (mysqli_error($link).'db update');
					setcookie ("username", "$row->username",$current_time+86400) or die_nice('cookie set failed');
					setcookie ("session", "$current_time",$current_time+86400) or die_nice('cookie set failed');
					$_COOKIE['username']=$row->username;
					$_COOKIE['session']=$current_time;
					$SuCcEsLoGiNOkE=1;
				} else {
					$to_output .= 'Incorrect Credentials';
				}
			}
		}else{die_nice(mysqli_error($link).'index fetch object');}
	}else{
		if (!empty($password) and !empty($email) and !empty($_POST['signup']) and strlen($email) >= $minimum_len and strlen($charname) >= $minimum_len and ctype_alnum($charname)) {
			if (empty($sex)) {$sex='Lord';}else{$sex='Lady';}
			
			mysqli_query ($link, "INSERT INTO `$tbl_members` VALUES (NULL, '$username', '$password', '$email', '', '$sex','$charname', $current_time, $current_time, 500, 250, 0, 0, 0, 0, 0, 0, 0, 0, 100, 100, 100, 100, 100, 100, 100, 100, 100, 100, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ,0)") or die_nice(mysqli_error($link).'index insert 1');
			setcookie ("username", "$username",$current_time+86400) or die_nice('cookie set failed');
			setcookie ("password", crypt($password,$username),$current_time+86400) or die_nice('cookie set failed');
			setcookie ("session", "$current_time",$current_time+86400) or die_nice('cookie set failed');
			$_COOKIE['username']=$username;
			$_COOKIE['password']=crypt($password,$username);
			$_COOKIE['session']=$current_time;
			$SuCcEsLoGiNOkE=1;
			$to_output .= 'unknown username password combination. new account created with username '.$username.' password '.$password.'.';
		}else{
			$to_output .= 'Incorrect Credentials';
		}
	}
}else{die_nice(mysqli_error($link).'index query');}


mysqli_close ($link);
}

if (!empty($SuCcEsLoGiNOkE)) {
	header("Location: game.php");
} else {
	include_once 'admin/template.header.php';

?>
<form method="post">
<table width="275">
<tr class="buildings"><td width="50%">Username</td><td width="50%">
<input type="text" id="username" name="username" value="<?php print $username;?>" maxlength="10" onkeyup="validate(this.id);"></td></tr>
<tr class="buildings"><td>Password</td><td>
<input type="password" id="password" name="password" value="<?php print $password;?>" maxlength="10" onkeyup="validate(this.id);"></td></tr>
<tr class="buildings"><td width="50%">Sex</td><td width="50%">
<select name="sex"><option value="">Lord</option><option value="">Lady</option></select></td></tr>
<tr class="buildings"><td width="50%">Charname</td><td width="50%">
<input type="text" id="charname" name="charname" value="<?php print $charname;?>" maxlength="10" onkeyup="validate(this.id);"></td></tr>
<tr class="buildings"><td>Email</td><td>
<input type="text" id="email" name="email" value="<?php print $email;?>" maxlength="64" onkeyup="validate(this.id);"></td></tr>
<tr class="buildings"><td colspan="2">
<input type="submit" name="signup" value="Signup"></td></tr>
</table>
</form><script src="script.php?validate"></script>
<?php


if (!empty($_POST)) {
	foreach ($_POST as $key=>$val) {
		if (!empty($val) and !isset($val{3})) {
			print ucfirst($key).' '.$val.' field is too short.<br>';
		}
	}
}

print $to_output;
	include_once 'admin/template.footer.php';
}
?>