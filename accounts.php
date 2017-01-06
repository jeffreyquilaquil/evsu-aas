<?php
include_once 'db_conn.php';
session_start();
$user=new user();
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
			table{
				border: 2px solid white;
				width: 100%;
			}
			th, td{
				border:2px solid white;
				border-left: none;
				border-right: none;
				text-align: center;
			}
			td button{
				border: 1px solid white;
				background: none;
			}
			.btn-default{
				border: 2px solid white;
				background: black;
				color:white;
				margin-right: 15px;
				margin-top: -5px;
			}
		</style>
	</head>
	<body>
		<h4>List of Accounts</h4>
		<a href='register.php'><button class='pull-right btn btn-default'>Register Account</button></a>
		<br><br>
		<table class='table table-condense'>
			
				<th width='30%'>Name</th>
				<th>Username</th>
				<th>Area Assigned</th>
				<th>User type</th>
				<th>Status</th>
				<th>Action</th>
			</thead>
			<tbody>
				<?php
					$user->user_list();
				?>
			</tbody>
		</table>
	</body>
</html>