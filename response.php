<?
 
include("includes/config_db.php");
$f_id=$_GET['fac_name'];


$sel_para="select * from feedback_para";
$res_para=mysql_query($sel_para) or die(mysql_error());
$result_para=mysql_fetch_array($res_para);


$q=mysql_query("select * from subject_master  where sem_id=".$result_para['sem_id']." and  batch_id=".$result_para['batch_id']." and f_id=".$f_id);
echo mysql_error();
$myarray=array();
$str="";
while($nt=mysql_fetch_array($q)){
$str=$str . "\"$nt[sub_id]$nt[sub_name]\"".",";

}
$str=substr($str,0,(strLen($str)-1)); // Removing the last char , from the string
echo "new Array($str)";

?>