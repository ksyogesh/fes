<?php 

include('session_chk.php');
include("includes/config_db.php");
?> 	
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="includes/style.css" />
<title>Add Faculty</title>
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" valign="top">
<? include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top" >
<?
if(isset($_POST['submit']))
  {//begin of if($submit).
      // Set global variables to easier names
      $f_name = $_POST['f_name'];
	  $l_name = $_POST['l_name'];
	  $b_id = $_POST['b_name'];
     
            
    //check duplication
	$dup="select * from faculty_master  where f_name='".$f_name."' and l_name='".$l_name."'";
	$dup_res=mysql_query($dup) or die(mysql_error());
	if(mysql_num_rows($dup_res)==1)
	{
		echo "Faculty name is already available in database.";
		//header("Location:add_branch.php");
		//exit;
	}
	else
	{
     
	     //run the query which adds the data gathered from the form into the database
         $result = mysql_query("INSERT INTO faculty_master (f_name,l_name,b_id) VALUES ('$f_name','$l_name','$b_id')");
          //print success message.
          echo "<b>Faculty is added Successfully!</b><br>You'll be redirected after (1) Seconds";
          echo "<meta http-equiv=Refresh content=1;url=faculty.php>";
         // echo "<!--<meta http-equiv=Refresh content=4;url=index.php>-->";
	}
  }//end of if($submit).


  // If the form has not been submitted, display it!
else
  {//begin of else

      ?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" name="add_fac" onsubmit="return chkForm();">
<table width="283" border="0" cellpadding="3" cellspacing="1">
<tr><td colspan="2" align="center" style="font-size:20px">Add Faculty</td></tr>
  <tr>
    <td width="92"><div align="left">First Name</div></td>
    <td width="163"><label>
      
        <div align="left">
          <input type="text" name="f_name" onkeypress="return isCharOnly(event);"/>
        </div>
    </label></td>
  </tr>
  <tr>
    <td width="92"><div align="left">Last Name</div></td>
    <td width="163"><label>
      
        <div align="left">
          <input type="text" name="l_name" onkeypress="return isCharOnly(event);"/>
        </div>
    </label></td>
  </tr>
  <tr>
    <td width="92"><div align="left">Branch Name</div></td>
    <td width="163">
	  
	    <div align="left">
	      <?
	 $sel_b="select * from branch_master";
	$res=mysql_query($sel_b) or die(mysql_error());
	
	 while($b_combo=mysql_fetch_array($res))
	 {							
		$branch_combo[] = array('id' => $b_combo['b_id'],
							   'text' => $b_combo['b_name']);								  
	 }
	 $default = 1;
	 echo tep_draw_pull_down_menu('b_name',$branch_combo,$default);
	?>      
	      </div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="left">
      <table border="0" width="100%">
        <tr><td> <input type="submit" class="button" name="submit" value="Add"></td><td align="right"><input type="button" name="Back" value="Back"  onclick="javascript: history.go(-1)" class="button" /></td></tr>
      </table>
    </div></td>
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

function chkForm(form)
{

		var RefForm = document.add_fac;
		if (RefForm.f_name.value.length < 1 )
		{
			alert("Enter First Name");	
			RefForm.f_name.focus();		
			return false;
		}
		if (RefForm.l_name.value.length < 1 )
		{
			alert("Enter Last Name");			
			RefForm.l_name.focus();
			return false;
		}
		
		if (RefForm.b_name.value == 0 )
		{
			alert("Select Branch Name");			
			return false;
		}
}
</script>