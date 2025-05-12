<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Domain\Service;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Entity\Payment;

interface NotificationServiceInterface
{
    public function send(Payment $payment): void;
}
