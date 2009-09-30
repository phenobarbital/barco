<?php
require 'barco/barco.inc.php';
#Inicializamos Barco:
barco::init('config/barco.config.inc.php');
#me permite generar un codigo QR (Quick Response)
$qr = barco::generate('qr');
#defino la data y el modo de correccion ECC;
$qr->data('Prueba')->ecc('M')->size('10');
if($qr->generate()) {
	$qr->image('png');
}
?>