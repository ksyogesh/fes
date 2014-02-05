<?php




$dbhost="localhost";  #SQL Database Hostname (Most is: localhost)
$dbusername="root";   #SQL Username
$dbpassword="";   #SQL Password
$dbname="feedback"; #SQL Database Name

#for support please email me: m@maaking.com


// Don't touch here anything.
// Connect to Mysql
$connect = mysql_connect($dbhost, $dbusername, $dbpassword);
//Select the correct database.
$db = mysql_select_db($dbname,$connect) or die ("Could not select database");
?> 


