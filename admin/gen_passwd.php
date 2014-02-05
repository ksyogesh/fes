<?php
/*
 * Gen_passwd.php
 * 
 * Copyright 2012 CSLabs, GEC Hassan <cse.gechassan@gmail.com>
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
include('session_chk.php');
include("includes/config_db.php");
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Generate Password</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
</head>
<link rel="stylesheet" type="text/css" href="../includes/style.css" />

<body onload="setFocus()">
	
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1" >
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%">
<? include('left_side.php');?></td>

<td width="78%" valign="top">
<p><br/>

<td width="78%" align="center" valign="top" bgcolor="#FFFFFF">
<?php
if(isset($_POST['submit']))
  {
	  
      
       $usn = $_POST['username'];
      $passwd = generatePassword();
     
    //check duplication
	$dup="select * from members where username='".$usn."'";
	$dup_res=mysql_query($dup) or die(mysql_error());
	if(mysql_num_rows($dup_res)==1)
	{
		echo "Password already available in database.";
		echo "<meta http-equiv=Refresh content=2;url=gen_passwd.php>";
		//header("Location:add_branch.php");
		//exit;
	}
	else
	{
     
	     //run the query which adds the data gathered from the form into the database
         $result = mysql_query("INSERT INTO members (username,password) VALUES ('$usn','$passwd')");
          //print success message.
          //echo "<b>Password is generated Successfully!</b><br>You'll be redirected after (1) Seconds";
          echo "<meta http-equiv=Refresh content=0;url=gen_passwd.php>";
	}
  }//end of if($submit).


?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>"  name="stud_login" onsubmit="return chkForm();">
<table width="283" border="0" cellpadding="3" cellspacing="1">
<tr><td colspan="2" align="center" style="font-size:20px">Generate Password</td></tr>
  <tr>
    <td width="92">Enter USN:</td>
    <td width="163"><label>
      <input type="text" name="username" onKeyUp="javascript:isUSNOnly(stud_login.usn_no);" onfocus="formInUse = true;"/>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table border="0" width="100%">
	<tr><td> <input type="submit" class="button" name="submit" value="Generate Password"></td><td align="right"><input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" class="button" /></td></tr></table>
    </td>
  </tr>
</table>
</form>

<p>&nbsp;</p></td>
</tr>
</table>
	
	
</body>

</html>



<script language="javascript" type="text/javascript">

/*function isUSNOnly()
{
	var usn=/[4][Gg][Hh][0-9][0-9][A-Z][A-Z][0-9][0-9][0-9]$/
	var usname=document.forms[0].text.value;
		if(usname.length==0) alert("Enter USN!");
		else if(!usname.match(usn)){
        alert("Enter USN correctly");
	  	elem1.focus();
	  	return false;
	  	}
	  	return true;

	//}
}
*/
var formInUse = false;

function setFocus()
{
 if(!formInUse) {
  document.stud_login.username.focus();
 }
}

function chkForm(form)
{
		var RefForm = document.stud_login;
		
		if (RefForm.usn_no.value.length == 0 )
		{
			alert("Enter USN.");	
			RefForm.usn_no.focus();				
			return false;
		}
		if (RefForm.usn_no.value.length != 10 )
		{
			alert("Enter USN correctly.");	
			RefForm.usn_no.focus();				
			return false;
		}
		
		var usn=/[4][Gg][Hh][0-9][0-9][A-Z][A-Z][0-9][0-9][0-9]$/
	    var usname=document.forms[0].text.value;
		if(usname.length==0) alert("Enter USN!");
		else if(!usname.match(usn)){
        alert("Enter USN correctly");
	  	elem1.focus();
	  	return false;
	  	}
		
}
</script>
