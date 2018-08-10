<!DOCTYPE html>
<html>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<head>
	<title>Import CSV penerima email kebudayaan</title>
</head>
</html><?php/*<script type="text/javascript">
	var tanya = prompt("Password?");
if (tanya != "qwerty123456") {
    window.location.href="about:blank";
} 
</script>*/?>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require ('konfig.php');
	$filename=$_FILES["file"]["tmp_name"];		


	if($_FILES["file"]["size"] > 0)
	{
		$file = fopen($filename, "r");
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
		{
			$sql = "INSERT into penerima (email) values ('".$getData[0]."')";
			$result = mysqli_query($conn, $sql);
			if(!isset($result))
			{
				echo "<script type=\"text/javascript\">
				alert(\"Invalid File:Please Upload CSV File.\");
				window.location = \"import.php\"
				</script>";		
			}
			else {
				echo "<script type=\"text/javascript\">
				alert(\"CSV File has been successfully Imported.\");
				window.location = \"import.php\"
				</script>";
			}
		}

		fclose($file);	
	}
}
?>
<div class="container">
	<div class="column">
		<div class="row">
			<div class="col-md-6">
				<body>
					<div class="panel panel-default">
						<div class="panel-heading">
							<strong>Import CSV penerima berita kebudayaan</strong>
						</div>
						<div class="panel-body">
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									Pilih File CSV
									<input type="file" name="file" id="file" class="input-large">
									<button type="submit" class="btn btn-primary">Import</button>
							</form>
							<?php echo $info;?>
						</div>
					</div>
				</body>
			</div>
		</div>
	</div>
</div>
</html>

