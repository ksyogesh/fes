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
	  include("xls.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="php_calendar/scripts.js" type="text/javascript"></script>
<title>Feedback</title>
</head>

<body>

<?php
/*if(isset($_POST['Reset']))
{
	$b_name='';
	$fac_nam='';
	$sem_name='';
	$sub_name='';
}*/
if(isset($_POST['Submit']) || isset($_POST['xls_file']))
{
	if(isset($_POST['b_name']))
	{
		$query_string.=" b_id='".$_POST['b_name']."' and";
		$b_name=$_POST['b_name'];
	}
	if(isset($_POST['batch_name']))
	{
		$query_string.=" batch_id='".$_POST['batch_name']."' and";
		$batch_name=$_POST['batch_name'];
	}
	if(isset($_POST['feedback_no']))
	{
		$query_string.=" feedback_no='".$_POST['feedback_no']."' and";
		$feedback_no=$_POST['feedback_no'];
	}
	if(isset($_POST['fac_name']))
	{
		$query_string.=" f_id='".$_POST['fac_name']."' and";
		$fac_name=$_POST['fac_name'];
	}
	if(isset($_POST['sem_name']))
	{
		$query_string.=" sem_id='".$_POST['sem_name']."' and";
		$sem_name=$_POST['sem_name'];
	}
	if(isset($_POST['sub_name']))
	{
		$query_string.=" sub_id='".$_POST['sub_name']."' ";
		$sub_name=$_POST['sub_name'];
	}
	$slq_search="select * from feedback_master where (".$query_string.")";
	//echo $slq_search;exit; 	
	$res_search=mysql_query($slq_search) or die(mysql_error());
	if($_POST['query_set']=='1')
	{
		$file_name=write_xls($slq_search);				
	}
}
else
{
	$slq_search="select * from feedback_master order by feed_date asc";
	//echo $sql_search;
	$res_search=mysql_query($slq_search) or die(mysql_error());
}

?>
<?php include("extra_padding.php");?>
<table width="82%" align="center" border="0" cellpadding="0" cellspacing="1" bgcolor="#CCCCCC">

<tr>
<td height="40" colspan="2" align="center" bgcolor="#FFFFFF"> 
<p align="center"><b><font color="#0000FF" size="5">&nbsp;</font><font size="5" color="#CC3300">Admin Panel</font></b></p>
</td>
</tr>

<tr>
<td width="14%" bgcolor="#FFFFFF" valign="top">
<? include('left_side.php');?>
</td>

<td width="86%" align="center" valign="top" bgcolor="#FFFFFF">
<table align="center" width="100%">
<tr><td colspan="3">
<form name="feedback_form" action="<?php echo $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return chkForm();">
<table width="100%" cellpadding="2" cellspacing="6">
        <!--<tr>
		  <td width="116">Date</td>
          <td width="166"><label>
            <input type="text" name="date" id="date" readonly tabindex="2"/><a href="javascript:viewcalendar()">cal</a>
          </label></td>
          <td width="118">&nbsp;</td>
          <td width="95">&nbsp;</td>
          <td width="166">&nbsp;</td>
        </tr>-->
        <tr>
          <td align="left">Branch </td>
          <td align="left"><label>
            <?
			$sel_b="select * from branch_master";
			$res=mysql_query($sel_b) or die(mysql_error());
			
			 while($b_combo=mysql_fetch_array($res))
			 {							
				$branch_combo[] = array('id' => $b_combo['b_id'],
									   'text' => $b_combo['b_name']);								  
			 }
			 if(isset($b_name))
			  $default=$b_name;
			 else
			 	$default='';
			 
			 echo tep_draw_pull_down_menu('b_name',$branch_combo,$default,' tabindex="3" ');
			?>
            
          </label></td>
          <td>&nbsp;</td>
          <td align="left">Semester</td>
          <td align="left">
		  <?
			 $sel_sem="select * from semester_master ";
			 $res_sem=mysql_query($sel_sem) or die(mysql_error());
			
			 while($sem_combo=mysql_fetch_array($res_sem))
			 {							
				$sem_array[] = array('id' => $sem_combo['sem_id'],
									  'text' => $sem_combo['sem_name']);								  
			 }
			 if(isset($sem_name))
			  $default=$sem_name;
			 else
			  $default='';
			 echo tep_draw_pull_down_menu('sem_name',$sem_array,$default,' tabindex="4" ');
	      ?>	</td>
        </tr>
        <tr>
          <td align="left">Batch</td>
          <td align="left"><?
			$sel_batch="select * from batch_master";
			$res_batch=mysql_query($sel_batch) or die(mysql_error());
			
			 while($batch_combo=mysql_fetch_array($res_batch))
			 {							
				$bat_combo[] = array('id' => $batch_combo['batch_id'],
									   'text' => $batch_combo['batch_name']);								  
			 }
			 if(isset($batch_name))
			  $default=$batch_name;
			 else
			 	$default='';
			 
			 echo tep_draw_pull_down_menu('batch_name',$bat_combo,$default,' tabindex="3" ');
			?></td>
          <td>&nbsp;</td>
          <td align="left">Feedback Number</td>
          <td align="left">
		  <?
			if(isset($feedback_no) && $_POST['feedback_no']==1)
			{	$one='selected="selected"';$two='';}
			elseif(isset($feedback_no) && $_POST['feedback_no']==2)
			{	$two='selected="selected"';$one='';}
			else
			{	$one='';$two='';}
		 ?>
		  <select name="feedback_no">
		  <option value="1" <?php echo $one?>>1</option>
		  <option value="2" <?php echo $two?>>2</option>
		  </select></td>
        </tr>
        <tr>
          <td align="left">Faculty Name </td>
          <td align="left"><label>
            <?
			 $sel_fac="select * from faculty_master ";
			 $res_fac=mysql_query($sel_fac) or die(mysql_error());
			
			 while($fac_combo=mysql_fetch_array($res_fac))
			 {							
				$fac_array[] = array('id' => $fac_combo['f_id'],
									  'text' => $fac_combo['f_name'].'&nbsp;'.$fac_combo['l_name']);								  
			 }
			 if(isset($fac_name))
			  $default=$fac_name;
			 else
			 	$default='';
			 echo tep_draw_pull_down_menu('fac_name',$fac_array,$default,' tabindex="5" ');
	      ?>
          </label></td>
          <td>&nbsp;</td>
          <td align="left">Subject Taught </td>
          <td align="left"><label>
            <?
			 $sel_sub="select * from subject_master ";
			 $res_sub=mysql_query($sel_sub) or die(mysql_error());
			
			 while($sub_combo=mysql_fetch_array($res_sub))
			 {							
				$sub_array[] = array('id' => $sub_combo['sub_id'],
									  'text' => $sub_combo['sub_name']);								  
			 }
			 //echo $sub_name;
			 if(isset($sub_name))
			  $default=$sub_name;
			 else
			 	$default='';
			 echo tep_draw_pull_down_menu('sub_name',$sub_array,$default,' tabindex="6" ');
	      ?>
          </label></td></tr>
		  <tr><td colspan="5">&nbsp;</td></tr>
		  <tr>
		  <td colspan="2" align="right"><input type="submit" name="Submit" value="Submit" /></td>
		  <td colspan="1" align="left"><input type="button" value="Reset" onclick="location.href='<?php echo $_SERVER['PHP_SELF']?>'"></td><?php //echo $slq_search?>
		  <?php

$encoded = base64_encode($slq_search);


?>
		  <td><a href="graph.php?str=<?php echo $encoded?>&printable=true"  target="_blank" >Graph</a></td>
		  <td align="left" colspan="2">
		  <input type="hidden" name="query" value="<?php echo $slq_search?>" />
  		<input type="hidden" name="query_set" value="" />
        <input type="submit" name="xls_file" value="Generate xls file" onclick="javascript: create_xls();" />
			<?php if($_REQUEST['query_set']==1)
			{
				echo '<a href="excel_report/'.$file_name.'" target="_blank">Click Here</a>';
			}
			else
				$file_name='';
	  ?>		  </td>
		  </tr>
		  <tr><td colspan="5">&nbsp;</td></tr>
</table>
</form>
</td>
</tr></table>
<table width="100%"><tr><td colspan=11 align=right>Number of Records:- <? echo mysql_num_rows($res_search);?></td></tr></table>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" >

<tr>
	<!--<td align="center">Roll No</td>-->
	
	<td align="center">Ans1</td>
	<td align="center">Ans2</td>
	<td align="center">Ans3</td>
	<td align="center">Ans4</td>
	<td align="center">Ans5</td>
	<td align="center">Ans6</td>
	<td align="center">Ans7</td>
	<td align="center">Ans8</td>
	<td align="center">Ans9</td>
	<td align="center">&nbsp;</td>
	<td align="center">Subject</td>
	<!--<td align="center">Edit / Delete</td>-->
</tr>


<?php 
		if(mysql_num_rows($res_search)!=0)
		{
			$total_ans1=0;
			$total_ans2=0;
			$total_ans3=0;
			$total_ans4=0;
			$total_ans5=0;
			$total_ans6=0;
			$total_ans7=0;
			$total_ans8=0;
			$total_ans9=0;
		     
			 while($myrow = mysql_fetch_array($res_search))
			 {
			   //now print the results:
			   echo '<tr>';
			   echo "<!--<td align=center>".$myrow['roll_no']."</td>-->";$i++;
			   echo "<td align=center>".$myrow['ans1']."</td>";
			   echo "<td align=center>".$myrow['ans2']."</td>";
			   echo "<td align=center>".$myrow['ans3']."</td>";
			   echo "<td align=center>".$myrow['ans4']."</td>";
			   echo "<td align=center>".$myrow['ans5']."</td>";
			   echo "<td align=center>".$myrow['ans6']."</td>";
			   echo "<td align=center>".$myrow['ans7']."</td>";
			   echo "<td align=center>".$myrow['ans8']."</td>";
			   echo "<td align=center>".$myrow['ans9']."</td>";
			   echo "<td align=center>".($myrow['remark']!=''?'<a href="javascript: void(0)" 
	onclick="window.open(\'popup.php?feed_id='.$myrow[feed_id].'\',\'windowname1\',\'width=200, height=77\');return false;">Remark</a>':'&nbsp;')."</td>";
			   echo "<td align=center>".subject_name($myrow['sub_id'])."</td>";
			   echo "<!--<td align=center>"."<a href=\"edit_branch.php?b_id=$myrow[b_id]\">edit</a> /"."<a href=\"delete_branch.php?b_id=$myrow[b_id]\">delete</a>"."</td>-->";
			  echo '</tr>';  
			  
			  
			  $total_ans1=$total_ans1 + $myrow['ans1'];
			  $total_ans2=$total_ans2 + $myrow['ans2'];
			  $total_ans3=$total_ans3 + $myrow['ans3'];
			  $total_ans4=$total_ans4 + $myrow['ans4'];
			  $total_ans5=$total_ans5 + $myrow['ans5'];
			  $total_ans6=$total_ans6 + $myrow['ans6'];
			  $total_ans7=$total_ans7 + $myrow['ans7'];
			  $total_ans8=$total_ans8 + $myrow['ans8'];
			  $total_ans9=$total_ans9 + $myrow['ans9'];
			  
			  //echo "<br><a href=\"read_more.php?newsid=$myrow[newsid]\">Read More...</a>
			  //  || <a href=\"edit_news.php?newsid=$myrow[newsid]\">Edit</a>
			  //   || <a href=\"delete_news.php?newsid=$myrow[newsid]\">Delete</a><br><hr>";
			 }//end of loop
			 
			 
			 echo '<tr><td colspan=11>&nbsp;</td></tr>';
			 echo '<tr>';
			 echo '<td align=center>'.$total_ans1.'</td>';
			 echo '<td align=center>'.$total_ans2.'</td>';
			 echo '<td align=center>'.$total_ans3.'</td>';
			 echo '<td align=center>'.$total_ans4.'</td>';
			 echo '<td align=center>'.$total_ans5.'</td>';
			 echo '<td align=center>'.$total_ans6.'</td>';
			 echo '<td align=center>'.$total_ans7.'</td>';
			 echo '<td align=center>'.$total_ans8.'</td>';
			 echo '<td align=center>'.$total_ans9.'</td>';
			 echo '<td align=center>&nbsp;</td>';
			 echo '<td align=center>&nbsp;</td>';
			 echo '</tr>';
		 }
		 else
		 {
		 	 echo '<tr>';
			  echo "<td align=center colspan=11>No Record Found!</td></tr>";
		 }
?>
</table>
</td>
</tr>
</table>
</body>
</html>
<script language="javascript" type="text/javascript">
function chkForm(form)
{

		var RefForm = document.feedback_form;
				
		if (RefForm.b_name.value == 0 )
		{
			alert("Select Branch");
			RefForm.b_name.focus();			
			return false;
		}
		if (RefForm.batch_name.value == 0 )
		{
			alert("Select Batch");
			RefForm.batch_name.focus();			
			return false;
		}
		if (RefForm.sem_name.value  == 0 )
		{
			alert("Select Semester");			
			RefForm.sem_name.focus();
			return false;
		}
		if (RefForm.fac_name.value == 0 )
		{
			alert("Select Faculty Name.");			
			RefForm.fac_name.focus();
			return false;
		}
		if (RefForm.sub_name.value == 0 )
		{
			alert("Select Subject");
			RefForm.sub_name.focus();			
			return false;
		}
		
		
}
</script>
<script language="javascript" type="text/javascript">
function create_xls()
{
	document.feedback_form.query_set.value='1';	
	return true;
}
</script>
<?
//echo $sql_credit_debit;
 
    function write_xls($sql)
	{//echo $sql;
		$sql=str_replace('\\','',$sql);
		$excel=new ExcelWriter('excel_report/'.date('m_d_Y_s').'_feedback_report.xls');
    
		$file_name=date('m_d_Y_s').'_feedback_report.xls';
		
    	 if($excel==false)    
       	 echo $excel->error;
		 
		 $result1=mysql_query($sql);
		 $arr1=mysql_fetch_array($result1);
		 $myArr=array("Branch",branch_name($arr1['b_id']),"","Semester",sem_name($arr1['sem_id']));
		 $excel->writeLine($myArr);
		 
		 $myArr=array("","","","","","");
		 $excel->writeLine($myArr);
		 
		 $myArr=array("Batch",batch_name($arr1['batch_id']),"","Feedback No",$arr1['feedback_no']);
		 $excel->writeLine($myArr);
		 
		 $myArr=array("","","","","","");
		 $excel->writeLine($myArr);
		 
		 $myArr=array("Faculty Name:",faculty_name($arr1['f_id']),"","Subject:",subject_name($arr1['sub_id']));
		 $excel->writeLine($myArr);
		 
		 $myArr=array("","","","","","");
		 $excel->writeLine($myArr);
		 $myArr=array("","","","","","");
		 $excel->writeLine($myArr);
		 
		
		 $myArr=array("Remark");//"Ans1","Ans2","Ans3","Ans4","Ans5","Ans6","Ans7","Ans8","Ans9"
		 $excel->writeLine($myArr);
		 $myArr=array("","","","","","");
		 $excel->writeLine($myArr);
		
		$result=mysql_query($sql) or die(mysql_error());
		$total_ids="0";
		
		
	    $r_id=1;
		while($arr=mysql_fetch_array($result))
		{		
				if($arr['remark']!=NULL)
				{	
				$myArr=array($arr['remark']);//$arr['ans1'],$arr['ans2'],$arr['ans3'],$arr['ans4'],$arr['ans5'],$arr['ans6'],$arr['ans7'],$arr['ans8'],$arr['ans9']
				$excel->writeLine($myArr);
				//$r_id++;			
				}						
		}
		
		
		$myArr=array("","","","","","");
		$excel->writeLine($myArr);	
				
		$excel->close();
		return $file_name;	
	}

?>
