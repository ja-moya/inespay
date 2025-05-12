<?php

declare(strict_types=1);

namespace Tests\PaymentContext\PaymentModule\Domain\ValueObject;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentDebtorAccount;
use PHPUnit\Framework\TestCase;

class PaymentDebtorAccountTest extends TestCase
{
    public function test_it_can_be_instantiated(): void
    {
        $value = "debtor_account";
        $vo = new PaymentDebtorAccount($value);

        $this->assertInstanceOf(PaymentDebtorAccount::class, $vo);
        $this->assertEquals($value, $vo->value());
    }
}
