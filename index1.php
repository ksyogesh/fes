<?php

///////////////////////////////////////////////////////////////////*****/////////////////////////////////////////////////////////////////////////////////////
  //                                																			 											 //
  //														Faculty Evaluation System																		 //
  //													Developed By Dept., of CS&E, GECH																	 //			
  //															 	May 2012																				 //
  //																																						 //		
  //  Tis program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by 				 //
  //  the Free Software  Foundation; either version 2 of the License, or (at your option) any later version.												 //
  //																																						 //
  //  This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or      //
  //  FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.																 //
  //																																						 //
  //////////////////////////////////////////////////////////////////*****//////////////////////////////////////////////////////////////////////////////////////


?>
<?php
include('session_chk.php');  
include("includes/config_db.php");
include("ajax_script.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html>
<head>
<title>Faculty Evaluation System</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="includes/style.css" />


	<style type="text/css">
	body{
		margin:10px;
		font-size:0.9em;
	}
	a{
		color:#F00;
	}
	</style>
	<link rel="stylesheet" href="css/tab-view.css" type="text/css" media="screen">
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/tab-view.js"></script>
	<script type="text/javascript" src="js/update_cost.js"></script>
	
</head>
<body class="body">

<table width="650" height=""  border="0" align="center" cellpadding="5" cellspacing="5" >
  
  <tr>
    <td width="650"  valign="bottom" align="center"><p><b><font size="5" >Faculty Evaluation System</font></b></p></td>
  </tr>
  <tr>
    <td width="650" height="" valign=top>
	<table width="711" border="0" align="center">
      
        <tr>
          <td width="114">USN </td>
          <td width="228"><label>
            <?php
			
			$sel_para="select * from feedback_para";
			$res_para=mysql_query($sel_para) or die(mysql_error());
			$result_para=mysql_fetch_array($res_para);
			
			?>
			<input type="hidden" name="usn_no" value="<?php echo $result_para['usn_no']?>"/>
			<?php echo $result_para['usn_no'];?>
          </label></td>
          <td width="1">&nbsp;</td>
          <!--<td width="98">Date</td>
          <td width="175"><label>
            <input type="text" name="date" id="date" readonly tabindex="2"/><a href="javascript:viewcalendar()">cal</a>
          </label></td>-->
		  <td width="161">Batch</td>
		  <td width="173"><label>
            <?php
			$sel_batch="select * from batch_master";
			$res_batch=mysql_query($sel_batch) or die(mysql_error());
			
			 while($batch_combo=mysql_fetch_array($res_batch))
			 {							
				$bat_combo[] = array('id' => $batch_combo['batch_id'],
									   'text' => $batch_combo['batch_name']);								  
			 }
			 //echo tep_draw_pull_down_menu('batch_name',$bat_combo,$default,' tabindex="2" ');
			
			$sel_para="select * from feedback_para";
			$res_para=mysql_query($sel_para) or die(mysql_error());
			$result_para=mysql_fetch_array($res_para);
			
			?>
            <input type="hidden" name="batch_name" value="<?php echo $result_para['batch_id']?>"/>
			<?php echo batch_name($result_para['batch_id']);?>
          </label></td>
        </tr>
        <tr>
          <td>Branch </td>
          <td><label>
            <?
			$sel_b="select * from branch_master";
			$res=mysql_query($sel_b) or die(mysql_error());
			
			 while($b_combo=mysql_fetch_array($res))
			 {							
				$branch_combo[] = array('id' => $b_combo['b_id'],
									   'text' => $b_combo['b_name']);								  
			 }
			 //echo tep_draw_pull_down_menu('b_name',$branch_combo,$default,' tabindex="3" ');
			?>
            <input type="hidden" name="b_name" value="<?php echo $result_para['b_id']?>"/>
			<?php echo branch_name($result_para['b_id']);?>
          </label></td>
          <td>&nbsp;</td>
          <td>Semester</td>
          <td>
		  <?php
			 $sel_sem="select * from semester_master ";
			 $res_sem=mysql_query($sel_sem) or die(mysql_error());
			
			 while($sem_combo=mysql_fetch_array($res_sem))
			 {							
				$sem_array[] = array('id' => $sem_combo['sem_id'],
									  'text' => $sem_combo['sem_name']);								  
			 }
			 
			// echo tep_draw_pull_down_menu('sem_name',$sem_array,$default,' tabindex="4" ');
	      ?>
		  <input type="hidden" name="sem_name" value="<?php echo $result_para['sem_id']?>"/>
			<?php echo sem_name($result_para['sem_id']);?>
		  	</td>
        </tr>
</table>
</table>



<div id="dhtmlgoodies_tabView1" >
	<div class="dhtmlgoodies_aTab" >
<!--	<table width="650" height=""  border="0" align="center" cellpadding="5" cellspacing="5" > -->
	<table width="711" border="0" align="center">
	
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="feedback_form">
		
		<tr>
		  <input type="hidden" name="usn_no" value="<?php echo $result_para['usn_no']?>"/>
		  <input type="hidden" name="sem_name" value="<?php echo $result_para['sem_id']?>"/>
		  <input type="hidden" name="b_name" value="<?php echo $result_para['b_id']?>"/>
		  <input type="hidden" name="batch_name" value="<?php echo $result_para['batch_id']?>"/>
          <td>Faculty Name </td>
          <td><label>
            <?php
			 $sel_fac_1="select distinct fm.f_id, fm.f_name,fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$result_para['b_id']."' and sm.batch_id='".$result_para['batch_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$result_para['sem_id'];
			 $res_fac_1=mysql_query($sel_fac_1) or die(mysql_error());
			 
			// $default = 1;
			// echo tep_draw_pull_down_menu('fac_name', $fac_array, $default,' tabindex="5" onChange="AjaxFunction(this.value);"');
	       
			//m p of code
			
			if (mysql_data_seek($res_fac_1, 0)) 
			{ 
     		$fac_row_1 = mysql_fetch_row($res_fac_1);
			}
		  
	      ?>
	     
		  <input type="hidden" name="fac_name" value="<?php echo $fac_row_1[0]; ?>"/>
		  <?php echo faculty_name($fac_row_1[0]); ?>
	
          </label></td>
          <td>&nbsp;</td>
          <td>Subject Taught</td>
          <td><label>
            <?php
			 $sel_sub_1="select * from subject_master as sm , faculty_master as fm where fm.b_id='".$result_para['b_id']."' and fm.f_id='".$fac_row_1[0]."' and sm.sem_id='".$result_para['sem_id']."'" ;
			 $res_sub_1=mysql_query($sel_sub_1) or die(mysql_error());
			
			 
			if (mysql_data_seek($res_sub_1, 0)) { 
     			$sub_row_1 = mysql_fetch_row($res_sub_1);}
		  //echo $res_sub;
	      ?>
	
		  <input type="hidden" name="sub_name" value="<?php echo $sub_row_1[0]; ?>"/>
		  
		  <?php echo subject_name($sub_row_1[0]); ?>

          
          </label></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
          <td colspan="5" align="center"></td>
        </tr>
		<tr>
          <td colspan="5">
		  <table width="100%" id="rounded-corner" cellpadding="10" cellspacing="0" border="0" align="center">
		  <thead>
		  <tr >
		     <th width="8%" class="rounded-company" align="center">ID</th>			 
			 <th width="86%" class="rounded-q1" align="center">Attributes</th>
			 <th width="6%" class="rounded-q4">&nbsp;</th>
		  </tr>
		  </thead>
		  <?php
		  	$sql_que="select * from feedback_ques_master";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			$i=1;
			$tab_ind=7;
			while($row_que=mysql_fetch_array($res_que))
			{
				if($i>=0 && $i<=5)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td style=\"white-space:nowrap\" > 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 6<input type=\"radio\" name=\"ans_$i\" value=6 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 7<input type=\"radio\" name=\"ans_$i\" value=7 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 8<input type=\"radio\" name=\"ans_$i\" value=8 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 9<input type=\"radio\" name=\"ans_$i\" value=9 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 10<input type=\"radio\" name=\"ans_$i\" value=10 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> </td>";$tab_ind++;
				echo "</tr>";$i++;
				}
				else if($i>=6 && $i<=15)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td> 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost()\" tabindex=\"$tab_ind\" />  </td>";$tab_ind++;
				echo "</tr>";$i++;
				}
				
			}
		  ?>	
		  
		  <tr>
		  <td>Total:</td>
		  <td colspan="2"><input type="text" name="total" style="width:705px; height:25px;" value=""></input></td>
		  </tr>		  
		  	<tr>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="submit" value="Submit" onclick="ValidateForm(this.form)"/>&nbsp;<input type="reset" name="reset" value="Reset" tabindex="24" class="button"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>			
		  </table>
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td width="697"  height="1"></td>
  </tr>
 <tr><td><?php include("footer.php"); ?></td></tr> 
