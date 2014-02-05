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
<title>Faculty's Subject</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />
</head>

<body>
<table width="57%" align="center"  border="0" cellpadding="0" cellspacing="1">
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%" >
<? include('left_side.php');?>
</td>

<td width="78%" align="center" valign="top" >
<table align="center" width="100%"><tr><td colspan="3" >
<?
	    $f_result = mysql_query("SELECT * FROM faculty_master  where f_id='".$_GET['f_id']."'");
		//echo "SELECT * FROM faculty_master  where f_id='".$_POST['f_id']."'";
		$f_myrow = mysql_fetch_array($f_result);
		//print_r($f_myrow);
?>
<tr>
	
	<td align="center"><?php echo $f_myrow['f_name'].'&nbsp;'.$f_myrow['l_name']?>&nbsp;(<?php echo branch_name($f_myrow['b_id'])?>)
	</td>

</table>

<table width="480px">
<tr >
<td align="left" ><a  href="faculty.php" class="button" >Back</a></td>
<td align="right"><a href='add_subject.php?f_id=<?php echo $_GET['f_id']?>' class="button">Add Subject</a></td>
</tr>
</table>

<table width="100%" id="rounded-corner" border="0" align="center" cellpadding="1" cellspacing="0" >
<thead>
<tr>
	<th align="center" scope="col" class="rounded-company">Id</th>
	<th align="center" scope="col" class="rounded-q1">Subject Name</th>
	<th align="center" scope="col" class="rounded-q1">Semester</th>
	<th align="center" scope="col" class="rounded-q1">Batch</th>
	<th align="center" scope="col" class="rounded-q4">&nbsp;</th>
</tr>
</thead>
<?php


        $result = mysql_query("SELECT * FROM subject_master  where f_id='".$_GET['f_id']."' order by batch_id,sem_id");
        //lets make a loop and get all news from the database
		$i=1;
		if(mysql_num_rows($result)>0)
		{
			 while($myrow = mysql_fetch_array($result))
			 {//begin of loop
			   //now print the results:
			   echo '<tr>';
			   echo "<td align=center>".$i."</td>";$i++;
			   echo "<td align=center>".$myrow['sub_name']."</td>";
			   echo "<td align=center>".sem_name($myrow['sem_id'])."</td>";
			   echo "<td align=center>".batch_name($myrow['batch_id'])."</td>";
			   echo "<td align=center>"."<a href=\"edit_subject.php?sub_id=$myrow[sub_id]\">edit</a> /"."<a href=\"delete_subject.php?sub_id=$myrow[sub_id]&f_id=$myrow[f_id]\">delete</a>"."</td>";
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
