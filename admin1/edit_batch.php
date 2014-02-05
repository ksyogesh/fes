<?php 
	  //////////////////////////////////////////////////////////////////*****/////////////////////////////////////////////////////////////////////////////////////
  //                                                             Feedback Pro v1																			 //
  //														Faculty Evaluation System																		 //
  //														Developed By Shrenik Patel																		 //			
  //															 July 27, 2009																				 //
  //																																						 //		
  //  Tis program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by 				 //
  //  the Free Software  Foundation; either version 2 of the License, or (at your option) any later version.												 //
  //																																						 //
  //  This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or      //
  //  FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.																 //
  //																																						 //
  //////////////////////////////////////////////////////////////////*****//////////////////////////////////////////////////////////////////////////////////////
	  include('session_chk.php');
	  include("includes/config_db.php");
?> 	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<title>Edit Batch</title>
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">

<?php include('admin_panel_heading.php'); ?>

<tr>
<td width="22%" valign="top">
<?php include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top">
<?php
if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      $title = $_POST['batch_name'];
     
              //check if (title) field is empty then print error message.
              if(!$title){  //this means If the title is really empty.
                     echo "Error: Add Batch Name. Please fill it.";
					 echo '<br/><input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" />';
                     exit(); //exit the script and don't do anything else.
              }// end of if
    //check duplication
	$dup="select * from batch_master where batch_name='".$title."' and batch_id!=".$_POST['batch_id'];
	$dup_res=mysql_query($dup) or die(mysql_error());
	if(mysql_num_rows($dup_res)==1)
	{
		echo "Batch name is already available in database.";
		echo "<br/><input type=\"button\" name=\"Back\" value=\"Back\"  onclick=\"javascript: history.go(-1)\" />";
		//header("Location:add_branch.php");
		//exit;
	}
	else
	{
     
	    $batch_id = $_POST['batch_id'];
		$title = $_POST['batch_name'];
		$feedback_no=$_POST['feedback_no'];	  
		$result = mysql_query("UPDATE batch_master SET batch_name='$title' ,feedback_no='$feedback_no' WHERE batch_id='$batch_id'");
		
		echo "<b>Batch updated Successfully!</b><br>You'll be redirected after (1) Seconds";
        echo "<meta http-equiv=Refresh content=1;url=batch.php>";
		
	}
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else
   $batch_id = $_GET['batch_id'];
    $result = mysql_query("SELECT * FROM batch_master WHERE batch_id='$batch_id' ");
        while($myrow = mysql_fetch_assoc($result))
             {
                $title = $myrow["batch_name"];

      ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="edit_batch" onsubmit="return chkForm();">
<input type="hidden" name="batch_id" value="<? echo $myrow['batch_id']?>">
<table width="283" border="0" cellpadding="3" cellspacing="1">
<tr><td colspan="2" align="center" style="font-size:20px">Update Batch</td></tr>
  <tr>
    <td width="92">Batch Name:</td>
    <td width="163"><label>
      <input type="text" name="batch_name" value="<?php echo $title?>" /><!--onkeypress="return isCharOnly(event);"-->
    </label></td>
  </tr>
  <tr>
    <td>Feedback No: </td>
    <td><label>
	<?
	if($myrow['feedback_no']==1)
	{	$one='selected="selected"';$two='';}
	elseif($myrow['feedback_no']==2)
	{	$two='selected="selected"';$one='';}
	else
	{	$one='';$two='';}
	?>
      <select name="feedback_no">
	  <option value="" ></option>
	  <option value="1" <?php echo $one?>>1</option>
	  <option value="2" <?php echo $two?>>2</option>
      </select>
    </label></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><table border="0" width="100%">
	<tr><td> <input type="submit" class="button" name="submit" value="Update"></td><td align="right"><input class="button" type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" /></td></tr></table>    </td>
  </tr>
</table>
</form>
    
 <?
 	}//end of while loop
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
function chkForm(form)
{

		var RefForm = document.edit_batch;
		if (RefForm.batch_name.value.length < 1 )
		{
			alert("Enter Batch Name");	
			RefForm.batch_name.focus();				
			return false;
		}
		if (RefForm.feedback_no.value.length < 1 )
		{
			alert("Enter feedback Number");	
			RefForm.feedback_no.focus();				
			return false;
		}
}
</script>