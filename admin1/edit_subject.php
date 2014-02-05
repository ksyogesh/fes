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
<title>Edit Subject</title>
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
<?php
if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      
    //check duplication
	$dup="select * from  subject_master where sub_name='".$_POST['sub_name']."' and sem_id!=".$_POST['sem_name']." and f_id=".$_POST['f_id'];
	//echo $dup;
	//exit;
	$dup_res=mysql_query($dup) or die(mysql_error());
	if(mysql_num_rows($dup_res)==1)
	{
		echo "Subject name is already available in database.";
		echo "<br/><input type=\"button\" name=\"Back\" value=\"Back\"  onclick=\"javascript: history.go(-1)\" />";
		//header("Location:add_branch.php");
		//exit;
	}
	else
	{
     	$sub_id = $_POST['sub_id'];
	    $f_id = $_POST['f_id'];
		$sub_name = $_POST['sub_name'];
		$batch_id =  $_POST['batch_name'];
		
		$result = mysql_query("UPDATE  subject_master  SET sub_name='".$_POST['sub_name']."' , sem_id='".$_POST['sem_name']."' , f_id='".$_POST['f_id']."', batch_id='".$_POST['batch_name']."' WHERE sub_id='$sub_id'");
		
		echo "<b>Subject detail is updated successfully!</b><br>You'll be redirected after (1) Seconds";
          echo "<meta http-equiv=Refresh content=1;url=subject.php?f_id=".$f_id.">";
		
	}
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else
        $sub_id = $_GET['sub_id'];
        //$result = mysql_query("SELECT * FROM  subject_master WHERE sub_id='$sub_id' ");
		
		$sub_result = mysql_query("SELECT * FROM subject_master  where sub_id='".$_GET['sub_id']."'");
		//echo "SELECT * FROM faculty_master  where f_id='".$_POST['f_id']."'";
		
		//print_r($f_myrow);
        while($sub_myrow = mysql_fetch_array($sub_result))
         {
      ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="update_sub" onsubmit="return chkForm();">
<input type="hidden" name="sub_id" value="<? echo $_GET['sub_id']?>">
<table width="283" border="0" cellpadding="3" cellspacing="1">
<tr><td colspan="2" align="center" style="font-size:20px">Update Subject</td></tr>
  <tr>
  <?
	    $f_result = mysql_query("SELECT * FROM faculty_master where f_id='".$sub_myrow['f_id']."'");
		$f_myrow = mysql_fetch_array($f_result);
		//print_r($f_myrow);
?>
	
    <td width="132" colspan="2" align="left"><?php echo $f_myrow['f_name'].'&nbsp;'.$f_myrow['l_name']?>&nbsp;(<?php echo branch_name($f_myrow['b_id'])?>)<input type="hidden" name="f_id" value="<? echo $sub_myrow['f_id']?>"></td>
  </tr>
  
  <tr>
    <td width="92"><div align="left">Subject Name</div></td>
    <td width="163"><label>
      <div align="left">
        <input type="text" name="sub_name" onkeypress="return isCharOnly(event);" value="<?php echo $sub_myrow["sub_name"]?>"/>
        </div>
    </label></td>
  </tr>
  <tr>
    <td width="92"><div align="left">Semester</div></td>
    <td width="163">
	  <div align="left">
	    <?
	 $sel_sem="select * from semester_master ";
	 $res_sem=mysql_query($sel_sem) or die(mysql_error());
	
	 while($sem_combo=mysql_fetch_array($res_sem))
	 {							
		$sem_array[] = array('id' => $sem_combo['sem_id'],
							  'text' => $sem_combo['sem_name']);								  
	 }
	 $default=$sub_myrow['sem_id'];
	 echo tep_draw_pull_down_menu('sem_name',$sem_array, $sub_myrow['sem_id'], $sub_myrow["sem_id"]);
	?>
	    </div></td>
  </tr>
  <tr>
    <td width="92"><div align="left">Batch</div></td>
    <td width="163">
	  <div align="left">
	    <?
	 $sel_batch="select * from batch_master ";
	 $res_batch=mysql_query($sel_batch) or die(mysql_error());
	
	 while($batch_combo=mysql_fetch_array($res_batch))
	 {							
		$batch_array[] = array('id' => $batch_combo['batch_id'],
							  'text' => $batch_combo['batch_name']);								  
	 }
	 $default=$sub_myrow['batch_id'];
	 echo tep_draw_pull_down_menu('batch_name',$batch_array, $default, $sub_myrow["batch_id"]);
	 
	// echo tep_draw_pull_down_menu('batch_name',$batch_array,$sub_myrow["batch_id"]);
	 //echo tep_draw_pull_down_menu('batch_name',$batch_array,$default);
	?>
	    </div></td>
  </tr>
  <tr>
    <td><div align="left"></div></td>
    <td><div align="left">
      <table border="0" width="100%">
        <tr><td> <input type="submit" class="button" name="submit" value="Update"></td><td align="right"><input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" class="button" /></td></tr>
      </table>
    </div></td>
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

		var RefForm = document.update_sub;
		
		if (RefForm.sub_name.value.length < 1 )
		{
			alert("Enter Subject Name");			
			RefForm.sub_name.focus();
			return false;
		}
		
		if (RefForm.sem_name.value == 0 )
		{
			alert("Select Semester");	
			RefForm.sem_name.focus();		
			return false;
		}
		if (RefForm.batch_name.value == 0 )
		{
			alert("Select Batch");	
			RefForm.batch_name.focus();		
			return false;
		}
}
</script>