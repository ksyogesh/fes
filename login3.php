<?php 
include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="500" border="0" align="center">

<form method="post" action="checklogin3.php" name="stud_login" onsubmit="return chkForm();">
<input type="hidden" name="para_id" value="<? echo $para_id?>">
<table width="65%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" align="center"><font size="5" ><strong>Faculty Evaluation System </strong></font></td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td colspan="3" align="center"><font size="3" ><strong>Student Login </strong></font></td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td width="205" ><div align="right">USN</div></td>
<td width="3"><div align="center">:</div></td>
<td width="268">
  <div align="left">
    <input name="myusername" type="text" tabindex="1" align="left"/>
  </div></td>
</tr>
<tr>
<td><div align="right">Password</div></td>
<td><div align="center">:</div></td>
<td>
  <div align="left">
    <input name="mypassword" type="password" tabindex="2" id="mypassword">
  </div></td>
</tr
<tr>
<td><div align="right"></div></td>
<td><div align="center"></div></td>
<td>
  <div align="left">
    <input type="submit" name="submit" value="Login" class="button">
  </div></td>
</tr>
</table>
</form>

</td>
</tr>
<tr><td colspan="3" align="center"><?php include("footer.php"); ?></td></tr>
</table>
</body>
</html>
<script language="javascript" type="text/javascript">

function chkForm(form)
{
		var RefForm = document.stud_login;
		
		if (RefForm.myusername.value.length == 0 )
		{
			alert("Enter USN.");	
			RefForm.usn_no.focus();				
			return false;
		}
		if (RefForm.myusername.value.length != 10 )
		{
			alert("Enter USN correctly.");	
			RefForm.usn_no.focus();				
			return false;
		}
		
}
</script>
