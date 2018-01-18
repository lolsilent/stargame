
<table class="topmenu"><?php
if (!preg_match('@index@',$_SERVER['PHP_SELF'])) {
?><tr><th><a href="index.php">Login</a></th></tr><?php
}
if (!preg_match('@signup@',$_SERVER['PHP_SELF'])) {
?><tr><th><a href="signup.php">Signup</a></th></tr><?php
}
?><tr><th><a href="ladder.php">Ladder</a></th></tr><?php
?><tr><th></th></tr><?php
?></table></td></tr></table>


</body></html>