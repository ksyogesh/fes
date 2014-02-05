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
session_start();
if(!isset($_SESSION['myusername']))
{
	
	header("location:login3.php");
	echo "Please login with USN and password";
}
//if(!session_is_registered("myusername")){
//header("location:login8.php");
//}
?>
