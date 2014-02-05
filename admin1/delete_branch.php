<?php 

		include('session_chk.php');
	    include("includes/config_db.php");

        $b_id = $_GET['b_id'];
        $result = mysql_query("DELETE FROM branch_master WHERE b_id='$b_id' ");

       
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Delete Branch</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" valign="top" bgcolor="#FFFFFF">
<? include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top">
<table width="100%" border="0" align="center" >
<tr><td></td></tr>
<tr><td colspan="3" align="center" style="font-size:20px"></td></tr>
<tr><td></td></tr>
</table>

<p> <?php echo "<b>Branch Deleted!</b><br>You'll be redirected after (1) Seconds";
          echo "<meta http-equiv=Refresh content=1;url=branch.php>";
			

?></p></td>
</tr>
</table>
</body>
</html>
