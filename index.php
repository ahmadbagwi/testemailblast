<?php
/**
* Plugin Name: WP Email Blast
* Plugin URI: http://kdesain.com
* Description: Mengirim artikel harian yang ditulis oleh setiap situs multisite setiap hari
* Version: 0.1
* Author: Ahmad Bagwi Rifai
* Author URI: https://localhost91.wordpress.com
*/
defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
date_default_timezone_set("Asia/Jakarta");
function wpemailblast_actions() {
     add_menu_page('WP Email Blast', 'WP Email Blast', 'edit_pages', 'wp_emailblast', 'wpemailblast', '', 76);
     add_submenu_page('wp_emailblast', 'Tambah Email', 'Tambah Email', 'edit_pages', 'tambah_email', 'tambahemail' );
     add_submenu_page('wp_emailblast', 'Import CSV', 'Import CSV', 'edit_pages', 'import_csv', 'importcsv' );
     add_submenu_page('wp_emailblast', 'Hapus Email', 'Hapus Email', 'edit_pages', 'hapus_email', 'hapusemail' );
}
add_action('admin_menu', 'wpemailblast_actions');

register_activation_hook(__FILE__, 'my_activation');

function my_activation() {
    if (! wp_next_scheduled ( 'email_kebudayaan' )) {
	wp_schedule_event( strtotime('16:05:00'), 'daily', 'email_kebudayaan' );
    }
}

add_action('email_kebudayaan', 'kirimemail');

function kirimemail() {
	$blogs = get_last_updated(' ', 0, 40);
	global $wpdb;
	foreach ($blogs AS $blog) {    
		switch_to_blog($blog["blog_id"]);
		/*$today = getdate();
		$today_args = array(
    					'year' => $today['year'],
   						'monthnum' => $today['mon'],
    					'day' => $today['mday'] 
		);
		$args = array(
			'post_type'         => 'post',
			'post_status'       => 'publish'
		);*/
		$newargs =  array(
        'post_type' => 'post',
        'date_query' => array(
          array(
            'after' => 'Today',
            'inclusive' => true,
            )
          ),
        'post_status' => array(
          'publish'
          )
        );
		$wpb_all_query = new WP_Query($newargs); ?>
		<?php if ( $wpb_all_query->have_posts() ) : ?>

			<!-- the loop -->
			<?php while ( $wpb_all_query->have_posts() ) : $wpb_all_query->the_post(); 
				$konten = get_the_date('Y-m-d')." | ".get_bloginfo()." | ".'<a href="'.get_permalink().'">'.get_the_title()."</a><br>";
				$semuakonten[]=$konten
				?>
			<?php endwhile; ?>
			<!-- end of the loop -->
			<?php wp_reset_postdata(); ?>
		<?php endif; ?>
		<?php restore_current_blog(); ?>
	<?php 
	}

	$artikel = implode(" ",$semuakonten);

	//footer
	$footer = '<br>Ikuti akun @budayasaya di Facebook, Twitter dan Instagram
	<br>Untuk berhenti menerima email klik 
	<a href="https://kebudayaan.kemdikbud.go.id/stop-email-kebudayaan/">disini</a>';
	if ($artikel != NULL) {
	// mengambil penerima
		$ambilemail = $wpdb->get_results( "SELECT email FROM penerima WHERE status='1'");
		foreach ($ambilemail as $listemail) {
			$hasilemail = $listemail->email;
			$dataemail[] = $hasilemail;
		}
		$subject = 'Berita Kebudayaan';
		$headers = array('Content-Type: text/html; charset=UTF-8');
		//kirim email dengan wp_mail() format html
		foreach ($dataemail as $to) {
			wp_mail( $to, $subject, $artikel, $headers ); 
		}
		/*fungsi kirim email dengan phpmailer
		require ('vendor/phpmailer/phpmailer/PHPMailerAutoload.php');
		require ('vendor/phpmailer/phpmailer/class.phpmailer.php');
		require ('vendor/phpmailer/phpmailer/class.smtp.php');

    	// Konfigurasi SMTP
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->SMTPKeepAlive = true;
		$mail->SmtpConnect();
		$mail->Host = 'mail.smtp2go.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'budayasaya@gmail.com';
		$mail->Password = 'SahabatBudaya';
		$mail->SMTPSecure = 'tls';
		$mail->Port = 2525;
		$mail_class = "transactional";
		$mail->setFrom('budayasaya@gmail.com', 'budayasaya');
		$mail->addReplyTo('budayasaya@gmail.com', 'budayasaya');
		$mail->Subject = 'Berita Kebudayaan';
		$mail->addCustomHeader("X-GreenArrow-MailClass: $mail_class");

    // looping pengiriman email
		foreach ($dataemail as $penerima) {
			$mail->ClearAllRecipients();
			$mail->AddAddress($penerima);
			$mail->isHTML(true);
			$mail->Body = $artikel.$footer;
			if(!$mail->send()){
				echo 'Pesan tidak dapat dikirim.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
		}
		$mail->SmtpClose();*/
	}
}

