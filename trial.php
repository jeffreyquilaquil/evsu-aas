<h3 id='header'>asd</h3>
<button onclick="goBack()">Back</button>
<button onclick='goForward()'>Forward</button>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
	array_numb=["0"];
	function goForward(){
		var i = array_numb.length-1;
		i++;
		array_numb.push(i);
		alert(i);
	}

	function goBack(){
		array_numb.pop();
		var i = array_numb.length-1;
		alert(i);
	}
</script>