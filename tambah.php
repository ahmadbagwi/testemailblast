<!DOCTYPE html>
<html>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<head>
	<title>Menambah penerima email kebudayaan</title>
</head>
<script type="text/javascript">
	var tanya = prompt("Password?");
if (tanya != "q") {
    window.location.href="about:blank";
} 
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require ('konfig.php');
	$mail = $_POST["email"];
	$querysimpan = "INSERT INTO penerima (email, status) VALUES('$mail','1')";
	$hasilsimpan = $conn->query($querysimpan);
	if ($hasilsimpan) {
		$info =  "Data berhasil disimpan";
	} else {
		$info = "Data gagal disimpan";
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
							<strong>Menambah penerima berita kebudayaan</strong>
						</div>
						<div class="panel-body">
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<input type="email" name="email" class="email form-control" id="email" required="" aria-describedby="emailHelp" placeholder="Email"><br>
									<button type="submit" class="btn btn-primary">Tambah</button>
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

