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
<title>Report</title>
</head>

<body>
<table width="100%" cellpadding="0" cellspacing="0">
<tr>
<td> 
<img src="images/feedback_graph.jpg" width="100%" height="100%" />
</td>
</tr>
<tr><td align="left"><br/>Remark(s):-<br/></td></tr>
<tr>
<td>
<?php
	  error_reporting( error_reporting() & ~E_NOTICE );
	

      $str= base64_decode( $_GET['str'] ); 
	  //echo $str;
	  if($str=='select * from feedback_master order by feed_date asc')
	  {
	  	echo "Input is not correct";
		exit;
	  }
	  else
	  { 
	  	        $res=mysql_query($str) or die(mysql_error());
			    //$result=mysql_fetch_array($res);
			  
			    //$arr1=mysql_fetch_array($res);
			    //$total_std=mysql_num_rows($res);
			    $remark_count=0;	
				if(mysql_num_rows($res)==0)
				{
					echo "No Record Found!";
					exit;
				}
				else
				{
					while($arr=mysql_fetch_array($res))
					{
						if($arr['remark']!=NULL)
						{	
						  $arr_remark[$remark_count]=$arr['remark'];
						  $remark_count++;
						}	
					}
				}
		}
		echo '<table width=100% border=0>';
		$j=0;
		
		for($row=0;$row<($remark_count)/4;$row++)
		{
			echo '<tr>';			
			for($col=0;$col<4;$col++)
			{	
				if($arr_remark[$j]!=NULL)
				{
					echo '<td>'.'&nbsp;'.$arr_remark[$j].'</td>';
					$j++;
				}
			}
			echo '</tr>';
		}
		echo '</table>';
?>
</td>
</tr>
</table>
</body>
</html>
