<?php
include "googleQr.php";

// QR_BarCode object 
$qr = new QR_BarCode(); 

// create text QR code 
$qr->text('rahul sharma'); 

// display QR code image
$qr->qrCode();


// save QR code image
$qr->qrCode(350,'../upload/rahul.png');
    ?>
