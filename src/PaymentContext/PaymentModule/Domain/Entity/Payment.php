<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Domain\Entity;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Enum\PaymentStatus;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentAmount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentCreditorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentDebtorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentNotificationId;

class Payment
{
    private PaymentAmount $amount;
    private PaymentStatus $status;
    private PaymentCreditorAccount $creditorAccount;
    private PaymentDebtorAccount $debtorAccount;
    private PaymentNotificationId $notificationId;

    public function __construct(
        PaymentAmount $amount,
        PaymentStatus $status,
        PaymentCreditorAccount $creditorAccount,
        PaymentDebtorAccount $debtorAccount,
        PaymentNotificationId $notificationId
    ) {
        $this->amount = $amount;
        $this->status = $status;
        $this->creditorAccount = $creditorAccount;
        $this->debtorAccount = $debtorAccount;
        $this->notificationId = $notificationId;
    }

    public function amount(): PaymentAmount
    {
        return $this->amount;
    }

    public function status(): PaymentStatus
    {
        return $this->status;
    }

    public function creditorAccount(): PaymentCreditorAccount
    {
        return $this->creditorAccount;
    }

    public function debtorAccount(): PaymentDebtorAccount
    {
        return $this->debtorAccount;
    }

    public function notificationId(): PaymentNotificationId
    {
        return $this->notificationId;
    }
}
