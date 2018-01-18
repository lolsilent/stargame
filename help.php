<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';
require_once 'admin/game.header.php';

$helpie = array(
"game.php" => "Overviews of everything
",
"buildings.php" => "Overview of your buildings where you can build new or upgrade existing buildings.
Click on a building name for it's previous and next level effects if available.
Any progress can be cancelled at anytime.
Click on the slots to order everything if affordable.

",
"resources.php" => "Overview of your resource production, resource requirements, overall results and storage capacity.
Standard all buildings are running 100% if you wish to produce less you may change it's production capacity.
",
"merchant.php" => "Overview of incoming and outgoing merchants, you can cancel any outgoing merchants at any time.
",
"trade.php" => "Put a merchant on the market with resources for trade.
The opposing party can recall it's merchants at anytime so be aware for cheaters.
",
"science.php" => "Research to improve allot things.
Any progress can be cancelled at anytime.
Click on the slots to order everything if affordable.
",
"military.php" => "Train military units.
All military units require food and water to survive.
If you don't feed you military they will start deserting.
Any progress can be cancelled at anytime.
Click on the slots to order everything if affordable.
",
"offence.php" => "Facilities to increase offence power.
Train animals to help your troops in combat.
All pets require an master unit.
Any progress can be cancelled at anytime.
Click on the slots to order everything if affordable.
",
"defence.php" => "Facilities to increase defence power.
All facilities require garrison.
Any progress can be cancelled at anytime.
Click on the slots to order everything if affordable.
",
"messages.php" => "All messages.
You can Create New Message, see your Inbox, Outbox, Deleted Box.
Messages from your Production managers, War generals, Merchants arrivals, Costs.
Some messages can be turned off in options menu.
",
"options.php" => "Game options.
Message options.
",
"logout.php" => "Leave game.
Removes all cookies when applicable.
",
"help.php" => "You are here!
Reviewed / added information / reviewed on:
25-3-2008 20:05:00
3-20-2008 03:37:30
3-18-2008 05:01:10
",
);

print '<table><tr><th colspan="4">Go to war</th></tr>
<tr class="buildings"><td colspan="4">To succeed you can use brute force by sending a force stronger than the defending force.
But using the right unit for right job will safe you allot resources and will be allot cheaper when attacking an stronger opponent.<br>
<br>
Any army unit that\'s not at home base does not need food!

</td></tr>
<tr><th>Mission</th><th>Duration</th><th>Alternative</th><th>Effect</th></tr>
<tr class="buildings"><td><b>Spy Report</b></td><td>'.clockit(mission_timer(0)).'</td><td><b>'.$military_units_names[0].'</b> with <b>'.$o_names[0].'</b></td><td>Get a report on the opponent.</td></tr>
<tr class="buildings"><td><b>Attack</b></td><td>'.clockit(mission_timer(1)).'</td><td></td><td>Attack To Kill and Plunder Resources</td></tr>
<tr class="buildings"><td><b>Reinforcements</b></td><td>'.clockit(mission_timer(2)).'</td><td></td><td>Send Army To Join The Army<br>If you callback the main troops you automatically callback your reinforcements.</td></tr>
<tr class="buildings"><td><b>Intercept Army</b></td><td>'.clockit(mission_timer(3)).'</td><td></td><td>Attempt To Stop An Invading Army<br>If the opponent callback his troops you automaticly callback your Intercepting troops.</td></tr></table>
';


print '<table>
<tr><th>Newbie protection</th></tr>
<tr class="buildings"><td>New players are protected for '.($noob_time/3600).' hours after first login before they can be attacked.</td></tr>

<tr><th>M.A.C.</th></tr>
<tr class="buildings"><td>M.A.C. = Massive Attack Control prevents a player from attacked over and over again.</td></tr>

<tr><th>Multi Accounting</th></tr>
<tr class="buildings"><td>Prohibited, not allowed, forbidden, no more than one account per player.</td></tr>
';

$j=0;foreach ($files as $val) {
	if (isset($helpie[$val])) {
		print '<tr><th>'.$txt_files[$j].'</th></tr><tr class="buildings"><td>'.preg_replace('@\n@','<br>',$helpie[$val]).'</td></tr>';
		}
$j++;
}
print '</table>';

/*
<tr class="buildings"><td><b>Plunder Food</b></td><td>'.clockit(mission_timer(2)).'</td><td><b>'.$military_units_names[7].'</b> with <b>'.$o_names[7].'</b></td><td>Steal water and Food</td></tr>
<tr class="buildings"><td><b>Burn Food</b></td><td>'.clockit(mission_timer(3)).'</td><td><b>'.$military_units_names[15].'</b> with <b>'.$o_names[15].'</b></td><td>Destroy allot water and food storage</td></tr>
<tr class="buildings"><td><b>Plunder Ore</b></td><td>'.clockit(mission_timer(4)).'</td><td><b>'.$military_units_names[16].'</b> with <b>'.$o_names[16].'</b></td><td>Steal Ore</td></tr>
<tr class="buildings"><td><b>Attack Pets</b></td><td>'.clockit(mission_timer(5)).'</td><td><b>'.$military_units_names[12].'</b> with <b>'.$o_names[12].'</b></td><td>Kill Animals</td></tr>
<tr class="buildings"><td><b>Demolish Defence</b></td><td>'.clockit(mission_timer(6)).'</td><td><b>'.$military_units_names[17].'</b> with <b>'.$o_names[17].'</b></td><td>Destroy Defensive Structure</td></tr>
<tr class="buildings"><td><b>Demolish Science Labs</b></td><td>'.clockit(mission_timer(7)).'</td><td><b>'.$military_units_names[18].'</b> with <b>'.$o_names[18].'</b></td><td>Destroy Science Labs</td></tr>
<tr class="buildings"><td><b>Demolish Buildings</b></td><td>'.clockit(mission_timer(8)).'</td><td><b>'.$military_units_names[19].'</b> with <b>'.$o_names[19].'</b></td><td>Destroy Buildings</td></tr>
<tr class="buildings"><td><b>Production Sabotage</b></td><td>'.clockit(mission_timer(9)).'</td><td><b>'.$military_units_names[11].'</b> with <b>'.$o_names[11].'</b></td><td>Sabotage Factory Production Levels</td></tr>
*/
require_once 'admin/game.footer.php';?>