<?php

declare(strict_types=1);

namespace Tests\SharedContext\SharedModule\Domain\ValueObject;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Exception\AbstractUuidValueObjectException;
use PHPUnit\Framework\TestCase;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Tests\Doubles\SharedContext\SharedModule\Domain\ValueObject\TestUuidValueObject;

class AbstractUuidValueObjectTest extends TestCase
{
    public function test_it_generate_a_valid_uuid(): void
    {
        $vo = TestUuidValueObject::generate();

        $this->assertInstanceOf(TestUuidValueObject::class, $vo);
        $this->assertTrue(RamseyUuid::isValid($vo->value()));
        $this->assertSame((string)$vo, $vo->value());

    }

    public function test_it_accepts_a_valid_uuid(): void
    {
        $uuid = RamseyUuid::uuid4()->toString();
        $vo = new TestUuidValueObject($uuid);

        $this->assertSame($uuid, $vo->value());
        $this->assertSame((string)$vo, $uuid);
    }

    public function test_it_rejects_invalid_uuid(): void
    {
        $this->expectException(AbstractUuidValueObjectException::class);
        new TestUuidValueObject('not-a-uuid');
    }
}