</table>
</div>
	
	
	
	<div class="dhtmlgoodies_aTab">
		<table width="650" height="561"  border="0" align="center" cellpadding="5" cellspacing="5" >
		<table width="711" border="0" align="center">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="feedback_form1" onsubmit="return chkForm();">
		<tr>
		  <input type="hidden" name="usn_no" value="<?php echo $result_para['usn_no']?>"/>
		  <input type="hidden" name="sem_name" value="<?php echo $result_para['sem_id']?>"/>
		  <input type="hidden" name="b_name" value="<?php echo $result_para['b_id']?>"/>
		  <input type="hidden" name="batch_name" value="<?php echo $result_para['batch_id']?>"/>
		
          <td>Faculty Name </td>
          <td><label>
            <?php
			 $sel_fac_2="select distinct fm.f_id, fm.f_name,fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$result_para['b_id']."' and sm.batch_id='".$result_para['batch_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$result_para['sem_id'];
			 $res_fac_2=mysql_query($sel_fac_2) or die(mysql_error());
			 
			 if (mysql_data_seek($res_fac_2, 1)) 
			{ 
     		$fac_row_2 = mysql_fetch_row($res_fac_2);
			}
		  
	      ?>
	     
		  <input type="hidden" name="fac_name" value="<?php echo $fac_row_2[0]; ?>"/>
		  <?php echo faculty_name($fac_row_2[0]); ?>
          </label></td>
          
          
          <td>&nbsp;</td>
          <td>Subject Taught </td>
          <td><label>
            <?php
			 $sel_sub_2="select * from subject_master as sm , faculty_master as fm where fm.b_id='".$result_para['b_id']."' and fm.f_id='".$fac_row_2[0]."' and sm.sem_id='".$result_para['sem_id']."'" ;
			 $res_sub_2=mysql_query($sel_sub_2) or die(mysql_error());
			 
			if (mysql_data_seek($res_sub_2, 1)) { 
     			$sub_row_2 = mysql_fetch_row($res_sub_2);}
		  //echo $res_sub;
	      ?>
	
		  <input type="hidden" name="sub_name" value="<?php echo $sub_row_2[0]; ?>"/>
		  
		  <?php echo subject_name($sub_row_2[0]); ?>
		
		
          </label></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
          <td colspan="5" align="center"></td>
        </tr>
		<tr>
          <td colspan="5">
		  <table width="100%" id="rounded-corner" cellpadding="10" cellspacing="0" border="0" align="center">
		  <thead>
		  <tr >
		     <th width="8%" class="rounded-company" align="center">ID</th>			 
			 <th width="86%" class="rounded-q1" align="center">Attributes</th>
			 <th width="6%" class="rounded-q4">&nbsp;</th>
		  </tr>
		  </thead>
		  <?php
		  	$sql_que="select * from feedback_ques_master";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			$i=1;
			$tab_ind=7;
			while($row_que=mysql_fetch_array($res_que))
			{
				if($i>=0 && $i<=5)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td style=\"white-space:nowrap\" > 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 6<input type=\"radio\" name=\"ans_$i\" value=6 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 7<input type=\"radio\" name=\"ans_$i\" value=7 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 8<input type=\"radio\" name=\"ans_$i\" value=8 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 9<input type=\"radio\" name=\"ans_$i\" value=9 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 10<input type=\"radio\" name=\"ans_$i\" value=10 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> </td>";$tab_ind++;
				echo "</tr>";$i++;
				}
				else if($i>=6 && $i<=15)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td> 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost1()\" tabindex=\"$tab_ind\" />  </td>";$tab_ind++;
				echo "</tr>";$i++;
				}
				
			}
		  ?>	
		  
		  <tr>
		  <td>Total:</td>
		  <td colspan="2"><input type="text" name="total" style="width:705px; height:25px;" value=""></input></td>
		  </tr>		  
		  	<tr>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="submit1" value="Submit" tabindex="22"/>&nbsp;<input type="reset" name="reset" value="Reset" tabindex="24" class="button"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>			
		  </table>
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td width="697"  height="1"></td>
  </tr>
 <tr><td><?php include("footer.php"); ?></td></tr> 
