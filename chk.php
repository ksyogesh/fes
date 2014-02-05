<?php
/*
 * chk.php
 * 
 * Copyright 2012 ShivaYogi <ShivaYogi@SHIVAYOGI-PC>
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
 * MA 02110-1301, USA.
 * 
 * 
 */

?>
<?php 
include("includes/config_db.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="includes/style.css" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script> 
<script src="http://malsup.github.com/jquery.form.js"></script> 
 
 <script> 
 
 $('submit').click(function() {
    $('myForm').each(function() {
        $.post(this.action, $form.serialize());
    });
})
 
 /*
// prepare the form when the DOM is ready 
$(document).ready(function() { 
    var options = { 
        target:        '#output2',   // target element(s) to be updated with server response 
        beforeSubmit:  showRequest,  // pre-submit callback 
        success:       showResponse  // post-submit callback 
 
        // other available options: 
        //url:       url         // override for form's 'action' attribute 
        //type:      type        // 'get' or 'post', override for form's 'method' attribute 
        //dataType:  null        // 'xml', 'script', or 'json' (expected server response type) 
        //clearForm: true        // clear all form fields after successful submit 
        //resetForm: true        // reset the form after successful submit 
 
        // $.ajax options can be used here too, for example: 
        //timeout:   3000 
    }; 
 
    // bind to the form's submit event 
    $('#myForm').submit(function() { 
        // inside event callbacks 'this' is the DOM element so we first 
        // wrap it in a jQuery object and then invoke ajaxSubmit 
        $(this).ajaxSubmit(options); 
 
        // !!! Important !!! 
        // always return false to prevent standard browser submit and page navigation 
        return false; 
    }); 
}); 
 
// pre-submit callback 
function showRequest(formData, jqForm, options) { 
    // formData is an array; here we use $.param to convert it to a string to display it 
    // but the form plugin does this for you automatically when it submits the data 
    var queryString = $.param(formData); 
 
    // jqForm is a jQuery object encapsulating the form element.  To access the 
    // DOM element for the form do this: 
    // var formElement = jqForm[0]; 
 
    alert('About to submit: \n\n' + queryString); 
 
    // here we could return false to prevent the form from being submitted; 
    // returning anything other than false will allow the form submit to continue 
    return true; 
} 
 
// post-submit callback 
function showResponse(responseText, statusText, xhr, $form)  { 
    // for normal html responses, the first argument to the success callback 
    // is the XMLHttpRequest object's responseText property 
 
    // if the ajaxSubmit method was passed an Options Object with the dataType 
    // property set to 'xml' then the first argument to the success callback 
    // is the XMLHttpRequest object's responseXML property 
 
    // if the ajaxSubmit method was passed an Options Object with the dataType 
    // property set to 'json' then the first argument to the success callback 
    // is the json data object returned by the server 
 
    alert('status: ' + statusText + '\n\nresponseText: \n' + responseText + 
        '\n\nThe output div should have already been updated with the responseText.'); 
} */
 </script> 

</head>

<body>
<p>&nbsp;</p>
<p>&nbsp;</p>
<table width="500" border="0" align="center">

<form id="myForm" method="post" action="checklogin8.php" name="stud_login" onsubmit="return chkForm();">
<input type="hidden" name="para_id" value="<? echo $para_id?>">
<table width="65%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#FFFFFF">
<tr>
<td colspan="3" align="center"><font size="5" ><strong>Faculty Evaluation System </strong></font></td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td colspan="3" align="center"><font size="3" ><strong>Student Login </strong></font></td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td width="205" ><div align="right">USN</div></td>
<td width="3"><div align="center">:</div></td>
<td width="268">
  <div align="left">
    <input name="myusername" type="text" tabindex="1" align="left"/>
  </div></td>
</tr>
<tr>
<td><div align="right">Password</div></td>
<td><div align="center">:</div></td>
<td>
  <div align="left">
    <input name="mypassword" type="password" tabindex="2" id="mypassword">
  </div></td>
</tr
<tr>
<td><div align="right"></div></td>
<td><div align="center"></div></td>
<td>
  <div align="left">
    <input type="submit" name="submit" value="Login" class="button">
  </div></td>
</tr>
</table>
</form>

</td>
</tr>
<tr><td colspan="3" align="center"><?php include("footer.php"); ?></td></tr>
</table>
</body>
</html>
<script language="javascript" type="text/javascript">

function chkForm(form)
{
		var RefForm = document.stud_login;
		
		if (RefForm.myusername.value.length == 0 )
		{
			alert("Enter USN.");	
			RefForm.usn_no.focus();				
			return false;
		}
		if (RefForm.myusername.value.length != 10 )
		{
			alert("Enter USN correctly.");	
			RefForm.usn_no.focus();				
			return false;
		}
		
}
</script>

