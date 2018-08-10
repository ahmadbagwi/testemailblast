<?php
// menampilkan error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// konfigurasi db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beta";

// koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$querycari = "SELECT email FROM penerima";
$hasilcari = $conn->query($querycari);

if ($hasilcari->num_rows > 0) {
   	while($baris = $hasilcari->fetch_assoc()) {
   	$email = $baris['email'];
   	$simpanemail[]=$email;
    	}
	} else {
    echo "0 results";
	}
//echo $simpanemail[0];
//echo $simpanemail[1];

//print_r($simpanemail);

foreach ($simpanemail as $penerima) {
	echo "penerima adalah"." ".$penerima."<br>";
}
?>