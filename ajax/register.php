<?php
include '../db_conn.php';
$user=new user();
$unames=$user->get_unames();
?>
<html>
	<head>
		<style type="text/css">
			tr{
				border:none;
			}
			.input_label{
				border-top: none;
				padding-top: 0px;
				border-bottom: solid 2px rgb(31, 109, 211);;
				width: 200px;
				margin-bottom: -10px;
			}
		</style>
	</head>
	<body>
		<form action="" method="POST" id="reg_form" name="reg_form">
			<table class='table table-condense'>
				<tr >
					<td style='border:none;'>
						<label class="input_label">Firstname</label>
					</td>
					<td style='border:none;'>
						<label class="input_label">Lastname</label>
					</td>
					<td style='border:none;'>
						<label class="input_label">Username</label>
					</td>
				</tr>
				<tr >
					<td style='border:none;'>
						<input name='fname' required class='form-control' id='fn'>
					</td>
					<td style='border:none;'>
						<input name='lname' required class='form-control' id='ln'>
					</td>
					<td style='border:none;'>
						<input name='uname' required class='form-control' onblur='check_uname()' id='un'>
						<label id='unameCheck_err' for='uname' style='display:none'>Username no longer available.</label>
					</td>
				</tr>
				<tr >
					<td style='border:none;'>
						<label class='input_label'>Type</label>
					</td>
					<td style='border:none;'>
						<label class="input_label">Area</label>
					</td>
					<td style='border:none'>
						<label class='input_label'>Password</label>
					</td>
				</tr>
				<tr >
					<td style='border:none;'>
						<select name='utype' class="form-control utype" id='ut'>
							<option value="2">Chairman</option>
							<option value="1">Administrator</option>
						</select>
					</td>
					<td style='border:none;'>
						<select name="area" class="form-control" id='ua'>
							<?php
								$user->get_areas();
							?>
						</select>
					</td>
					<td style='border:none;'>
						<input type="password" name="pword" class='Form-control' required id='pw'>
					</td>
				</tr>
				<tr >
					<td style='border:none;'>
						<label class='input_label'>Secret Question</label>
					</td>
					<td style='border:none;'>
						<label class="input_label">Secret Answer</label>
					</td>
				</tr>
				<tr >
					<td style='border:none;'>
						<select class='form-control' name='sc_q' id='sq'>
							<?php
								$user->get_questions();
							?>
						</select>
					</td>
					<td style='border:none;'>
						<input type='text' name="sc_a" required class="form-control" id='sa'>
					</td>
					<td style='border:none;'>
						<button type='button' class='btn btn-info pull-right form-control' id="btn_form" onclick="check_form()">Done</button>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>