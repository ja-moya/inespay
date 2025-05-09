<?php
require_once __DIR__ . '/vendor/autoload.php';

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Entity\Payment;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentAmount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentCreditorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentDebtorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentNotificationId;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentStatus;

echo "Hola desde Docker 🐳" . PHP_EOL;

$payment = new Payment(
    new PaymentAmount(12.5),
    PaymentStatus::Completed,
    new PaymentCreditorAccount("creditor_account"),
    new PaymentDebtorAccount("debtor_account"),
    PaymentNotificationId::generate()
);

var_dump($payment);
