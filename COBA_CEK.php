<html>
 
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="author" content="" />
	<script type="text/javascript">
	function run(){
		var cb = document.getElementById("cb");
 
		if(document.getElementById("cekbox").checked == true){
			cb.disabled = true;
		}else{
			cb.disabled = false;
		}
 
	}
	</script>
	<title>Enable/Disable ComboBox</title>
</head>
 
<body>
 
<input type="checkbox" name="a" id="cekbox" onClick="run();" />Disable Checkbox<br /><br />
 
<select id="cb" size="1">
	<option>a</option>
	<option>b</option>
</select>
 
</body>
</html>