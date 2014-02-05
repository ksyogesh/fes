<?php 

	  include('session_chk.php');
	  include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Set Admin Parameter</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<table width="57%" align="center" border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" bgcolor="#FFFFFF">
<? include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top">
<table id="rounded-corner" align="center">
<thead>
<tr>
	<th scope="col" class="rounded-company" align="center">Batch Name </th>
	<th scope="col" class="rounded-q1" align="center">Branch Name</th>
	<th scope="col" class="rounded-q2" align="center">Semester</th>
	<th scope="col" class="rounded-q4" align="center">&nbsp;</th>
</tr>
</thead>

<?php


        $result = mysql_query("SELECT * FROM feedback_para");
        //lets make a loop and get all news from the database
		$i=1;
		if(mysql_num_rows($result)>0)
		{
			while($myrow = mysql_fetch_array($result))
			{
			   //begin of loop
			   //now print the results:
			   echo '<tr>';
			   //echo "<td align=center>".$i."</td>";$i++;
			   echo "<td align=center>".batch_name($myrow['batch_id'])."</td>";
			   echo "<td align=center>".branch_name($myrow['b_id'])."</td>";
			   echo "<td align=center>".sem_name($myrow['sem_id'])."</td>";
			   echo "<td align=center>"."<a href=\"edit_admin_para.php?para_id=$myrow[para_id]\" class=\"button\">edit</a> <!--/"."<a href=\"delete_batch.php?batch_id=$myrow[batch_id]\">delete</a>-->"."</td>";
			   echo '</tr>';  
			  
			  //echo "<br><a href=\"read_more.php?newsid=$myrow[newsid]\">Read More...</a>
			  //  || <a href=\"edit_news.php?newsid=$myrow[newsid]\">Edit</a>
			  //   || <a href=\"delete_news.php?newsid=$myrow[newsid]\">Delete</a><br><hr>";
			}//end of loop
		}
		else
		{
			echo '<tr><td colspan=4 align=center>No record found!</td></tr>';
		}
?>
</table>
</td>
</tr>
</table>
</body>
</html>
