 <?php
	include'db_conn.php';
	$user = new user();
	$unames=$user->get_unames();
	if (isset($_POST['uname'])) {
		extract($_REQUEST);
		
		echo "<script type='text/javascript'>alert_message('User has just been registered', 'accounts.php'); </script>";
	}
?>
<html>
	<head>
		<style type="text/css">
			html{
				height: 90%;
			}
			*, h4{
				color:white;
			}
			form *{
				background: black;
			}
			.input_label{
				border-top:none;
				padding-top: 0px;
				border-bottom: solid 2px white;
				width: 150px;
			}
			.form-control{
				background: black;
				border: 2px solid white;
				color:white;
				outline: none;
			}
			button{
				background: black;
				color: white;
				border: 2px solid white;
			}
		</style>
	</head>
	<body>
		<form id='reg_form' name='reg_form' method="POST" action="">
			<table class='table table-condense'>
				<tr>
					<td><label class='input_label'>Firstname</label></td>
					<td><label class='input_label'>Lastname</label></td>
					<td><label class='input_label'>Username</label></td>
					<td><label class='input_label'>Password</label></td>
				</tr>
				<tr>
					<td><input type='text' name='fname' required class='form-control'></td>
					<td><input type='text' name='lname' required class='form-control'></td>
					<td>
						<input type='text' name='uname' onblur='check_uname()' required class='form-control'>
						<label id='unameCheck_err' for='uname' style='display:none;'>Username no longer available.</label>
					</td>
					<td><input type='password' name='pword' required id='pword' class='form-control'></td>
				</tr>
				<tr>
					<td><label class='input_label'>User type</label></td>
					<td><label class='input_label'>Area</label></td>
					<td><label class='input_label'>Secret Question</label></td>
					<td><label class='input_label'>Secret Answer</label></td>
				</tr>
				<tr>
					<td>
						<select name='utype' onChange="change_type()" id='utype' class='form-control'>
							<option value='2'>Chairman</option>
							<option value='1'>Administrator</option>
						</select>
					</td>
					<td>
						<select name='area' id='sel_area' class='form-control'>
							<?php
								$user->get_areas();
							?>
						</select>
					</td>
					<td>
						<select name='sc_question' class='form-control'>
							<option>Question 1</option>
							<option>Question 2</option>
							<option>Question 3</option>
							<option>Question 4</option>
						</select>
					</td>
					<td><input type='text' name='sc_answer' required class='form-control'></td>
				</tr>
				<tr>
					<td colspan='4'><button class='btn btn-default pull-right' type='button' id='btn_reg' onclick='check_form()'>Register</button></td>
				</tr>
			</table>
		</form>
	</body>
</html>
<script type="text/javascript">
	var uname_arr = <?php echo json_encode($unames); ?>;
	uname_arr=uname_arr.split(',');
	function check_uname(){
		var new_uname=$("input[name='uname']").val();
		var regex = new RegExp('^'+new_uname+'$','i');
		$.each(uname_arr,function(index, value){
		if (regex.test(value)) {
			form_check=false;
			return false;	
			}else{
			form_check=true;
			return true;
			}
		});
	}

	

	function check_form(){
		if ($('#reg_form').valid()) {
			if (form_check) {
				$('#unameCheck_err').css('display','none');
				$('#reg_form').submit();
			}else{
				$('#unameCheck_err').css('display','block');
			}
		};
	}
</script>