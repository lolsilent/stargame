<?php
#!/usr/local/bin/php
require_once'admin/www.main.php';
require_once'admin/www.mysql.php';
require_once'admin/www.functions.php';

validate_referer();
?>
body, td, th, textarea,select,input {
font-family:Tahoma,Verdana,Arial;
font-size:12px;
}

body {
background-image: url("images/bg88.jpg"); 
background-repeat: no-repeat;
background-attachment:fixed;
background-position: center center;
background-color:#000000;
color:#FFFFFF;
margin:0px;
border:none;
}

form {
margin:0px;
border:none;
}

td,th{
align:center;
border:1px #456789 solid;
}

tr.buildings {
background-color:#123456;
padding-left:3px;
padding-right:3px;
}


th {
background-color:#123456;
text-align:center;
padding-left:3px;
padding-right:3px;
}

input, select, submit, textarea {
margin:0px;
border:1px red solid;
border-width:1px;
font-size:8pt;
background-color:#123456;
color:#FFFFFF;
overflow: auto;
}

input, select, submit {
text-align:center;
width:100%;
}

a {
color:#FFFFFF;
font-weight:bold;
padding-left:3px;
padding-right:3px;
text-decoration:none;
}

a:hover {
color:#00FF00;
text-decoration:underline;
}

td {
padding:3;
spacing:3;
}

table.topmenu {
font-family:Tahoma,Verdana,Arial;
color:#EEEEEE;
text-align:right;
position:absolute;
position:absolute;
right:10px;
top:10px
}

h1{
margin:0px;
border:none;
}