</table>	
</div>



	<div class="dhtmlgoodies_aTab">
		
		<table width="650" height="561"  border="0" align="center" cellpadding="5" cellspacing="5" >
		<table width="711" border="0" align="center">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="feedback_form2" onsubmit="return chkForm();">
		<tr>
		  <input type="hidden" name="usn_no" value="<?php echo $result_para['usn_no']?>"/>
		  <input type="hidden" name="sem_name" value="<?php echo $result_para['sem_id']?>"/>
		  <input type="hidden" name="b_name" value="<?php echo $result_para['b_id']?>"/>
		  <input type="hidden" name="batch_name" value="<?php echo $result_para['batch_id']?>"/>
		
          <td>Faculty Name </td>
          <td><label>
            <?php
			 $sel_fac_3="select distinct fm.f_id, fm.f_name,fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$result_para['b_id']."' and sm.batch_id='".$result_para['batch_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$result_para['sem_id'];
			 $res_fac_3=mysql_query($sel_fac_3) or die(mysql_error());
			
			
			 if (mysql_data_seek($res_fac_3, 2)) 
			{ 
     		$fac_row_3 = mysql_fetch_row($res_fac_3);
			}
		  
	      ?>
	     
		  <input type="hidden" name="fac_name" value="<?php echo $fac_row_3[0]; ?>"/>
		  <?php echo faculty_name($fac_row_3[0]); ?>
          
          </label></td>
          
          <td>&nbsp;</td>
          <td>Subject Taught </td>
          <td><label>
          <?php
			 $sel_sub_3="select * from subject_master as sm , faculty_master as fm where fm.b_id='".$result_para['b_id']."' and fm.f_id='".$fac_row_3[0]."' and sm.sem_id='".$result_para['sem_id']."'" ;
			 $res_sub_3=mysql_query($sel_sub_3) or die(mysql_error());
			 
			if (mysql_data_seek($res_sub_3, 2)) { 
     			$sub_row_3 = mysql_fetch_row($res_sub_3);}
		 
	      ?>
	
		  <input type="hidden" name="sub_name" value="<?php echo $sub_row_3[0]; ?>"/>
		  
		  <?php echo subject_name($sub_row_3[0]); ?>
		  
		  
          </label></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
          <td colspan="5" align="center"></td>
        </tr>
		<tr>
          <td colspan="5">
		  <table width="100%" id="rounded-corner" cellpadding="10" cellspacing="0" border="0" align="center">
		  <thead>
		  <tr >
		     <th width="8%" class="rounded-company" align="center">ID</th>			 
			 <th width="86%" class="rounded-q1" align="center">Attributes</th>
			 <th width="6%" class="rounded-q4">&nbsp;</th>
		  </tr>
		  </thead>
		  <?php
		  	$sql_que="select * from feedback_ques_master";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			$i=1;
			while($row_que=mysql_fetch_array($res_que))
			{
				if($i>=0 && $i<=5)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td style=\"white-space:nowrap\" > 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 6<input type=\"radio\" name=\"ans_$i\" value=6 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 7<input type=\"radio\" name=\"ans_$i\" value=7 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 8<input type=\"radio\" name=\"ans_$i\" value=8 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 9<input type=\"radio\" name=\"ans_$i\" value=9 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 10<input type=\"radio\" name=\"ans_$i\" value=10 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> </td>";$tab_ind++;
				echo "</tr>";$i++;
				}
				else if($i>=6 && $i<=15)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td> 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost2()\" tabindex=\"$tab_ind\" />  </td>";$tab_ind++;
				echo "</tr>";$i++;
				}
				
			}
		  ?>	
		  
		  <tr>
		  <td>Total:</td>
		  <td colspan="2"><input type="text" name="total" style="width:705px; height:25px;" align="center" value=""></input></td>
		  </tr>		  
		  	<tr>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="submit2" value="Submit" tabindex="22"/>&nbsp;<input type="reset" name="reset" value="Reset" tabindex="24" class="button"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>			
		  </table>
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td width="697"  height="1"></td>
  </tr>
  <tr><td><?php include("footer.php"); ?></td></tr>
