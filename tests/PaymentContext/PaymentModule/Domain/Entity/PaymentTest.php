<?php

declare(strict_types=1);

namespace Tests\PaymentContext\PaymentModule\Domain\Entity;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Entity\Payment;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Enum\PaymentStatus;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentAmount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentCreditorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentDebtorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentNotificationId;
use PHPUnit\Framework\TestCase;

class PaymentTest extends TestCase
{
    public function test_it_can_be_instantiated(): void
    {
        $amount = new PaymentAmount(123.45);
        $status = PaymentStatus::COMPLETED;
        $creditorAccount = new PaymentCreditorAccount('creditor_account');
        $debtorAccount = new PaymentDebtorAccount('debtor_account');
        $notificationId = PaymentNotificationId::generate();

        $payment = new Payment(
            $amount,
            $status,
            $creditorAccount,
            $debtorAccount,
            $notificationId
        );

        $this->assertInstanceOf(Payment::class, $payment);
        $this->assertEquals($amount, $payment->amount());
        $this->assertEquals($status, $payment->status());
        $this->assertEquals($creditorAccount, $payment->creditorAccount());
        $this->assertEquals($debtorAccount, $payment->debtorAccount());
        $this->assertEquals($notificationId, $payment->notificationId());
    }
}
