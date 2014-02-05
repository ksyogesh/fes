<?php 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="../includes/style.css" />
</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="500" border="0" align="center">
<tr>
<td>

<form name="form1" method="post" action="checklogin.php">

<table width="100%" border="0" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" align="center"><font size="5" ><strong>Admin Login </strong></font></td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td width="205" ><div align="right">Username</div></td>
<td width="3"><div align="center">:</div></td>
<td width="268">
  <div align="left">
    <input name="myusername" type="text" id="myusername">
  </div></td>
</tr>
<tr>
<td><div align="right">Password</div></td>
<td><div align="center">:</div></td>
<td>
  <div align="left">
    <input name="mypassword" type="password" id="mypassword">
  </div></td>
</tr>
<tr>
<td><div align="right"></div></td>
<td><div align="center"></div></td>
<td>
  <div align="left">
    <input type="submit" class="button" name="Submit" value="Login">
  </div></td>
</tr>
</table>
</form>

</td>
</tr>
<tr><td><?php include("footer.php")?></td></tr></table>
</body>
</html>
