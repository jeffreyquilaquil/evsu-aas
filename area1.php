<?php
include'db_conn.php';
session_start();
$area=1;
$document=new document();
?>
<html>
	<head>
		<style type="text/css">
			html{
				height: 90%;
			}
			body{
				background-color:white;
			}
			table{
				width: 100%;
			}
			th{
				text-align: center;
				border: 2px solid white;
				border: 2px grey solid;
			}
			tr:hover{
				border: rgb(184, 214, 251) solid 2px;
			}
			td{
				padding: 3px;
			}
			.outer_cont{
				height: 180px;
				width: 160px;
				border-radius: 3px;
				padding:3px;
				font-size: 13px;
			}
			.outer_cont > p{
				font-size: 10px;
				height: 35px;
			}
			.div_button{
				color:white;
			}
			.div_button:hover, .div_button:visited{
				text-decoration: none;
				color: white;
			}
			.div_button > button{
				border: 1px solid white;
				background: none;
				float: right;
			}
			.icon_div{
				height: 100px;
				text-align: center;
			}
			.icon_div > p{
				
			}
			.fa{
				font-size: 50px;
			}

/*			.outer_cont{
				height: 150px;
				width: 135px;
				display: inline-block;
				cursor: pointer;
				border-radius: 5px;
				padding: 10px;
			}
			.icon_div button{
				border: 1px solid white;
				background: none;
				margin-bottom: -55px;
				height: 20px;
				width: 100px;
				padding: 2px;
			}
			td{
				margin: 12px;
				padding: 7px;
				padding-bottom: 20px;
			}
			.rest{
				font-size: 10px;
			}*/
		</style>
	</head>
	<body>
		<h4>Area 1</h4>
		<table>
			<thead>
				<th width='55%'>Name</th>
				<th width="15%">Date Uploaded</th>
				<th width="15%">Type</th>
				<th width="15%">Size</th>
			</thead>
			<tbody>
				<?php
					$document->get_docu($area);
				?>
			</tbody>
		</table>
	</body>
</html>
<script type="text/javascript">
	var user_type = <?php echo json_encode($_SESSION['user_type']) ?>;
	var user_id = <?php echo json_encode($_SESSION['user_id']);?>;
</script>