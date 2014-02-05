<?php 
	  
	  include('session_chk.php');
	  include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Branch</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" bgcolor="#FFFFFF">
<? include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top" bgcolor="#FFFFFF">
<p>
  <table width="480px"><tr><td><div align="right"><a href='add_branch.php' class="button" >Add</a></div></td></tr></table>
</p>
<table width="100%" id="rounded-corner" border="0" align="center" cellpadding="0" cellspacing="0" >
<thead>
<tr>
	<th align="center" scope="col" class="rounded-company">Branch Id</th>
	<th align="center" scope="col" class="rounded-q1">Branch Name</th>
	<th align="center" scope="col" class="rounded-q4">Edit / Delete</th>
</tr>
</thead>

<?php

//LAST UPDATE
// 27-09-2007


// load the configuration file.

        //load all news from the database and then OREDER them by newsid
        //you will notice that newlly added news will appeare first.
        //also you can OREDER by (dtime) instaed of (news id)
        $result = mysql_query("SELECT * FROM branch_master ORDER BY b_id");
        //lets make a loop and get all news from the database
		$i=1;
		if(mysql_num_rows($result)>0)
		{
			 while($myrow = mysql_fetch_array($result))
			 {//begin of loop
			   //now print the results:
			   echo '<tr>';
			   echo "<td align=center>".$i."</td>";$i++;
			   echo "<td align=center>".$myrow['b_name']."</td>";
			   echo "<td align=center>"."<a href=\"edit_branch.php?b_id=$myrow[b_id]\">edit</a> /"."<a href=\"delete_branch.php?b_id=$myrow[b_id]\">delete</a>"."</td>";
			  echo '</tr>';  
			  
			  //echo "<br><a href=\"read_more.php?newsid=$myrow[newsid]\">Read More...</a>
			  //  || <a href=\"edit_news.php?newsid=$myrow[newsid]\">Edit</a>
			  //   || <a href=\"delete_news.php?newsid=$myrow[newsid]\">Delete</a><br><hr>";
			 }//end of loop
		}
		else
		{
			echo '<tr><td colspan=3 align=center>No record found!</td></tr>';
		}
?>
</table>
</td>
</tr>
</table>
</body>
</html>
