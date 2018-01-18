<?php
#!/usr/local/bin/php
require_once 'admin/www.main.php';
require_once 'admin/www.mysql.php';
require_once 'admin/www.functions.php';

validate_referer();

if (isset($_GET['xtimer'])) {
include_once 'admin/script.xtimer.php';
}

if (isset($_GET['resourcer'])) {
include_once 'admin/script.resourcer.php';
}

if (isset($_GET['resourcev'])) {
include_once 'admin/script.resourcev.php';
}

if (isset($_GET['trade'])) {
include_once 'admin/script.trade.php';
}

if (isset($_GET['war'])) {
include_once 'admin/script.war.php';
}

if (isset($_GET['ac'])) {
include_once 'admin/script.ac.php';
}

if (isset($_GET['float'])) {
include_once 'admin/script.float.php';
}

if (isset($_GET['css'])) {
require_once 'admin/script.css.php';
}

if (isset($_GET['css1'])) {
require_once 'admin/script.css1.php';
}

if (isset($_GET['validate'])) {
include_once 'admin/script.validate.php';
}

?>