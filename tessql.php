<?php
if ( ! defined('ABSPATH') ) {
    require( dirname( __FILE__ ) . './..'.'/wp-load.php' );
    }
global $wpdb;

/* $caripengguna = $wpdb->get_row( "SELECT email FROM penerima WHERE status='1'" );
$hasilquery = $caripengguna->email;

if ($hasilquery->num_rows > 0) {
   	while($baris = $caripengguna->fetch_assoc()) {
   	$email = $baris['email'];
   	$simpanemail[]=$email;
    	}
	} else {
    echo "tidak ada email";
	} */

	foreach( $wpdb->get_results("SELECT email FROM penerima WHERE status='1'") as $key => $row) {
	$my_column = $row->email;
	}

	//$hasil = implode(" ", $simpanemail);
	//var_dump($my_column);

	$ambilemail = $wpdb->get_results( "SELECT email FROM penerima WHERE status='1'");
    foreach ($ambilemail as $listemail) {
      $hasilemail = $listemail->email."<br>";
      $dataemail[] = $hasilemail;
      } 
	//var_dump($dataemail);
	$datapenerima = implode(" ", $dataemail);
	//echo "$jadi";
	echo $datapenerima;
	?>