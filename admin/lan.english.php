<?php
#!/usr/local/bin/php
$a_names=array(
'Wood','Stone','Water','Food','Coal Ore',
'Iron Ore','Gold Ore','Metal','Weapons','Gold'
);

$b_names=array(
'Woodcutter','Quarry','Well','Farm','Coal Mine',
'Iron Mine','Gold Mine','Iron Smith','Weapon Smith','Gold Smith'
);

$b_namesx=array(
'Warehouse'=>'Increase storage of '.$a_names[0].' & '.$a_names[1],
'Watertower'=>'Increase storage of '.$a_names[2],
'Granary'=>'Increase storage of '.$a_names[3],
'Ore Silo'=>'Increase storage of '.$a_names[4].', '.$a_names[5].' & '.$a_names[6],
'Metal Depot'=>'Increase storage of '.$a_names[7],
'Armoury'=>'Ability to arm your military and increase storage of '.$a_names[8],
'Bank'=>'Receive interest on your gold and increase storage of '.$a_names[9],
'Construction Site'=>'Increase simultaneous construction sites',
'Research Lab'=>'Decrease construction cost,enables research slots and speed up research',
'Transport Control Center'=>'Enables you to send merchants and decreases construction time',
);
$b_namesxa=array_keys($b_namesx);

$r_names=array(
'','','',$a_names[2],$a_names[3],
$a_names[3],$a_names[3],$a_names[4].' & '.$a_names[5],$a_names[7],$a_names[4].' & '.$a_names[6]
);

$c_names=array(
'Saw','Explosives','Putting','Fertilizer','Coal Mining',
'Iron Mining','Gold Mining','Tools','Forging','Puring',
'Military','Offence Pets','Defense Structures','War Tactics','Self Preservation',
'Warfare Logistics','War Command Center','Military Training','Researching','Architecture',
);
$c_namesx=array(
'Discover new military units',
'Discover new offensive pets',
'Discover new defensive structures',
'Discover new war missions',
'Decrease military consumption',
'Faster troops movements',
'Increase attack slots',
'Faster military training',
'Faster research',
'Faster buildings',
);

$txt_buildings=array(
'Buildings','Level','Production','Production Requirements','Upgrade Requirements',//4
'None','Construction Time','Time Left','Upgrade','Insufficient resources',//9
'Storage Capacity','Insufficient Construction Slots','Production Failure Capacity Overload','Production Failure Insufficient Resources','Production Failure Building Needs Repaired',//14
'Max Merchants Cargo','Max Construction Sites','Military Training Facilities','Interest','Decrease Construction Cost',//19
'Cancel','Decreases Construction Time','Decreases Research Time','Construction Sites','Science Slots',//24
);

$txt_productionman=array(
'Production Manager','Resource','Capacity','Have','Produced',
'Reports','Total produced','STORAGE FULL','CAPACITY OVERLOAD','RESOURCES SHORTAGE',//9
'Decay/Stolen','Gold Interest','Military Desertion','aaa','Used',//14
'Results','aaa','aaa','aaa','aaa',
);



$txt_files=array(
'Overview','Buildings','Resources','Merchant','Trade',
'Science','Military','Offence','Defence','War',
'Messages','Options','Logout','Help',
);
//'Forums',

$txt_menu=array(
'Update','Ready Continue',
);

$txt_messages=array(
'aaa','message','messages','Messaging Service','Create Message',//4
'inbox','outbox','deleted','Delete all messages','empty',//9
'reply','forward','delete','Message Deleted','Your inbox is empty',//14
'Your outbox is empty','Permanent Delete','ago','Permanent Deleted Message','Your have no messages here',//19
'Find player','Use at least two characters to find a player','No players found containing your search term','Create a new message','Recipient',//24
'Message','Characters left','Send message','Signed by','Postman has just left the building,please wait a few seconds before sending a message',//29
'Your message is too long','Your message has been handed over to the postman,it will take a few seconds to deliver','Create a reply message','Send reply','Replied by',//34
'production','Replying on this message','Forwarding','Add comments','Forwarded by',//39
'Forwarding this message','create','aaa','aaa','aaa',//44
'war','merchants','costs','aaa','aaa',//49
'aaa','aaa','aaa','aaa','aaa',//54
);

