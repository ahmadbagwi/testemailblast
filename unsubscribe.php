<!DOCTYPE html>
<html>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<head>
	<title>Berhenti menerima email berita kebudayaan</title>
</head>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	require ('konfig.php');
	$mail = $_POST["email"];
	$queryhapus = "DELETE FROM penerima WHERE email = '$mail'";
	$hasilhapus = $conn->query($queryhapus);
	if ($hasilhapus) {
		$info =  "Anda telah berhenti menerima email";
	} else {
		$info = "Gagal";
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
							<strong>Berhenti menerima email berita kebudayaan</strong>
						</div>
						<div class="panel-body">
							<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<input type="email" name="email" class="email form-control" id="email" aria-describedby="emailHelp" placeholder="Email"><br>
									<button type="submit" class="btn btn-primary">Stop Email</button>
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

