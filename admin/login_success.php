<?php 
  
include('session_chk.php');?>
<html>
<title>Admin Home</title>
<link rel="stylesheet" type="text/css" href="../includes/style.css" />
<body>
<table width="64%" align="center" border="0" cellpadding="0" cellspacing="1" >
<?php include('admin_panel_heading.php'); ?>
<tr>
<td width="22%">
<? include('left_side.php');?></td>

<td width="78%" valign="top">
<p><br/>
Feedback system:</p>
<p>Structure of the institute  </p>
<p>Batch -> Branch -> Faculty -> Subject  </p>
<p>So You can Add/Edit/Delete to Batch, Branch, Faculty & Subject</p>
<p>Example:</p>
<p><ul>
		<li>Batch: 2008  </li>
<li>Branch: CS  </li>
<li>Faculty: <ul><li>Mr.Chethan.K.C </li><li>Mr.Raghu.M.E</li></ul>  </li>
<li>Subject: <ul><li>Computer Graphics by Chethan.K.C</li>
                <li>Compiler Design by Raghu.M.E </li>
			</ul></li>
</ul>
<p>Set parameter: Batch -> Brach -> Semester </p>
<p>To get the result(graph/excel) click on &quot;<strong>Feedback</strong>&quot; link.  </p>
<p>Feedback Ques: You can change  by editing it.  </p>
<p>Students will rate the Subject's faculty within the range of 0 - 10</p>
<p>Graph will be generated according to the number of student and their rating. on "<b>Feedback</b>" </p></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td valign="top">&nbsp;</td>
</tr>
</table>

</body>
</html>