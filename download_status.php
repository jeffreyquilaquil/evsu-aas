<html>
	<head>
		<style type="text/css">
			html{
				height: 90%;
			}
			*{
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
		</style>
	</head>
	<body>
		<h4 style='color:white'>List of Documents uploaded</h4>
		<table class='table table-condense'>
			<thead>
				<th width='40%' style='text-align:center'>File Name</th>
				<th width='15%' style='text-align:center'>Download Count</th>
				<th style='text-align:center'>Last Download by</th>
				<th style='text-align:center'>Last Download Date/Time</th>
			</thead>
			<tbody>
				<?php
				include 'db_conn.php';
				session_start();
					$userid=$_SESSION['user_id'];
					$download=new document();
					$download->download_status($userid);
				?>
			</tbody>
		</table>
	</body>
</html>