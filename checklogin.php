<?php
/*
 * checklogin.php
 * 
 * Copyright 2012 CSLabs, GECH <cse.gechassan@gmail.com>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>

<?php
session_start();
include("includes/config_db.php");
 // Define $myusername and $mypassword
$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);

$sql="SELECT * FROM members WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$result1=mysql_query("UPDATE feedback_para SET usn_no='$myusername' WHERE para_id='1'");

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
$_SESSION['myusername'] = $myusername;
$_SESSION['mypassword'] = $mypassword;

//page to load : change this acco. to the semester

header("location:index3.php");
}
else {
?>
<table align="center" width="100%" border="0" cellpadding="0" cellspacing="1">
<tr><td align="center"><br/><br/>
<?
echo "Wrong USN or Password";
echo "<br/><input type=\"button\" name=\"Back\" value=\"Back\"  onclick=\"javascript: history.go(-1)\" />";
?>
</td></tr></table>
<?
}

ob_end_flush();
?>

