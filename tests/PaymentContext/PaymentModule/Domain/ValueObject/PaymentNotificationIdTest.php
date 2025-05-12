<?php

declare(strict_types=1);

namespace Tests\PaymentContext\PaymentModule\Domain\ValueObject;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentNotificationId;
use Amoya\Inespay\SharedContext\SharedModule\Domain\Exception\AbstractUuidValueObjectException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid;

class PaymentNotificationIdTest extends TestCase
{
    public function test_it_can_be_instantiated(): void
    {
        $value = Uuid::uuid4()->toString();
        $vo = new PaymentNotificationId($value);

        $this->assertInstanceOf(PaymentNotificationId::class, $vo);
        $this->assertEquals($value, $vo->value());
    }

    public function test_invalid_uuid(): void
    {
        $this->expectException(AbstractUuidValueObjectException::class);
        $invalidUuid = new PaymentNotificationId('invalid-uuid');
    }
}