</table>		
</div>
	
	<div class="dhtmlgoodies_aTab">
		
		<table width="650" height="561"  border="0" align="center" cellpadding="5" cellspacing="5" >
		<table width="711" border="0" align="center">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="feedback_form3" onsubmit="return chkForm();">
		<tr>
		  <input type="hidden" name="usn_no" value="<?php echo $result_para['usn_no']?>"/>
		  <input type="hidden" name="sem_name" value="<?php echo $result_para['sem_id']?>"/>
		  <input type="hidden" name="b_name" value="<?php echo $result_para['b_id']?>"/>
		  <input type="hidden" name="batch_name" value="<?php echo $result_para['batch_id']?>"/>
          <td>Faculty Name </td>
          <td><label>
            <?php
			 $sel_fac_4="select distinct fm.f_id, fm.f_name,fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$result_para['b_id']."' and sm.batch_id='".$result_para['batch_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$result_para['sem_id'];
			 $res_fac_4=mysql_query($sel_fac_4) or die(mysql_error());
			
			
			 if (mysql_data_seek($res_fac_4, 3)) 
			{ 
     		$fac_row_4 = mysql_fetch_row($res_fac_4);
			}
		  
	      ?>
	     
		  <input type="hidden" name="fac_name" value="<?php echo $fac_row_4[0]; ?>"/>
		  <?php echo faculty_name($fac_row_4[0]); ?>
          </label></td>
          
          <td>&nbsp;</td>
          <td>Subject Taught </td>
          <td><label>
                <?php
			 $sel_sub_4="select * from subject_master as sm , faculty_master as fm where fm.b_id='".$result_para['b_id']."' and fm.f_id='".$fac_row_4[0]."' and sm.sem_id='".$result_para['sem_id']."'" ;
			 $res_sub_4=mysql_query($sel_sub_4) or die(mysql_error());
			 
			if (mysql_data_seek($res_sub_4, 3)) { 
     			$sub_row_4 = mysql_fetch_row($res_sub_4);}
		 
	      ?>
	
		  <input type="hidden" name="sub_name" value="<?php echo $sub_row_4[0]; ?>"/>
		  
		  <?php echo subject_name($sub_row_4[0]); ?>
		  
		 
		 
          </label></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
          <td colspan="5" align="center"></td>
        </tr>
		<tr>
          <td colspan="5">
		  <table width="100%" id="rounded-corner" cellpadding="10" cellspacing="0" border="0" align="center">
		  <thead>
		  <tr >
		     <th width="8%" class="rounded-company" align="center">ID</th>			 
			 <th width="86%" class="rounded-q1" align="center">Attributes</th>
			 <th width="6%" class="rounded-q4">&nbsp;</th>
		  </tr>
		  </thead>
		  <?php
		  	$sql_que="select * from feedback_ques_master";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			$i=1;
			$tab_ind=7;
			while($row_que=mysql_fetch_array($res_que))
			{
				if($i>=0 && $i<=5)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td style=\"white-space:nowrap\" > 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 6<input type=\"radio\" name=\"ans_$i\" value=6 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 7<input type=\"radio\" name=\"ans_$i\" value=7 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 8<input type=\"radio\" name=\"ans_$i\" value=8 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 9<input type=\"radio\" name=\"ans_$i\" value=9 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 10<input type=\"radio\" name=\"ans_$i\" value=10 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> </td>";$tab_ind++;
				echo "</tr>";$i++;
				}
				else if($i>=6 && $i<=15)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td> 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost3()\" tabindex=\"$tab_ind\" />  </td>";$tab_ind++;
				echo "</tr>";$i++;
				}
				
			}
		  ?>	
		  
		  <tr>
		  <td>Total:</td>
		  <td colspan="2"><input type="text" name="total" style="width:705px; height:25px;" value=""></input></td>
		  </tr>		  
		  	<tr>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="submit3" value="Submit" />&nbsp;<input type="reset" name="reset" value="Reset" class="button"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>			
		  </table>
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td width="697"  height="1"></td>
  </tr>
  <tr><td><?php include("footer.php"); ?></td></tr>
</table>
</div>




<div class="dhtmlgoodies_aTab">
		
		
	<table width="650" height="561"  border="0" align="center" cellpadding="5" cellspacing="5" >
		<table width="711" border="0" align="center">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="feedback_form4" onsubmit="return chkForm();">
		<tr>
		  <input type="hidden" name="usn_no" value="<?php echo $result_para['usn_no']?>"/>
		  <input type="hidden" name="sem_name" value="<?php echo $result_para['sem_id']?>"/>
		  <input type="hidden" name="b_name" value="<?php echo $result_para['b_id']?>"/>
		  <input type="hidden" name="batch_name" value="<?php echo $result_para['batch_id']?>"/>
          <td>Faculty Name </td>
          <td><label>
            <?php
			 $sel_fac_5="select distinct fm.f_id, fm.f_name,fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$result_para['b_id']."' and sm.batch_id='".$result_para['batch_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$result_para['sem_id'];
			 $res_fac_5=mysql_query($sel_fac_5) or die(mysql_error());
			
			
			if (mysql_data_seek($res_fac_5, 4)) 
			{ 
     		$fac_row_5 = mysql_fetch_row($res_fac_5);
			}
		  
	      ?>
	     
		  <input type="hidden" name="fac_name" value="<?php echo $fac_row_5[0]; ?>"/>
		  <?php echo faculty_name($fac_row_5[0]); ?>
          </label></td>
          
          <td>&nbsp;</td>
          <td>Subject Taught </td>
          <td><label>
          <?php
			 $sel_sub_5="select * from subject_master as sm , faculty_master as fm where fm.b_id='".$result_para['b_id']."' and fm.f_id='".$fac_row_5[0]."' and sm.sem_id='".$result_para['sem_id']."'" ;
			 $res_sub_5=mysql_query($sel_sub_5) or die(mysql_error());
			 
			if (mysql_data_seek($res_sub_5, 4)) { 
     			$sub_row_5 = mysql_fetch_row($res_sub_5);}
		 
	      ?>
	
		  <input type="hidden" name="sub_name" value="<?php echo $sub_row_5[0]; ?>"/>
		  
		  <?php echo subject_name($sub_row_5[0]); ?>
		  
		 
		 
          </label></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
          <td colspan="5" align="center"></td>
        </tr>
		<tr>
          <td colspan="5">
		  <table width="100%" id="rounded-corner" cellpadding="10" cellspacing="0" border="0" align="center">
		  <thead>
		  <tr >
		     <th width="8%" class="rounded-company" align="center">ID</th>			 
			 <th width="86%" class="rounded-q1" align="center">Attributes</th>
			 <th width="6%" class="rounded-q4">&nbsp;</th>
		  </tr>
		  </thead>
		  <?php
		  	$sql_que="select * from feedback_ques_master";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			$i=1;
			
			while($row_que=mysql_fetch_array($res_que))
			{
				if($i>=0 && $i<=5)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td style=\"white-space:nowrap\" > 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost4()\"   /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost4()\"   /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost4()\"   /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost4()\"   /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost4()\"   /> 6<input type=\"radio\" name=\"ans_$i\" value=6 onclick=\"UpdateCost4()\"   /> 7<input type=\"radio\" name=\"ans_$i\" value=7 onclick=\"UpdateCost4()\"   /> 8<input type=\"radio\" name=\"ans_$i\" value=8 onclick=\"UpdateCost4()\"   /> 9<input type=\"radio\" name=\"ans_$i\" value=9 onclick=\"UpdateCost4()\"   /> 10<input type=\"radio\" name=\"ans_$i\" value=10 onclick=\"UpdateCost4()\"   /> </td>"; 
				echo "</tr>";$i++;
				}
				else if($i>=6 && $i<=15)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td> 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost4()\"   /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost4()\"   /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost4()\"   /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost4()\"   /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost4()\"   />  </td>"; 
				echo "</tr>";$i++;
				}
				
			}
		  ?>	
		  
		  <tr>
		  <td>Total:</td>
		  <td colspan="2"><input type="text" name="total" style="width:705px; height:25px;" value=""></input></td>
		  </tr>		  
		  	<tr>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="submit4" value="Submit" />&nbsp;<input type="reset" name="reset" value="Reset" class="button"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>			
		  </table>
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td width="697"  height="1"></td>
  </tr>
  <tr><td><?php include("footer.php"); ?></td></tr>
