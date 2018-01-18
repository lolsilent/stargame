<?php
#!/usr/local/bin/php
$current_time = time();
$current_date = date('d M Y');
$gid = 100;

$uptime = 100;
$xxt=1;
$zzt=1;
$xxs=1;

$refresh_timer=$uptime;
$noob_time = 1000*3600;
$mac = 10;
$goldinterest=2.5;
$max_trade_timer=10000;

$title = 'Dragon Origin : Online text based game';
$admin_name = 'Admin SilenT';

$emergency=array();

$cost_buildings = array(
	//(cost a0, cost a1, production, production pow, cost pow)
0 => array (100,50,15,1.14,1.2),
1 => array (50,100,10,1.12,1.2),
2 => array (25,50,15,1.16,1.2),
3 => array (250,75,25,1.14,1.3),
4 => array (500,250,4,1.13,1.3),
5 => array (500,250,4,1.11,1.3),
6 => array (750,500,2,1.10,1.3),
7 => array (5000,2500,3,1.10,1.3),
8 => array (5000,2500,2,1.10,1.3),
9 => array (7500,5000,1,1.10,1.3),

10 => array (175,75,0,0,1.5),
11 => array (100,25,0,0,1.3),
12 => array (250,50,0,0,1.45),
13 => array (250,100,0,0,1.5),
14 => array (100,250,0,0,1.5),
15 => array (1000,750,0,0,1.5),
16 => array (500,25000,0,0,1.6),
17 => array (5000,5000,0,0,1.7),
18 => array (5000,5000,0,0,1.8),
19 => array (5000,15000,0,0,1.9),
);

$cost_science = array(
	//(cost a0 - cost a9, cost pow)
0 => array (100,1.55),
1 => array (300,1.55),
2 => array (50,1.55),
3 => array (200,1.55),
4 => array (400,1.55),
5 => array (500,1.55),
6 => array (600,1.55),
7 => array (700,1.55),
8 => array (800,1.55),
9 => array (1000,1.55),

10 => array (1500,1.55),
11 => array (1500,1.55),
12 => array (1500,1.55),
13 => array (1500,1.55),
14 => array (2000,1.55),
15 => array (2000,1.55),
16 => array (2000,1.55),
17 => array (2500,1.55),
18 => array (2500,1.55),
19 => array (2500,1.55),

);

$military_units = array(
		//name cost water, cost food, cost weapons, cost gold, timer, pow
0 => array(3,1,1,1,2.5),
1 => array(5,2,2,3,1.5),
2 => array(10,5,5,10,1.2),
3 => array(10,10,10,5,1.1),
4 => array(15,15,10,10,1.1),
5 => array(15,5,15,15,1.1),
6 => array(25,25,25,25,1.1),
7 => array(5,1,35,35,1.1),
8 => array(5,1,50,50,1.1),
9 => array(50,50,35,35,1.1),

10 => array(5,5,50,100,1.1),
11 => array(15,5,100,50,1.1),
12 => array(15,15,200,200,1.1),
13 => array(25,5,200,50,1.1),
14 => array(5,25,50,200,1.1),
15 => array(50,50,500,500,1.1),
16 => array(150,150,1500,1500,1.1),
17 => array(250,250,2500,2500,1.1),
18 => array(500,500,5000,5000,1.1),
19 => array(1000,1000,10000,10000,1.1),
);

$offence_units = array(
		//name cost wood, cost stone, cost metal, cost gold, timer, pow
0 => array(15,1,0,0,1.1),
1 => array(25,5,0,0,1.2),
2 => array(55,5,5,0,1.3),
3 => array(55,5,5,0,1.1),
4 => array(5,15,55,0,1.1),
5 => array(55,5,15,1,1.1),
6 => array(55,5,5,5,1.1),
7 => array(5,55,5,5,1.1),
8 => array(5,5,55,5,1.1),
9 => array(100,10,10,3,1.1),

10 => array(10,100,10,3,1.1),
11 => array(10,10,100,3,1.1),
12 => array(100,100,10,3,1.1),
13 => array(1000,1000,1000,50,1.1),
14 => array(2000,2000,2000,150,1.1),
15 => array(2500,2500,2500,250,1.1),
16 => array(5000,5000,5000,550,1.1),
17 => array(7500,7500,7500,750,1.1),
18 => array(10000,10000,50000,1000,1.1),
19 => array(50000,50000,50000,50000,1.1),
);

$defence_units = array(
		//name cost wood, cost stone, cost metal, cost gold, timer, pow
0 => array(5,1,0,0,1.1),
1 => array(1,5,0,0,1.2),
2 => array(1,1,5,0,1.3),
3 => array(15,5,5,0,1.1),
4 => array(5,15,5,0,1.1),
5 => array(5,5,15,1,1.1),
6 => array(55,5,5,5,1.1),
7 => array(5,55,5,5,1.1),
8 => array(5,5,55,5,1.1),
9 => array(100,10,10,3,1.1),

10 => array(10,100,10,3,1.1),
11 => array(10,10,100,3,1.1),
12 => array(100,100,10,3,1.1),
13 => array(1000,1000,1000,50,1.1),
14 => array(2000,2000,2000,150,1.1),
15 => array(2500,2500,2500,250,1.1),
16 => array(5000,5000,5000,550,1.1),
17 => array(7500,7500,7500,750,1.1),
18 => array(10000,10000,50000,1000,1.1),
19 => array(50000,50000,50000,50000,1.1),
);

$mission_timer=array(
30,1800,300,300,
);

require_once 'lan.english.php';

$files=array(
'game.php','buildings.php','resources.php','merchant.php','trade.php',
'science.php','military.php','offence.php','defence.php','war.php',
'messages.php','options.php','logout.php','help.php',
);
//'https://thesilent.com/forums/forum.php?fid=82',

/*
$googleq = array();

foreach ($c_names as $key=>$val) {$googleq["c".$key]=preg_replace('@ @',"+",$val);}
foreach ($military_units_names as $key=>$val) {$googleq["m".$key]=preg_replace('@ @',"+",$val);}
foreach ($offence_units_names as $key=>$val) {$googleq["d".$key]=preg_replace('@ @',"+",$val);}
foreach ($defence_units_names as $key=>$val) {$googleq["e".$key]=preg_replace('@ @',"+",$val);}
*/

//resources a0-9
//resource production control a10-19
//buildings b0-9 timer = f0-9
//buildings special b10-19 timer = f10-19

//research c0-9 timer = g0-9
//research special c10-19 timer = g10-19

//offence d0-19 timer = h0-19
//defence e0-19 timer = i0-19
//military k0-19 timer = l0-19

//j2 noob timer 5 days
//j3 max attacks
//j4 military morale

//j = option

//j0 == cost message
//j1 == auto delete seen messages
//j5 == auto delete seen messages
//j6 == background
//j7 = background on off

//j8 == float
//j9 receive production reports
//j10 external small images on
//j11 original or google
?>