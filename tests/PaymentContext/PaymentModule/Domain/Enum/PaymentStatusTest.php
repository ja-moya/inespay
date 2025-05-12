<?php

declare(strict_types=1);

namespace Tests\PaymentContext\PaymentModule\Domain\Enum;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Enum\PaymentStatus;
use PHPUnit\Framework\TestCase;

class PaymentStatusTest extends TestCase
{
    public function test_it_can_be_instantiated(): void
    {
        $vo = PaymentStatus::IN_PROGRESS;

        $this->assertEquals(PaymentStatus::IN_PROGRESS->value, $vo->value);
    }
}