</table>	
		
		
		<a href="#" onclick="deleteTab('Subject5')">Remove this tab</a><br>
</div>

	
	
	
	<div class="dhtmlgoodies_aTab">
		
		
		<table width="650" height="561"  border="0" align="center" cellpadding="5" cellspacing="5" >
		<table width="711" border="0" align="center">
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="feedback_form5" onsubmit="return chkForm();">
		<tr>
		  <input type="hidden" name="usn_no" value="<?php echo $result_para['usn_no']?>"/>
		  <input type="hidden" name="sem_name" value="<?php echo $result_para['sem_id']?>"/>
		  <input type="hidden" name="b_name" value="<?php echo $result_para['b_id']?>"/>
		  <input type="hidden" name="batch_name" value="<?php echo $result_para['batch_id']?>"/>
          <td>Faculty Name </td>
          <td><label>
            <?php
			 $sel_fac_6="select distinct fm.f_id, fm.f_name,fm.l_name from faculty_master as fm, subject_master as sm where fm.b_id='".$result_para['b_id']."' and sm.batch_id='".$result_para['batch_id']."' and fm.f_id=sm.f_id and sm.sem_id=".$result_para['sem_id'];
			 $res_fac_6=mysql_query($sel_fac_6) or die(mysql_error());
			
			
			 if (mysql_data_seek($res_fac_6, 5)) 
			{ 
     		$fac_row_6 = mysql_fetch_row($res_fac_6);
			}
		  
	      ?>
	     
		  <input type="hidden" name="fac_name" value="<?php echo $fac_row_6[0]; ?>"/>
		  <?php echo faculty_name($fac_row_6[0]); ?>
          </label></td>
          
          <td>&nbsp;</td>
          <td>Subject Taught </td>
          <td><label>
          <?php
			 $sel_sub_6="select * from subject_master as sm , faculty_master as fm where fm.b_id='".$result_para['b_id']."' and fm.f_id='".$fac_row_6[0]."' and sm.sem_id='".$result_para['sem_id']."'" ;
			 $res_sub_6=mysql_query($sel_sub_6) or die(mysql_error());
			 
			if (mysql_data_seek($res_sub_6, 5)) { 
     			$sub_row_6 = mysql_fetch_row($res_sub_6);}
		 
	      ?>
	
		  <input type="hidden" name="sub_name" value="<?php echo $sub_row_6[0]; ?>"/>
		  
		  <?php echo subject_name($sub_row_6[0]); ?>
		  
		 
		 
          </label></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr>
          <td colspan="5" align="center"></td>
        </tr>
		<tr>
          <td colspan="5">
		  <table width="100%" id="rounded-corner" cellpadding="10" cellspacing="0" border="0" align="center">
		  <thead>
		  <tr >
		     <th width="8%" class="rounded-company" align="center">ID</th>			 
			 <th width="86%" class="rounded-q1" align="center">Attributes</th>
			 <th width="6%" class="rounded-q4">&nbsp;</th>
		  </tr>
		  </thead>
		  <?php
		  	$sql_que="select * from feedback_ques_master";
			$res_que=mysql_query($sql_que) or die(mysql_error());
			$i=1;
			
			while($row_que=mysql_fetch_array($res_que))
			{
				if($i>=0 && $i<=5)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td style=\"white-space:nowrap\" > 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost5()\"   /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost5()\"   /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost5()\"   /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost5()\"   /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost5()\"   /> 6<input type=\"radio\" name=\"ans_$i\" value=6 onclick=\"UpdateCost5()\"   /> 7<input type=\"radio\" name=\"ans_$i\" value=7 onclick=\"UpdateCost5()\"   /> 8<input type=\"radio\" name=\"ans_$i\" value=8 onclick=\"UpdateCost5()\"   /> 9<input type=\"radio\" name=\"ans_$i\" value=9 onclick=\"UpdateCost5()\"   /> 10<input type=\"radio\" name=\"ans_$i\" value=10 onclick=\"UpdateCost5()\"   /> </td>"; 
				echo "</tr>";$i++;
				}
				else if($i>=6 && $i<=15)
				{
				echo "<tr>";
				echo "<td align=\"center\">".$i."</td>";
				echo "<td>".$row_que['ques']."</td>";
				echo "<td> 1<input type=\"radio\" name=\"ans_$i\" value=1 onclick=\"UpdateCost5()\"   /> 2<input type=\"radio\" name=\"ans_$i\" value=2 onclick=\"UpdateCost5()\"   /> 3<input type=\"radio\" name=\"ans_$i\" value=3 onclick=\"UpdateCost5()\"   /> 4<input type=\"radio\" name=\"ans_$i\" value=4 onclick=\"UpdateCost5()\"   /> 5<input type=\"radio\" name=\"ans_$i\" value=5 onclick=\"UpdateCost5()\"   />  </td>"; 
				echo "</tr>";$i++;
				}
				
			}
		  ?>	
		  
		  <tr>
		  <td>Total:</td>
		  <td colspan="2"><input type="text" name="total" style="width:705px; height:25px;" value=""></input></td>
		  </tr>		  
		  	<tr>
				<td colspan="2"  class="rounded-foot-left" align="center"><input class="button" type="submit" name="submit5" value="Submit" />&nbsp;<input type="reset" name="reset" value="Reset" class="button"/></td>
				<td align="center" class="rounded-foot-right"></td>
			</tr>			
		  </table>
		  </td>
        </tr>
      </table>
    </form></td>
  </tr>
  <tr>
    <td width="697"  height="1"></td>
  </tr>
