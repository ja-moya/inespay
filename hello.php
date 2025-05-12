<?php

require_once __DIR__ . '/vendor/autoload.php';

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Entity\Payment;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Enum\PaymentStatus;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentAmount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentCreditorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentDebtorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentNotificationId;
use Amoya\Inespay\PaymentContext\PaymentModule\Infrastructure\Http\HttpNotificationService;
use Amoya\Inespay\SharedContext\SharedModule\Infrastructure\Http\CurlHttpPostClient;

echo "Hola desde Docker 🐳" . PHP_EOL;

$payment = new Payment(
    new PaymentAmount(123.45),
    PaymentStatus::COMPLETED,
    new PaymentCreditorAccount('creditor_account'),
    new PaymentDebtorAccount('debtor_account'),
    PaymentNotificationId::generate()
);

$curlHttpPostClient = new CurlHttpPostClient();

$notificationService = new HttpNotificationService(
    'https://webhook.site/b69d53c8-2d53-41d5-b620-b2b7740d7035',
    "superSecretKey",
    $curlHttpPostClient
);

$notificationService->send($payment);
