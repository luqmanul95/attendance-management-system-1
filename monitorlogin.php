<?php

	session_start();

	include_once("common/commonfunctions.php"); //including Common function library



	if (isset ($_SESSION['TeacherID']))//checking if session is already maintained

	{

		redirect_to("teacher/index.php");//redirecting toward login page if session is not maintained

	}

	

	//if any message from other page is recieved

	//$msg=$_GET['msg'];

?>

<!DOCTYPE html>

<html lang="en">

    <head>

		<meta charset="UTF-8" />

        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 

		<title>Class Monitor Login</title>

        <link rel="stylesheet" type="text/css" href="css/loginstyle.css" />

		<script src="js/login/modernizr.custom.63321.js"></script>

		<!--[if lte IE 7]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->

		<link rel="shortcut icon" href="images/favicon.ico" /><!-- inserting the favicon for the site -->

    </head>

    <body>

        <div class="container">

			<header>

				<h1><strong>MSIS</strong> Login</h1> <!--Heading of the Page -->

				<h2>Login for Class Monitor</h2> <!-- User Types who can login through this form -->

			</header>

			

			<section class="main"> <!--main panel of the page -->

				<form class="form-1" method="POST" action="monitorloginaction.php">

					<p class="field"> <!--username field -->

						<input type="email" name="userLogin" id="userLogin" placeholder="Username" required/>

						<i class="icon-user icon-large"></i> <!-- user logo -->

					</p>

						<p class="field"><!--Password field -->

							<input type="password" name="userPassword" id="userPassword" placeholder="Password" required/>

							<i class="icon-lock icon-large"></i> <!--password logo -->

					</p>

					<br/>

					<p style="color:red;text-align:center"><?php if(isset($_GET['msg'])) echo $m=$_GET['msg'];?></p><!--for Mentioning Errors-->

					<br/>

					<br/>

					<p class="submit">

						<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button> <!-- Submit Form Button -->

					</p>
					
					<p align="center">

						<a href="#"><font color="grey"><u>Forget Password</u></font></a>

					</p>
					

				</form>

			</section>

        </div>

    </body>

</html>