<tr><td><?php include("footer.php"); ?></td></tr>
</table>
</div>
	<div class="dhtmlgoodies_aTab">
		CSLabs GECH<br>
	</div>
</div>
<script type="text/javascript">
initTabs('dhtmlgoodies_tabView1',Array('Subject1','Subject2','Subject3','Subject4','Subject5','Subject6','About Us'),0,650,500,Array(true,true,true,true,true,true,true));
</script>
</body>
</html>





<script language="javascript" type="text/javascript">

// Validation is not working :(
/*
function ValidateForm(form){
ErrorText= "";
for(i=0;i<=10;i++)
if ( form.ans_1[0].checked == false ) 
{ alert ( "Please choose your marks" ); return false; }
if (ErrorText= "") { form.submit() }
}
*/
</script>






<?php


if(isset($_POST['submit']))
{
	//feedback no
	$check_feedback_no="select * from batch_master where batch_id='".$_POST['batch_name']."'";
	$res_feedback_no=mysql_query($check_feedback_no) or die(mysql_error());
	$result=mysql_fetch_array($res_feedback_no);
	
	
	$sql="select * from usn where usn_no='".$_POST['usn_no']."' and b_id='".$_POST['b_name']."' and sub_id='".$_POST['sub_name']."' and sem_id='".$_POST['sem_name']."'";
	//echo $sql;
	$res=mysql_query($sql) or die(mysql_error());
	
	
	if(mysql_num_rows($res)>=1)
	{
		echo "<p align=\"center\">Feedback is already submited by '".$_POST['usn_no']."' usn for this subject.<br>Thank You</p>";
		echo "<meta http-equiv=Refresh content=3;url=javascript: history.go(-1)>";
		exit;
	}
	else
	{
		
		$sql_insert_usn="insert into usn (usn_no,b_id,sub_id,sem_id) values('".$_POST['usn_no']."','".$_POST['b_name']."','".$_POST['sub_name']."','".$_POST['sem_name']."')";
		mysql_query($sql_insert_usn) or die(mysql_error());
		$sql_insert="insert into feedback_master (b_id ,batch_id, feedback_no ,sem_id , f_id , sub_id , ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9, ans10, ans11, ans12, ans13, ans14, ans15, total, feed_date) values ('".$_POST['b_name']."','".$_POST['batch_name']."','".$result['feedback_no']."','".$_POST['sem_name']."','".$_POST['fac_name']."','".$_POST['sub_name']."','".$_POST['ans_1']."','".$_POST['ans_2']."','".$_POST['ans_3']."','".$_POST['ans_4']."','".$_POST['ans_5']."','".$_POST['ans_6']."','".$_POST['ans_7']."','".$_POST['ans_8']."','".$_POST['ans_9']."','".$_POST['ans_10']."','".$_POST['ans_11']."','".$_POST['ans_12']."','".$_POST['ans_13']."','".$_POST['ans_14']."','".$_POST['ans_15']."','".$_POST['total']."','".date('Y-m-d')."')";
		mysql_query($sql_insert) or die(mysql_error());
	?>
		<script type="text/javascript">deleteTab('Subject1');</script>

<?php		
}
}
?>



<?php


