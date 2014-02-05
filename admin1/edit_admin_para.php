<?php 

	  include('session_chk.php');
	  include("includes/config_db.php");
?> 	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Edit Admin Parameter</title>
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
      // Set global variables to easier names
     $para_id = $_POST['para_id'];
     
    /*//check duplication
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
	{*/
     
	    $batch_id = $_POST['batch_name'];
		$b_id = $_POST['b_name'];
		$sem_id=$_POST['sem_name'];	  
		$result = mysql_query("UPDATE feedback_para SET batch_id='$batch_id' ,b_id='$b_id',sem_id='$sem_id' WHERE para_id='$para_id'");
		
		echo "<b>Parameters updated Successfully!</b><br>You'll be redirected after (1) Seconds";
        echo "<meta http-equiv=Refresh content=1;url=admin_para.php>";
		
	/*}*/
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else
   $para_id = $_GET['para_id'];
    $result = mysql_query("SELECT * FROM feedback_para WHERE para_id='$para_id' ");
        while($myrow = mysql_fetch_assoc($result))
             {
                //$title = $myrow["b_id"];

      ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="edit_admin_para" onsubmit="return chkForm();">
<input type="hidden" name="para_id" value="<? echo $para_id?>">
<table width="283" border="0" cellpadding="3" cellspacing="1">
<tr><td colspan="2" align="center" style="font-size:20px">Update Admin Parameters</td></tr>
  <tr>
    <td width="92">Batch Name:</td>
    <td width="163"><label>
      <?
			$sel_batch="select * from batch_master";
			$res_batch=mysql_query($sel_batch) or die(mysql_error());
			
			 while($batch_combo=mysql_fetch_array($res_batch))
			 {							
				$bat_combo[] = array('id' => $batch_combo['batch_id'],
									   'text' => $batch_combo['batch_name']);								  
			 }
			 if($myrow["batch_id"]!=NULL)
			 {
			 	$default=$myrow["batch_id"];
			 }
			 else
			 {$default='';}
			 
			 echo tep_draw_pull_down_menu('batch_name',$bat_combo,$default,' tabindex="2" ');
			?><!--onkeypress="return isCharOnly(event);"-->
    </label></td>
  </tr>
  <tr>
    <td>Branch: </td>
    <td>
	<?
	 $sel_b="select * from branch_master";
	 $res=mysql_query($sel_b) or die(mysql_error());
	
	 while($b_combo=mysql_fetch_array($res))
	 {							
		$branch_combo[] = array('id' => $b_combo['b_id'],
							   'text' => $b_combo['b_name']);								  
	 }
	 if($myrow["b_id"]!=NULL)
	 {
		$default=$myrow["b_id"];
	 }
	 else
	 {$default='';}
	 echo tep_draw_pull_down_menu('b_name',$branch_combo,$default);
	?></td>
  </tr>
  <tr>
  <td>Semester</td>
  <td>
  <?
	 $sel_sem="select * from semester_master";
	 $res_sem=mysql_query($sel_sem) or die(mysql_error());
	
	 while($sem_combo=mysql_fetch_array($res_sem))
	 {							
		$semester_combo[] = array('id' => $sem_combo['sem_id'],
							   'text' => $sem_combo['sem_name']);								  
	 }
	 if($myrow["sem_id"]!=NULL)
	 {
		$default=$myrow["sem_id"];
	 }
	 else
	 {$default='';}
	 echo tep_draw_pull_down_menu('sem_name',$semester_combo,$default);
	?>
  </td>
  </tr>
  <tr><td colspan="2">&nbsp;</td></tr>
  <tr>
    <td><div align="right">
      <input type="submit" name="submit" value="Update" class="button">
    </div></td><td align="right"><div align="left">
      <input type="button" name="Back" value="Back" class="button"  onclick="javascript: history.go(-1)" />    
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

		var RefForm = document.edit_admin_para;
		if (RefForm.batch_name.value == 0 )
		{
			alert("Enter Batch Name");	
			RefForm.batch_name.focus();				
			return false;
		}
		if (RefForm.b_name.value == 0 )
		{
			alert("Enter Branch Name");	
			RefForm.b_name.focus();				
			return false;
		}
		if (RefForm.sem_name.value == 0 )
		{
			alert("Enter semester Name");	
			RefForm.sem_name.focus();				
			return false;
		}
}
</script>