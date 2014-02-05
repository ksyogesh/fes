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
			  
			  $arr1=mysql_fetch_array($res);
			  $total_std=mysql_num_rows($res);
				
				if(mysql_num_rows($res)==0)
				{
					echo "No Record Found!";
					exit;
				}
				else
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
						$total_ans10=0;
						$total_ans11=0;
						$total_ans12=0;
						$total_ans13=0;
						$total_ans14=0;
						$total_ans15=0;
						
						
					   
						while($arr=mysql_fetch_array($result1))
						{		
											
								$total_ans1=$total_ans1 + $arr['ans1'];
								$total_ans2=$total_ans2 + $arr['ans2'];
								$total_ans3=$total_ans3 + $arr['ans3'];
								$total_ans4=$total_ans4 + $arr['ans4'];
								$total_ans5=$total_ans5 + $arr['ans5'];
								$total_ans6=$total_ans6 + $arr['ans6'];
								$total_ans7=$total_ans7 + $arr['ans7'];
								$total_ans8=$total_ans8 + $arr['ans8'];
								$total_ans9=$total_ans9 + $arr['ans9'];
								$total_ans10=$total_ans10 + $arr['ans10'];
								$total_ans11=$total_ans11 + $arr['ans11'];
								$total_ans12=$total_ans12 + $arr['ans12'];
								$total_ans13=$total_ans13 + $arr['ans13'];
								$total_ans14=$total_ans14 + $arr['ans14'];
								$total_ans15=$total_ans15 + $arr['ans15'];
														
						}
						  
						 
						  
						  
						  
					$graphTitle = "Faculty Name: ".faculty_name($arr1['f_id'])."  Subject: ".subject_name($arr1['sub_id'])."    Batch: ".batch_name($arr1['batch_id'])." ( Feedback ".$arr1['feedback_no']." )   Date: ".date('d-m-Y'); 
					
					$xLabel 	= "Matrix (Students ".$total_std.")"; 
					$yLabel 	= "Score"; 
					 
					$data['Punctuality'] = $total_ans1/$total_std;
					$data['Preparedness'] = $total_ans2/$total_std; 
					$data['Presentation'] = $total_ans3/$total_std; 
					$data['Methodology'] = $total_ans4/$total_std; 
					$data['Syllabus coverage'] = $total_ans5/$total_std; 
					$data['Motivating students'] = $total_ans6/$total_std; 
					$data['Discipline in class'] = $total_ans7/$total_std;
					$data['Discussion'] = $total_ans8/$total_std;
					$data['Clearing doubts'] = $total_ans9/$total_std;
					$data['IA ques paper']=$total_ans10/$total_std;
					$data['IA valuation']=$total_ans11/$total_std;
					$data['Discussing IA ques']=$total_ans12/$total_std; 
					$data['Assignments and quiz']=$total_ans13/$total_std;
					$data['Interest in class']=$total_ans14/$total_std;
					$data['Students realtionship']=$total_ans15/$total_std;
					 
					 //print_r($data);
					 //exit;
					//getting the maximum and minimum values for Y
					$newData = $data; 
					asort($newData); 
					 
					//minimum
					$places = strlen(current($newData));
					$mod    = pow(16, $places-1); 
					$min    = $mod - current($newData); 
					 
					//maximum
					$places = strlen(end($newData));
					$mod    = pow(16, $places-1);
					$max 	= $mod + end($newData); 
					
					$min=0;
					$max=16;
					
					$yAxis 	= array("min"=>0, "max"=> 16); 
					
					//------------------------------------------------
					// Preparing the Canvas
					//------------------------------------------------
					//setting the image dimensions
					$canvasWidth  = 1000; 
					$canvasHeight = 600; 
					$perimeter    = 50; 
					 
					//creating the canvas
					$canvas = imagecreatetruecolor($canvasWidth, $canvasHeight); 
					 
					//allocating the colors
					$white     = imagecolorallocate($canvas, 255, 255, 255); 
					$black     = imagecolorallocate($canvas, 0,0,0); 
					$yellow    = imagecolorallocate($canvas, 248, 255, 190);
					$blue      = imagecolorallocate($canvas, 3,12,94); 
					$grey      = imagecolorallocate($canvas, 102, 102, 102); 
					$lightGrey = imagecolorallocate($canvas, 216, 216, 216); 
					 
					//getting the size of the fonts
					$fontwidth  = imagefontwidth(2);
					$fontheight = imagefontheight(2); 
					 
					//filling the canvas with light grey
					imagefill($canvas, 0,0, $lightGrey); 
					//------------------------------------------------
					// Preparing the grid
					//------------------------------------------------
					//getting the size of the grid
					$gridWidth  = $canvasWidth  - ($perimeter*2); 
					$gridHeight = $canvasHeight - ($perimeter*2); 
					 
					//getting the grid plane coordinates 
					$c1 = array("x"=>$perimeter, "y"=>$perimeter);
					$c2 = array("x"=>$gridWidth+$perimeter, "y"=>$perimeter); 
					$c3 = array("x"=>$gridWidth+$perimeter, "y"=>$gridHeight+$perimeter); 
					$c4 = array("x"=>$perimeter, "y"=>$gridHeight+$perimeter);
					 
					 
					//------------------------------------------------
					//creating the grid plane 
					//------------------------------------------------
					imagefilledrectangle($canvas, $c1['x'], $c1['y'], $c3['x'], $c3['y'], $white);  
					 
					//finding the size of the grid squares
					$sqW = $gridWidth/count($data); 
					$sqH = $gridHeight/$yAxis['max']; 
					 
					//------------------------------------------------ 
					//drawing the vertical lines and axis values
					//------------------------------------------------
					$verticalPadding = $sqW/2; 
					foreach($data as $assoc=>$value)
					{	
						//drawing the line
						//imageline($canvas, $verticalPadding+$c4['x']+$increment, $c4['y'], $verticalPadding+$c1['x']+$increment, $c1['y'], $black);
					 
						//axis values
						$wordWidth = strlen($assoc)*$fontwidth; 
						$xPos = $c4['x']+$increment+$verticalPadding-($wordWidth/2); 
						ImageString($canvas, 2, $xPos, $c4['y'], $assoc, $black);
					 
						$increment += $sqW;
					}
					 
					//------------------------------------------------ 
					//drawing the horizontel lines and axis labels
					//------------------------------------------------
					//resetting the increment back to 0
					$increment = 0; 
					 
					for($i=$yAxis['min']; $i<=$yAxis['max']; $i++)
					{
					 
						//main lines
					 
							//often the y-values can be in the thousands, if this is the case then we don't want to draw every single
							//line so we need to make sure that a line is only drawn every 50 or 100 units. 
						//change by shrenik $i%$mod==0
						//if($i%$mod==0){
							//drawing the line
							imageline($canvas, $c4['x'], $c4['y']+$increment, $c3['x'], $c3['y']+$increment, $black);
					 
							//axis values
							$xPos = $c1['x']-($fontwidth*strlen($i))-5; 
							ImageString($canvas, 2, $xPos, $c4['y']+$increment-($fontheight/2), $i, $black);
					 
						//}
						//tics
						//these are the smaller lines between the longer, main lines. 
						//elseif(($mod/5)>1 && $i%($mod/5)==0)
						//{
						//	imageline($canvas, $c4['x'], $c4['y']+$increment, $c4['x']+10, $c4['y']+$increment, $grey);
						//}
						//because these lines begin at the bottom we want to subtract
						$increment-=$sqH; 
					}
					//------------------------------------------------
						// Making the vertical bars
						//------------------------------------------------
						$increment = 0; 		//resetting the increment value
						$barWidth = $sqW*.2; 	//setting a width size for the bars, play with this number
						foreach($data as $assoc=>$value)
						{
							$yPos = $c4['y']-($value*$sqH);
							$xPos = $c4['x']+$increment+$verticalPadding-($barWidth/2); 
							imagefilledrectangle($canvas, $xPos, $c4['y'], $xPos+$barWidth, $yPos, $grey); 
							$increment += $sqW; 
						}
					 
					
					 
					//Graph Title
					ImageString($canvas, 2, ($canvasWidth/2)-(strlen($graphTitle)*$fontwidth)/2, $c1['y']-($perimeter/2), $graphTitle, $green); 
					 
					//X-Axis
					ImageString($canvas, 2, ($canvasWidth/2)-(strlen($xLabel)*$fontwidth)/2, $c4['y']+($perimeter/2), $xLabel, $green); 
					 
					//Y-Axis
					ImageStringUp($canvas, 2, $c1['x']-$fontheight*3, $canvasHeight/2+(strlen($yLabel)*$fontwidth)/2, $yLabel, $green); 
					
					  
					header("content-type: image/jpg"); 
					imagejpeg($canvas,'images/feedback_graph.jpg'); 
					imagedestroy($canvas); 
					
					
				}
		}
?>