if(isset($_POST['submit1']))
{
	//feedback no
	$check_feedback_no="select * from batch_master where batch_id='".$_POST['batch_name']."'";
	$res_feedback_no=mysql_query($check_feedback_no) or die(mysql_error());
	$result=mysql_fetch_array($res_feedback_no);
	
	
	$sql="select * from usn where usn_no='".$_POST['usn_no']."' and b_id='".$_POST['b_name']."' and sub_id='".$_POST['sub_name']."' and sem_id='".$_POST['sem_name']."'";
	//echo $sql;
	$res=mysql_query($sql) or die(mysql_error());
	
	
	if(mysql_num_rows($res)>=1)
	{
		echo "<p align=\"center\">Feedback is already submited by '".$_POST['usn_no']."' usn for this subject.<br>Thank You</p>";
		echo "<meta http-equiv=Refresh content=3;url=javascript: history.go(-1)>";
		exit;
	}
	else
	{
		
		$sql_insert_usn="insert into usn (usn_no,b_id,sub_id,sem_id) values('".$_POST['usn_no']."','".$_POST['b_name']."','".$_POST['sub_name']."','".$_POST['sem_name']."')";
		mysql_query($sql_insert_usn) or die(mysql_error());
		$sql_insert="insert into feedback_master (b_id ,batch_id, feedback_no ,sem_id , f_id , sub_id , ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9, ans10, ans11, ans12, ans13, ans14, ans15, total, feed_date) values ('".$_POST['b_name']."','".$_POST['batch_name']."','".$result['feedback_no']."','".$_POST['sem_name']."','".$_POST['fac_name']."','".$_POST['sub_name']."','".$_POST['ans_1']."','".$_POST['ans_2']."','".$_POST['ans_3']."','".$_POST['ans_4']."','".$_POST['ans_5']."','".$_POST['ans_6']."','".$_POST['ans_7']."','".$_POST['ans_8']."','".$_POST['ans_9']."','".$_POST['ans_10']."','".$_POST['ans_11']."','".$_POST['ans_12']."','".$_POST['ans_13']."','".$_POST['ans_14']."','".$_POST['ans_15']."','".$_POST['total']."','".date('Y-m-d')."')";
		mysql_query($sql_insert) or die(mysql_error());
	?>
		<script type="text/javascript">deleteTab('Subject2');</script>
		<script type="text/javascript">deleteTab('Subject1');</script>

<?php		
}
}
?>


<?php


if(isset($_POST['submit2']))
{
	//feedback no
	$check_feedback_no="select * from batch_master where batch_id='".$_POST['batch_name']."'";
	$res_feedback_no=mysql_query($check_feedback_no) or die(mysql_error());
	$result=mysql_fetch_array($res_feedback_no);
	
	
	$sql="select * from usn where usn_no='".$_POST['usn_no']."' and b_id='".$_POST['b_name']."' and sub_id='".$_POST['sub_name']."' and sem_id='".$_POST['sem_name']."'";
	//echo $sql;
	$res=mysql_query($sql) or die(mysql_error());
	
	
	if(mysql_num_rows($res)>=1)
	{
		echo "<p align=\"center\">Feedback is already submited by '".$_POST['usn_no']."' usn for this subject.<br>Thank You</p>";
		echo "<meta http-equiv=Refresh content=3;url=index3.php>";
		exit;
	}
	else
	{
		
		$sql_insert_usn="insert into usn (usn_no,b_id,sub_id,sem_id) values('".$_POST['usn_no']."','".$_POST['b_name']."','".$_POST['sub_name']."','".$_POST['sem_name']."')";
		mysql_query($sql_insert_usn) or die(mysql_error());
		$sql_insert="insert into feedback_master (b_id ,batch_id, feedback_no ,sem_id , f_id , sub_id , ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9, ans10, ans11, ans12, ans13, ans14, ans15, total, feed_date) values ('".$_POST['b_name']."','".$_POST['batch_name']."','".$result['feedback_no']."','".$_POST['sem_name']."','".$_POST['fac_name']."','".$_POST['sub_name']."','".$_POST['ans_1']."','".$_POST['ans_2']."','".$_POST['ans_3']."','".$_POST['ans_4']."','".$_POST['ans_5']."','".$_POST['ans_6']."','".$_POST['ans_7']."','".$_POST['ans_8']."','".$_POST['ans_9']."','".$_POST['ans_10']."','".$_POST['ans_11']."','".$_POST['ans_12']."','".$_POST['ans_13']."','".$_POST['ans_14']."','".$_POST['ans_15']."','".$_POST['total']."','".date('Y-m-d')."')";
		mysql_query($sql_insert) or die(mysql_error());
	?>
		<script type="text/javascript">deleteTab('Subject3');</script>
				<script type="text/javascript">deleteTab('Subject2');</script>
		<script type="text/javascript">deleteTab('Subject1');</script>

<?php		
}
}
?>



<?php
if(isset($_POST['submit3']))
{
	//feedback no
	$check_feedback_no="select * from batch_master where batch_id='".$_POST['batch_name']."'";
	$res_feedback_no=mysql_query($check_feedback_no) or die(mysql_error());
	$result=mysql_fetch_array($res_feedback_no);
	
	
	$sql="select * from usn where usn_no='".$_POST['usn_no']."' and b_id='".$_POST['b_name']."' and sub_id='".$_POST['sub_name']."' and sem_id='".$_POST['sem_name']."'";
	//echo $sql;
	$res=mysql_query($sql) or die(mysql_error());
	
	
	if(mysql_num_rows($res)>=1)
	{
		echo "<p align=\"center\">Feedback is already submited by '".$_POST['usn_no']."' usn for this subject.<br>Thank You</p>";
		echo "<meta http-equiv=Refresh content=3;url=javascript: history.go(-1)>";
		exit;
	}
	else
	{
		
		$sql_insert_usn="insert into usn (usn_no,b_id,sub_id,sem_id) values('".$_POST['usn_no']."','".$_POST['b_name']."','".$_POST['sub_name']."','".$_POST['sem_name']."')";
		mysql_query($sql_insert_usn) or die(mysql_error());
		$sql_insert="insert into feedback_master (b_id ,batch_id, feedback_no ,sem_id , f_id , sub_id , ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9, ans10, ans11, ans12, ans13, ans14, ans15, total, feed_date) values ('".$_POST['b_name']."','".$_POST['batch_name']."','".$result['feedback_no']."','".$_POST['sem_name']."','".$_POST['fac_name']."','".$_POST['sub_name']."','".$_POST['ans_1']."','".$_POST['ans_2']."','".$_POST['ans_3']."','".$_POST['ans_4']."','".$_POST['ans_5']."','".$_POST['ans_6']."','".$_POST['ans_7']."','".$_POST['ans_8']."','".$_POST['ans_9']."','".$_POST['ans_10']."','".$_POST['ans_11']."','".$_POST['ans_12']."','".$_POST['ans_13']."','".$_POST['ans_14']."','".$_POST['ans_15']."','".$_POST['total']."','".date('Y-m-d')."')";
		mysql_query($sql_insert) or die(mysql_error());
	?>
		<script type="text/javascript">deleteTab('Subject4');</script>
				<script type="text/javascript">deleteTab('Subject3');</script>
				<script type="text/javascript">deleteTab('Subject2');</script>
		<script type="text/javascript">deleteTab('Subject1');</script>

<?php		
}
}
?>


