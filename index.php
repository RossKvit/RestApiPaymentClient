<?php

require_once './vendor/autoload.php';
require_once './PaymentInterface.php';
require_once './CardPaymentVerification.php';
require_once './PayOp.php';

$payop = new PayOp();
$cardPaymentVerification = new CardPaymentVerification(
    "INVOICE_IDENTIFIER",
    "5555555555554444",
    "12/28",
    "123",
    "Ross Kvit"
);

$payop->sendRequest($cardPaymentVerification);