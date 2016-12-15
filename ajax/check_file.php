<?php
	$file = "../".$_GET['url'];
	if (is_file($file)) {
		echo "true";
	}else{
		echo "false";
	}
?>