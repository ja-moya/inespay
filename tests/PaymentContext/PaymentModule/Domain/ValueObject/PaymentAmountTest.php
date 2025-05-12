<?php

declare(strict_types=1);

namespace Tests\PaymentContext\PaymentModule\Domain\ValueObject;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Exception\PaymentAmountException;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentAmount;
use PHPUnit\Framework\TestCase;

class PaymentAmountTest extends TestCase
{
    public function test_it_can_be_instantiated(): void
    {
        $f = 123.45;
        $amount = new PaymentAmount($f);

        $this->assertInstanceOf(PaymentAmount::class, $amount);
        $this->assertEquals($f, $amount->value());
    }

    public function test_it_rejects_negative_amount(): void
    {
        $this->expectException(PaymentAmountException::class);

        new PaymentAmount(-123.45);
    }
}