$txt_merchant=array(
'Require '.$b_namesxa[9].' building','Merchants','Max Cargo Per Merchant','Travel Time','Incoming Cargo',//4
'Send','Charname','Send Resources','Send to','Cargo Space',//9
'Outgoing Cargo','Callback','Signed by,','max','Your Merchants',//14
'Merchant Callback','Trade','Offering','Searching','Buy',//19
'Offer','Player Name','Time','Actions','aaa',//24
'Cancel','Dispatch Merchant','No resource','No Merchants Available','Cargo is too much for you',//29
'Cargo is too much for','Cargo Too Large','to','from','has no merchants available',//34
'Trade Callback','Next Page','aaa','aaa','aaa',
);

$txt_science=array(
'Require '.$b_namesxa[8].' building','Science','Production Effect','Research Time','Time Left',//4
'Research','Cancel','Not Enought Resources','Insufficient Research Slots','Requirements',//9
'Level','aaa','aaa','aaa','aaa',//14
'aaa','aaa','aaa','aaa','aaa',//19
'aaa','aaa','aaa','aaa','aaa',//24
'aaa','aaa','aaa','aaa','aaa',//29
);

$military_units_names=array(
'Scout','Foot Soldier','Swords Man','Mace Man','Lance Man',
'Bow Man','Horse Man','Assasin','Barbarian','Monk',
'Wizard','Ninja','Dino Rider','Battlemage','Druids',
'Shoguns Priest','Beast Unit','Catapult Unit','Cannon Unit','War General',
);


$offence_units_names=array(
'Dog Hut','Horse Stable','Camel Stable','Elephant Jungle','Tiger Cell',
'Monkey Tree','Mouse Cave','Snake Den','Wasp Keeper','Bull Fields',
'Crocodile Dundee','Eagle Rock','Spider Cave','Wolf Pack','Unicorn Paradise',
'Hydra Vulcano','Mamoth Ysomite','Griffin Desert','Dyno Meadows','Dragon Mountains',
);

$o_names=array(
'Dogs','Horses','Camels','Elephants','Tigers',
'Monkeys','Mouses','Snakes','Wasps','Bulls',
'Crocodiles','Eagles','Spiders','Wolfs','Unicorns',
'Hydras','Mamoths','Griffins','Dynos','Dragons',
);

$defence_units_names=array(
'Wooden Wall','Stone Wall','Metal Wall','Wooden Baricades','Stone Baricades',
'Metal Baricades','Wooden Turret','Stone Turret','Metal Turret','Arrow Tower',
'Stone Catapult','Metal Shards Catapult','Watchtower','Battletower','Castle',
'Piramide','Shaolin Temple','Shogons Den','Metal Castle','Golden Piramide',
);

$missions=array(
'Spy Report','Attack','Reinforcements','Intercept',
);
//'Plunder Food','Burn Food','Plunder Ore','Attack Pets','Demolish Defence','Demolish Science Labs','Demolish Buildings','Production Sabotage',

$txt_game = array(
'Construction Sites','Science Research','Total Offence Power','Total Defense Power','Military Consumption',//4
'Forces Movement','versus','Finished in','Military Power','Newbie Protection',//9
);
//'.$txt_game[0].'
//$txt_game[0]

function welcome_note ($row) {
	global $admin_name,$noob_time;
return 'Welcome '.$row->sex.' '.$row->charname.',<br>
	<br>
	We welcome you!<br>
	<br>
	To start of quickly please read help or visit the forums for help or questions.<br>
	<br>
	You are placed in newbie protection for '.($noob_time/3600).' hours.<br>
	<br>
	Please behave yourself in the game like in real life or get jailed.<br>
	<br>
	Thank you for your time,<br>
	'.$admin_name;
}

/*
TEMPLATE
$txt_game = array(
'aaa','aaa','aaa','aaa','aaa',//4
'aaa','aaa','aaa','aaa','aaa',//9
'aaa','aaa','aaa','aaa','aaa',//14
'aaa','aaa','aaa','aaa','aaa',//19
'aaa','aaa','aaa','aaa','aaa',//24
'aaa','aaa','aaa','aaa','aaa',//29
'aaa','aaa','aaa','aaa','aaa',//34
'aaa','aaa','aaa','aaa','aaa',//49
'aaa','aaa','aaa','aaa','aaa',//44
'aaa','aaa','aaa','aaa','aaa',//49
);
//'.$txt_game[0].'
//$txt_game[0]
*/
?>