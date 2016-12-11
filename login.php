
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
		<div id='container' >
			<div class="login-pane">
				<div class="input_div">
					<input type="text"  placeholder="Username" name="uname" required>
					<i></i>
				</div>	
				<div class="input_div">
					<input type="text" placeholder="Password" name="pword">
					<i></i>
				</div>			
			</div>	
		</div>
	</body>
</html>
