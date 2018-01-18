<?php

//$to_update .=", `updater`=$current_time-500";

if (!empty($to_update)) {
	mysqli_query ($link, "UPDATE `$tbl_members` SET $to_update WHERE `id`='$row->id' LIMIT 1") or die_nice(mysqli_error($link).' CODE '.$to_update);
	//print $to_update;print ' CT '.$current_time.' CS '.$_COOKIE['session'].' RT '.$row->timer;
}
if (isset($link)) {
	mysqli_close($link);
}

if ($refresh_timer >= 1 and $row->j5 == 0) {
print '<meta http-equiv="refresh" content="'.($refresh_timer+2).'">';
//print $refresh_timer;
}


?></td></tr></table></center>
<p class="bfoot">
&copy;<?php print date("Y");?> <a href="https://thesilent.com">The silenT</a> v0.91 <span id="zzt<?php print $zzt;$zzt++;?>">00:00:01</span>
</p><script src="script.php?xtimer"></script></body></html>