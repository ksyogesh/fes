<?php 

include('session_chk.php');
include("includes/config_db.php");
?> 	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<title>Add Batch</title>
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">

<?php include('admin_panel_heading.php'); ?>

<tr>
<td width="22%" valign="top" bgcolor="#FFFFFF">
<? include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top" bgcolor="#FFFFFF">
<?
if(isset($_POST['submit']))
  {
      $title = $_POST['batch_name'];
     
	if(!$title)
	{  
			 echo "Error: Add Batch Name. Please fill it.";
			 echo '<br/><input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" />';
			 exit(); 
	}
    
	$dup="select * from batch_master where batch_name='".$title."'";
	$dup_res=mysql_query($dup) or die(mysql_error());
	if(mysql_num_rows($dup_res)==1)
	{
		echo "Batch name is already available in database.";
		//header("Location:add_branch.php");
		//exit;
	}
	else
	{
     
	     //run the query which adds the data gathered from the form into the database
         $result = mysql_query("INSERT INTO batch_master (batch_name,feedback_no) VALUES ('$title','1')");
          //print success message.
          echo "<b>Batch is added Successfully!</b><br>You'll be redirected after (1) Seconds";
          echo "<meta http-equiv=Refresh content=1;url=batch.php>";
         // echo "<!--<meta http-equiv=Refresh content=4;url=index.php>-->";
	}
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else

      ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<table width="283" border="0" cellpadding="3" cellspacing="1" align="center">
<tr>
<td colspan="2" align="center" style="font-size:20px">Add Batch</td>
</tr>
  <tr>
    <td width="92">Batch Name:</td>
    <td width="163"><label>
      <input type="text" name="batch_name" value=""/><!--onkeypress="return isCharOnly(event);"-->
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table border="0" width="100%">
	<tr><td> <input type="submit" class="button" name="submit" value="Add"></td><td align="right"><input class="button" type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" /></td></tr></table>
    </td>
  </tr>
</table>
</form>

 <?
  }//end of else
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
</script>