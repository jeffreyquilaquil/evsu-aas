
<?php
include_once 'db_conn.php';
	if(isset($_POST['login'])){
		extract($_REQUEST);
		$user = new user();
		$result=$user->check_user($uname, $pword);
	}
?>

<!doctype HTML>
<html>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome/css/font-awesome.min.css">

	<script type="text/javascript" src='js/jquery.js'></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src='js/tendina.min.js'></script>
	<script type="text/javascript" src='js/validate.js/jquery.validate.js'></script>
	<script type="text/javascript" src='js/validate.js/additional-methods.js'></script>
	<script type="text/javascript" src="js/datatable/jquery.dataTables.js"></script>

	<script type="text/javascript" src='js/script.js'></script>


	  <link rel="stylesheet" href="css/style-test.css">
       <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

	<head>
		<title>Login Page</title>
	</head>
	<body style="backround-image:url('images-slider/structured.archiving.jpg')">
		<div id='menu'>
			<div>

				<div class="pull-left" style='color:white;font-size:25px;margin-top:10px;margin-left:-20px;font-family:Matura MT Script Capitals;text-shadow: 2px 2px 4px #000000;'><img src="images-slider/EVSULogo.png" style="height:30px;width:30px;">
					EVSU-CC Quality Assurance Archiving System
				</div>

			</div>
		</div>
	<div class='pull-left'>
		<img src="css/Banner.png" alt="" style="width:100%;margin-top:50px;margin-left:-170px;float:left;">
	</div>

	<div class="login">
		<h1 style="	font-family: Winter Brush Demo;">Login</h1>
	    <form name='frm_login' method='POST' action="">
	    	<input class="" type="text" name="uname" placeholder="Username" required="required" />
	        <input class="" type="password" name="pword" placeholder="Password" required="required" />
	        <button name="login"
	        type="submit" class="btn btn-primary btn-block btn-large">Let me in.</button>
	    </form>
  </div>


  	<div class="ft-slider" syle="margin-top:500px;">
  			<div id='carousel' class="carousel slide" data-ride="carousel">
						<div class="carousel-inner" style="color:white">
							<div class="item active">
								<img src="images-slider/DataArchiving.png" alt="DataArchiving" style="height:300px;width:100%;margin-top:180px;float:left;">
								<p><b>Eastern Visayas State University Carigara-Campus | AACUP 2016</b></p>
							</div>

								<div class="item">
								<img src="images-slider/archiving-banner.png" alt="DataArchive" style="height:300px;width:100%;margin-top:180px;float:left;">
								<p><b>Eastern Visayas State University Carigara-Campus | AACUP 2016</b></p>
							</div>


							<div class="item">
								<img src="images-slider/DataArchive.jpg" alt="DataArchive" style="height:300px;width:100%;margin-top:180px;float:left;">
								<p><b>Eastern Visayas State University Carigara-Campus | AACUP 2016</b></p>
							</div>

							<div class="item">
								<img src="images-slider/cloudarchive.jpg" alt="cloudarchive" style="height:300px;width:100%;margin-top:180px;float:left;">
								<p><b>Eastern Visayas State University Carigara-Campus | AACUP 2016</b></p>
							</div>

							<div class="item">
								<img src="images-slider/Folder-Archive.jpg" alt="Folder-Archive" style="height:300px;width:100%;margin-top:180px;float:left;">
								<p><b>Eastern Visayas State University Carigara-Campus | AACUP 2016</b></p>
							</div>

							<div class="item">
								<img src="images-slider/Webarch-cloud.jpg" alt="Webarch-cloud" style="height:300px;width:100%;margin-top:180px;float:left;">
								<p><b>Eastern Visayas State University Carigara-Campus | AACUP 2016</b></p>
							</div>

							<div class="item">
								<img src="images-slider/Archive.jpg" alt="Archive" style="height:300px;width:100%;margin-top:180px;float:left;">
								<p><b>Eastern Visayas State University Carigara-Campus | AACUP 2016</b></p>
							</div>

							<div class="item">
								<img src="images-slider/D-Archiving.jpg" alt="D-Archiving" style="height:300px;width:100%;margin-top:180px;float:left;">
								<p><b>Eastern Visayas State University Carigara-Campus | AACUP 2016</b></p>
							</div>

						</div>
					</div>

  	</div>

	<head>
		<title>Login Page</title>

		<style>
			.login-pane{
				height:40%;
				width:40%;

				margin-top:10%;
				margin-left:55%;

				border-radius:15px;
				border:3px solid blue;
			}
			.input_div > input{
				width:80%;
			}
		</style>
	</head>
	<body>
		<div id='menu'>
			<div>
				<div class="pull-left" style='color:white;font-size:17px;margin-top:10px;margin-left:-20px;'><img src="css/evsu-logo.png">
					EVSU-CC Quality Assurance Archiving System
				</div>
				<div class='pull-right'>
					<form name='frm_login' method='POST' action="">
						<input class='lg-ip' type="text" placeholder="Username" name="uname" required>
						<input class='lg-ip' type="password" placeholder="Placeholder" name="pword">
						<button name='login'>Login</button>
					</form>
				</div>
			</div>
		</div>

	</body>
</html>
