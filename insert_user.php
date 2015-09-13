<?php
$date = htmlspecialchars(trim($_POST['date']));
$email = htmlspecialchars(trim($_POST['email']));
$note = htmlspecialchars(trim($_POST['note']));
$n_pedoni = htmlspecialchars(trim($_POST['n_pedoni']));
$n_bici = htmlspecialchars(trim($_POST['n_bici']));
$n_moto = htmlspecialchars(trim($_POST['n_moto']));
$n_auto = htmlspecialchars(trim($_POST['n_auto']));
$n_altri = htmlspecialchars(trim($_POST['n_altri']));
$lat = htmlspecialchars(trim($_POST['lat']));
$lng = htmlspecialchars(trim($_POST['lng']));
$token = mt_rand(100000, 999999);

$db = new PDO('sqlite:leaflet.sqlite');
$db->exec("INSERT INTO users (date, email, note, n_pedoni, n_bici, n_moto, n_auto, n_altri, lat, lng, token) VALUES ('$date', '$email', '$note', '$n_pedoni', '$n_bici', '$n_moto', '$n_auto', '$n_altri', '$lat', '$lng', '$token');");
$db = NULL;

$subject = "Benvenuto sulla mappa di OpenIncidenti!";
$body = '
<html>
<head>
</head>
<body>
	<p>Grazie per avere inserito un incidente sulla mappa di #openincidenti</p>
	Le informazioni relative ai dati inseriti:<br>
	-------------------------<br>
	Email: '.$email.'<br>
	Token: '.$token.'<br>
	-------------------------<br><br>
	Se ti accorgi di aver sbagliato ad inserire i dati torna sulla mappa e premi Rimuovi incidente.<br>
	Inserisci la tua mail e il codice che ti è arrivato con questa mail.<br>
	Sentiti libero di continuare ad aggiungere dati alla mappa, è importante per tutti!
</body>
</html>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: OpenIncidenti Map <noreply@teo-soft.com>' . "\r\n";
mail($email, $subject, $body, $headers, "-fnoreply@teo-soft.com");
?>