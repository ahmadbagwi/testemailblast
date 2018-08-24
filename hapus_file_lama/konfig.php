<?php
// menampilkan error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// hanya mengizinkan akses dari localhost
$allowed_ip = '127.0.0.1';
if( $allowed_ip !== $_SERVER['REMOTE_ADDR'] ) {
    exit( 0 );
}

// konfigurasi db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "beta";

// koneksi
$conn = new mysqli($servername, $username, $password, $dbname);
$hari = date("Y-m-d");

// cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>