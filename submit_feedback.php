<?php
 
include("includes/config_db.php");

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
		echo "<meta http-equiv=Refresh content=3;url=Login.php>";
		exit;
	}
	else
	{
		
		$sql_insert_usn="insert into usn (usn_no,b_id,sub_id,sem_id) values('".$_POST['usn_no']."','".$_POST['b_name']."','".$_POST['sub_name']."','".$_POST['sem_name']."')";
		mysql_query($sql_insert_usn) or die(mysql_error());
		$sql_insert="insert into feedback_master (b_id ,batch_id, feedback_no ,sem_id , f_id , sub_id , ans1, ans2, ans3, ans4, ans5, ans6, ans7, ans8, ans9, ans10, ans11, ans12, ans13, ans14, ans15, total, feed_date) values ('".$_POST['b_name']."','".$_POST['batch_name']."','".$result['feedback_no']."','".$_POST['sem_name']."','".$_POST['fac_name']."','".$_POST['sub_name']."','".$_POST['ans_1']."','".$_POST['ans_2']."','".$_POST['ans_3']."','".$_POST['ans_4']."','".$_POST['ans_5']."','".$_POST['ans_6']."','".$_POST['ans_7']."','".$_POST['ans_8']."','".$_POST['ans_9']."','".$_POST['ans_10']."','".$_POST['ans_11']."','".$_POST['ans_12']."','".$_POST['ans_13']."','".$_POST['ans_14']."','".$_POST['ans_15']."','".$_POST['total']."','".date('Y-m-d')."')";
		mysql_query($sql_insert) or die(mysql_error());
		echo "<p align=\"center\">Feedback is submited successfully!<br>You'll be redirected to your page to submit feedback for rest of your subjects after (3) Seconds</p>";
        echo "<meta http-equiv=Refresh content=2;url=index.php>";
		exit;
	}
}





?>