<?php
if(isset($_POST['submit4']))
{
	//feedback no
	$check_feedback_no="select * from batch_master where batch_id='".$_POST['batch_name']."'";
	$res_feedback_no=mysql_query($check_feedback_no) or die(mysql_error());
	$result=mysql_fetch_array($res_feedback_no);
	
	
	$sql="select * from usn where usn_no='".$_POST['usn_no']."' and b_id='".$_POST['b_name']."' and sub_id='".$_POST['sub_name']."' and sem_id='".$_POST['sem_name']."'";
	//echo $sql;
	$res=mysql_query($sql) or die(mysql_error());
	
	
	if(mysql_num_rows($res)>=1)
	{
		echo "<p align=\"center\">Feedback is already submited by '".$_POST['usn_no']."' usn for this subject.<br>Thank You</p>";
		echo "<meta http-equiv=Refresh content=3;url=javascript: history.go(-1)>";
		exit;
	}
	else
	{
		
		$sql_insert_usn="insert into usn (usn_no,b_id,sub_id,sem_id) values('".$_POST['usn_no']."','".$_POST['b_name']."','".$_POST['sub_name']."','".$_POST['sem_name']."')";
		mysql_query($sql_insert_usn) or die(mysql_error());
		$sql_insert="insert into feedback_master (b_id ,batch_id, feedback_no ,sem_id , f_id , sub_id , ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9, ans10, ans11, ans12, ans13, ans14, ans15, total, feed_date) values ('".$_POST['b_name']."','".$_POST['batch_name']."','".$result['feedback_no']."','".$_POST['sem_name']."','".$_POST['fac_name']."','".$_POST['sub_name']."','".$_POST['ans_1']."','".$_POST['ans_2']."','".$_POST['ans_3']."','".$_POST['ans_4']."','".$_POST['ans_5']."','".$_POST['ans_6']."','".$_POST['ans_7']."','".$_POST['ans_8']."','".$_POST['ans_9']."','".$_POST['ans_10']."','".$_POST['ans_11']."','".$_POST['ans_12']."','".$_POST['ans_13']."','".$_POST['ans_14']."','".$_POST['ans_15']."','".$_POST['total']."','".date('Y-m-d')."')";
		mysql_query($sql_insert) or die(mysql_error());
	?>
		<script type="text/javascript">deleteTab('Subject5');</script>
				<script type="text/javascript">deleteTab('Subject4');</script>
				<script type="text/javascript">deleteTab('Subject3');</script>
				<script type="text/javascript">deleteTab('Subject2');</script>
		<script type="text/javascript">deleteTab('Subject1');</script>


<?php		
}
}
?>



<?php
if(isset($_POST['submit5']))
{
	//feedback no
	$check_feedback_no="select * from batch_master where batch_id='".$_POST['batch_name']."'";
	$res_feedback_no=mysql_query($check_feedback_no) or die(mysql_error());
	$result=mysql_fetch_array($res_feedback_no);
	
	
	$sql="select * from usn where usn_no='".$_POST['usn_no']."' and b_id='".$_POST['b_name']."' and sub_id='".$_POST['sub_name']."' and sem_id='".$_POST['sem_name']."'";
	//echo $sql;
	$res=mysql_query($sql) or die(mysql_error());
	
	
	if(mysql_num_rows($res)>=1)
	{
		echo "<p align=\"center\">Feedback is already submited by '".$_POST['usn_no']."' usn for this subject.<br>Thank You</p>";
		echo "<meta http-equiv=Refresh content=3;url=javascript: history.go(-1)>";
		exit;
	}
	else
	{
		
		$sql_insert_usn="insert into usn (usn_no,b_id,sub_id,sem_id) values('".$_POST['usn_no']."','".$_POST['b_name']."','".$_POST['sub_name']."','".$_POST['sem_name']."')";
		mysql_query($sql_insert_usn) or die(mysql_error());
		$sql_insert="insert into feedback_master (b_id ,batch_id, feedback_no ,sem_id , f_id , sub_id , ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9, ans10, ans11, ans12, ans13, ans14, ans15, total, feed_date) values ('".$_POST['b_name']."','".$_POST['batch_name']."','".$result['feedback_no']."','".$_POST['sem_name']."','".$_POST['fac_name']."','".$_POST['sub_name']."','".$_POST['ans_1']."','".$_POST['ans_2']."','".$_POST['ans_3']."','".$_POST['ans_4']."','".$_POST['ans_5']."','".$_POST['ans_6']."','".$_POST['ans_7']."','".$_POST['ans_8']."','".$_POST['ans_9']."','".$_POST['ans_10']."','".$_POST['ans_11']."','".$_POST['ans_12']."','".$_POST['ans_13']."','".$_POST['ans_14']."','".$_POST['ans_15']."','".$_POST['total']."','".date('Y-m-d')."')";
		mysql_query($sql_insert) or die(mysql_error());
	?>
		<script type="text/javascript">deleteTab('Subject6');</script>
				<script type="text/javascript">deleteTab('Subject5');</script>
				<script type="text/javascript">deleteTab('Subject4');</script>
				<script type="text/javascript">deleteTab('Subject3');</script>
				<script type="text/javascript">deleteTab('Subject2');</script>
		<script type="text/javascript">deleteTab('Subject1');</script>

<?php		
}
}
?>
