<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Exception\PaymentAmountException;
use Amoya\Inespay\SharedContext\SharedModule\Domain\ValueObject\AbstractFloatValueObject;

class PaymentAmount extends AbstractFloatValueObject
{
    /**
     * @throws PaymentAmountException
     */
    protected function assertValid(float $value): void
    {
        if ($value < 0) {
            throw PaymentAmountException::invalid($value);
        }
    }
}
