<?php 
	 
	  include('session_chk.php');
	  include("includes/config_db.php");
?> 	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Batch</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" valign="top">
<? include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top">
<?
  if(isset($_POST['submit']))
  {//begin of if($submit).
      
	    $passwd = $_POST['passwd'];
		$result = mysql_query("UPDATE members SET password =password('$passwd') WHERE username='admin'");
		
		echo "<b>Password updated Successfully!</b><br>You'll be redirected after (1) Seconds";
        echo "<meta http-equiv=Refresh content=1;url=login_success.php>";
		
  }//end of if($submit).


  // If the form has not been submitted, display it!
  else
  {//begin of else
   

      ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="edit_passwd" onsubmit="return chkForm();">
<table width="300" border="0" cellpadding="3" cellspacing="1">
<tr><td colspan="2" align="center" style="font-size:20px">Update Password</td></tr>  <tr>
    <td width="92">New Password:</td>
    <td width="163"><label>
      <input type="password" name="passwd" value="" /><!--onkeypress="return isCharOnly(event);"-->
    </label></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><table border="0" width="100%">
	<tr><td> <input type="submit" name="submit" value="Update" class="button"></td><td align="right"><input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" class="button" /></td></tr></table>    </td>
  </tr>
</table>
</form>
    
 <?
 	}//end of while loop
 
?>
<p>&nbsp;</p></td>
</tr>
</table>
</body>
</html>
<script language="javascript" type="text/javascript">
function isCharOnly(e)
{
	var unicode=e.charCode? e.charCode : e.keyCode
	//if (unicode!=8 && unicode!=9)
	//{ //if the key isn't the backspace key (which we should allow)
		 //disable key press
		if (unicode==45)
			return true;
		if (unicode>48 && unicode<57) //if not a number
			return false
	//}
}
function chkForm(form)
{

		var RefForm = document.edit_passwd;
		if (RefForm.passwd.value.length < 1 )
		{
			alert("Enter New password");	
			RefForm.passwd.focus();				
			return false;
		}
}
</script>