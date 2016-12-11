<input type='file' id='file'>
<button onclick="hulala()">Click me</button>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
	function hulala(){
		var d = $("#file").val();
		var i = d.split('\\').pop().split('/').pop();

		var e = "jquery.js";
		$.get(e)
		.done(function(){
			alert("File already exist");
		});
	}
</script>