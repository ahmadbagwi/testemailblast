<?php
//koneksi ke core wordpress
if ( ! defined('ABSPATH') ) {
    require( dirname( __FILE__ ) . './..'.'/wp-load.php' );
    }

// mengambil konten dengan query wordpress multisite
$today = date("Y-m-d");
$blogs = get_last_updated();
    foreach ($blogs AS $blog) {    
    	switch_to_blog($blog["blog_id"]);
    	$today = getdate();
    	$args = array(
    		'post_type'         => 'post',
    		'post_status'       => 'publish',
    		'date_query'        => array(
    			array(
    				'year'  => $today['year'],
    				'month' => $today['mon'],
    				'day'   => $today['mday']
    			)
    		)
    	);
    	$wpb_all_query = new WP_Query($args); ?>
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
    	<?php restore_current_blog(); 
    }

$artikel = implode(" ",$semuakonten);

//footer
$footer = '<br>Ikuti akun @budayasaya di Facebook, Twitter dan Instagram
			<br>Untuk berhenti menerima email klik 
			<a href="https://kebudayaan.kemdikbud.go.id/unsubscribe.php">disini</a>';

// mengambil penerima
$ambilemail = $wpdb->get_results( "SELECT email FROM penerima WHERE status='1'");
	foreach ($ambilemail as $listemail) {
			$hasilemail = $listemail->email;
			$dataemail[] = $hasilemail;
		} 

//fungsi kirim email dengan phpmailer
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
	$mail->SmtpClose();
?>