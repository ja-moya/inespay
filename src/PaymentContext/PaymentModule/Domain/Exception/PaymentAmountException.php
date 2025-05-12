<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Domain\Exception;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Exception\DomainException;

class PaymentAmountException extends DomainException
{
    public static function invalid(float $value): self
    {
        return new self(sprintf("%f is not a valid payment amount", $value));
    }
}
