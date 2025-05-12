<?php

declare(strict_types=1);

namespace Tests\PaymentContext\PaymentModule\Domain\ValueObject;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentCreditorAccount;
use PHPUnit\Framework\TestCase;

class PaymentCreditorAccountTest extends TestCase
{
    public function test_it_can_be_instantiated(): void
    {
        $value = "creditor_account";
        $vo = new PaymentCreditorAccount($value);

        $this->assertInstanceOf(PaymentCreditorAccount::class, $vo);
        $this->assertEquals($value, $vo->value());
    }
}
