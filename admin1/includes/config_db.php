<?php

//configuration file
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';//password
$dbname = 'feedback';


$databasehost = $dbhost;
$databaseusername =$dbuser;
$databasepassword = $dbpass;
$databasename = $dbname;

$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
mysql_select_db($dbname) or die("database not available");






function branch_name($b_id)
{
	$sel_b="select * from branch_master where b_id=".$b_id;
	$res=mysql_query($sel_b) or die(mysql_error());
	$b_name=mysql_fetch_array($res);
	return $b_name['b_name'];
}

function batch_name($batch_id)
{
	$sel_b="select * from batch_master where batch_id=".$batch_id;
	$res=mysql_query($sel_b) or die(mysql_error());
	$b_name=mysql_fetch_array($res);
	return $b_name['batch_name'];
}


function sem_name($sem_id)
{
	$sel_s="select * from semester_master where sem_id=".$sem_id;
	$res=mysql_query($sel_s) or die(mysql_error());
	$s_name=mysql_fetch_array($res);
	return $s_name['sem_name'];
}

function subject_name($sub_id)
{
	$sel_s="select * from subject_master where sub_id=".$sub_id;
	$res=mysql_query($sel_s) or die(mysql_error());
	$s_name=mysql_fetch_array($res);
	return $s_name['sub_name'];
}

function faculty_name($f_id)
{
	$sel_s="select * from faculty_master where f_id=".$f_id;
	$res=mysql_query($sel_s) or die(mysql_error());
	$s_name=mysql_fetch_array($res);
	return $s_name['f_name'].' '.$s_name['l_name'];
}


function tep_draw_pull_down_menu($name, $values, $default = 1, $parameters = '', $required = false) {


    $field = '<select name="' . $name . '"';

    if ($parameters!='') $field .= ' ' . $parameters;

    $field .= ' >';

	$field .='<option value=0></option>';
    for ($i=0, $j=0,$n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . $values[$i]['id'] . '"';
	  if ($default == $values[$i]['id']) {
      //if ($default[$j] == $values[$i]['id']) {
	  	$j++;
        $field .= ' SELECTED';
      }

      $field .= ' $str >' .$values[$i]['text'] . '</option>';
    }
    $field .= '</select>';

    //if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }
  
  
function tep_draw_pull_down_menu_sub($name, $values, $default = '10', $parameters = '', $required = false) {


    $field = '<select name="' . $name . '"';

    if ($parameters!='') $field .= ' ' . $parameters;

    $field .= ' >';

	$field .='<option value=0></option>';
    for ($i=0, $j=0,$n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . $values[$i]['id'] . '"';
      if ($default == $values[$i]['id']) {
	    $j++;
        $field .= ' SELECTED';
      }

      $field .= ' $str >' .$values[$i]['text'] . '</option>';
    }
    $field .= '</select>';

    //if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }  
?>