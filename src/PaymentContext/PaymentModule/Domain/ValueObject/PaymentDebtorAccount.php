<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject;

use Amoya\Inespay\SharedContext\SharedModule\Domain\ValueObject\AbstractStringValueObject;

class PaymentDebtorAccount extends AbstractStringValueObject
{
    protected function assertValid(string $value): void
    {
        // TODO: Implement assertValid() method.
    }
}
