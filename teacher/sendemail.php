<?php
	session_start();
	if (isset ($_SESSION['TeacherID']))//checking if session is already maintained
{
?>
<!DOCTYPE html><!-- Html5 supported Pages -->

<html xmlns="http://www.w3.org/1999/xhtml">  <!-- according to standards of w3.org -->
<head>
	<title> Send Email</title> <!--title of the page -->
	<?php include"../common/library.php"; ?><!-- common libraries includes CSS and java scripting -->
	
</head>
	<?php
		if(is_numeric($_GET['ErrorID']))//getting message ids from action file
		$error=$_GET['ErrorID'];//posting it to a variable after checking is it numeric or not
		switch($error){
			case 1://message 1 case
				echo'<script type="text/javascript">alert("Error: Empty field are not allowed.");</script>';//showing the alert box to notify the message to the user
				break;
			case 5://message 5 case
				echo'<script type="text/javascript">alert("Success: Message successfully dilevered.");</script>';//showing the alert box to notify the message to the user
				break;
		}
	?>
<body>
	<?php 
		include"teacherheader.php";//<!--side bar menu for the Student -->
	    include_once("../common/commonfunctions.php"); //including Common function library
	    include_once("../common/config.php"); //including Common function library
		
		$profileID=$_SESSION['TeacherID'];//unsafe variable
		$id=clean($profileID);//cleaning id to preven SQL Injection
			
		//checking either registeration is opened or not
		$unsafe="RegisterCourse";
		$courseRegisteration=clean($unsafe);
		
		$unsafe="Open";
		$status=clean($unsafe);
		
		$res = mysql_query("SELECT * FROM `criteria` WHERE `Entity` ='$courseRegisteration' AND `Value`='$status'");//SELECTING THE user records 
		$row = mysql_fetch_array($res);//fetching record as a set of array of selected user
		if($row)
		{
	?>	
			<div class="inlineSetting">
			<h4 class="alert_success">Course Registeration is Open. No Sections Assigned Yet.</h4>
			</div>
	<?php } 
	else
		{
	?>
	<article class="module width_full">
			<header><h3>&nbsp;&nbsp;&nbsp;Email Notification:</h3></header>
			<div class="module_content"><!-- Showing the notification form for sending alert to the users of the system-->
					<div>
						<form method="POST" action="send_email_action.php">
						<table width="100%" align="center">
							<tr>
								<td style="font-weight:bold; font-size:15px;">Select Class: </td>
								<td>
									<select name="toClass" id="toClass"><!--Generate a List of classes of Current Semester -->
										<?php
											$sql=mysql_query("SELECT DISTINCT section.SectionID, class.SubjectID, discipline.DisciplineCode, section.Semester, section.SectionCode " .
													"FROM subjecttoteach JOIN class JOIN section JOIN discipline " .
													"ON subjecttoteach.ClassID = class.ClassID " .
													"AND class.SectionID = section.SectionID " .
													"AND section.DisciplineID = discipline.DisciplineID " .
													"WHERE subjecttoteach.TeacherID = '".$id."'");
											while($row=mysql_fetch_array($sql))
											{
												echo "<option value='$row[SectionID].$row[SubjectID]'>".$row['DisciplineCode']."-".$row['Semester']."(".$row['SectionCode'].")"."</option>";
											}
										?>
									</select>
								</td><!--Selecting the Teacher to send notification -->
							</tr>
							
							<tr>
								<td style="font-weight:bold; font-size:15px;">Details: <font color="red">*</font></td>
								<td>
									<textarea rows="15" cols="50" name="notificationDetails" id="notificationDetails" required></textarea>
								</td><!--Teacher Will Write Message Here-->
							</tr>
							
							<tr>
								<td colspan="2" align="center"><input type="submit" value="SEND"></td>
							</tr>
						</table>
						</form>
					</div>
			</div>
	</article><!-- end of stats article -->
<?php } ?>
</body>

</html>
<?php
}
else
	{
		include_once("../common/commonfunctions.php"); //including Common function library
		
		redirect_to("../clogin.php?msg=Login First!");//redirecting toward login page if session is not maintained
	}
?>
