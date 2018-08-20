<?php
//konfig database
require ('konfig.php');

// mengambil konten
require ('body.php');
//$konten = implode(" ",$simpandata);
$footer = '<br>Ikuti akun @budayasaya di Facebook, Twitter dan Instagram
			<br>Untuk berhenti menerima email klik 
			<a href="https://kebudayaan.kemdikbud.go.id/unsubscribe.php">disini</a>';

// mengambil penerima
$querycari = "SELECT email FROM penerima WHERE status='1'";
$hasilcari = $conn->query($querycari);

if ($hasilcari->num_rows > 0) {
   	while($baris = $hasilcari->fetch_assoc()) {
   	$email = $baris['email'];
   	$simpanemail[]=$email;
    	}
	} else {
    echo "tidak ada email";
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
    foreach ($simpanemail as $penerima) {
		$mail->ClearAllRecipients();
		$mail->AddAddress($penerima);
		$mail->isHTML(true);
		$mail->Body = $artikel.$footer/*"Tes email aja dengan penerima dari array"*/;
			if(!$mail->send()){
				echo 'Pesan tidak dapat dikirim.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}
			  //delay sleep(5);
		}
	$mail->SmtpClose();
?>