function wpemailblast() { 
	global $wpdb;
	$total = $wpdb->get_row("SELECT COUNT(email) as mail FROM penerima");
	$emailtidakaktif = $wpdb->get_row( "SELECT COUNT(email) as tidakaktif FROM penerima WHERE status='0'");
	$emailaktif = $wpdb->get_row( "SELECT COUNT(email) as aktif FROM penerima WHERE status='1'");
	
	?>
	<table class="table">
		<tr>
			<td>Total Email</td>
			<td>Tidak Aktif</td>
			<td>Aktif</td>
		</tr>
		<tr>
			<td><?php echo $total->mail; ?></td>
			<td><?php echo $emailtidakaktif->tidakaktif; ?></td>
			<td><?php echo $emailaktif->aktif; ?></td>
		</tr>
	<?php
}

function tambahemail() { ?>
	<form method="post" action="">
		<input type="email" name="email" class="email form-control" id="email" required="" aria-describedby="emailHelp" placeholder="Email"><br>
		<button type="submit" name="tambah" class="btn btn-primary">Tambah</button>
	</form>
	<?php
	if (isset($_POST['tambah'])) {
		global $wpdb;
		$mail = $_POST['email'];
		$addemail = $wpdb->get_results("INSERT INTO penerima (email, status) VALUES('$mail','1')");
		if ($wpdb->last_error) {
			echo 'Gagal tambah email, harap periksa email'.$wpdb->last_error;
		} else { 
			echo "Sukses tambah email!";
		}
	}
}

function importcsv() {
	if (isset($_POST['importcsv'])) {
		global $wpdb;
		$filename=$_FILES["file"]["tmp_name"];
		if($_FILES["file"]["size"] > 0) {
			$file = fopen($filename, "r");
			while (($getData = fgetcsv($file, 10000, ",")) !== FALSE) {
				$importemail = $wpdb->get_results("INSERT into penerima(email) values ('".$getData[0]."')");
				if($wpdb->last_error) {
					echo 'Gagal Import File'.$wpdb->last_error;		
				} else {
					echo 'Sukses Import File';
				}
			}
			fclose($file);	
		}
	} ?>
	<form method="post" action="" enctype="multipart/form-data">
		Pilih File CSV
		<input type="file" name="file" id="file" class="input-large">
		<button type="submit" name="importcsv" class="btn btn-primary">Import</button>
	</form>
	<?php
}

function hapusemail() { ?>
	<form method="post" action="">
		<input type="email" name="email" class="email form-control" id="email" required="" aria-describedby="emailHelp" placeholder="Email"><br>
		<button type="submit" name="hapus" class="btn btn-primary">Hapus</button>
	</form>
	<?php
	if (isset($_POST['hapus'])) {
		global $wpdb;
		$mail = $_POST['email'];
		$removeemail = $wpdb->get_results("UPDATE penerima SET status ='0' WHERE email = '$mail'");
		if ($wpdb->last_error) {
			echo 'Gagal hapus email'.$wpdb->last_error;
		} else { 
			echo 'Sukses hapus email';
		}
	}
}

add_shortcode('unsubscribe', 'hapusemail');

register_deactivation_hook(__FILE__, 'my_deactivation');

function my_deactivation() {
	wp_clear_scheduled_hook('email_kebudayaan');
}
