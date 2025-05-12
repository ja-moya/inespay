<?php

declare(strict_types=1);

namespace Tests\SharedContext\SharedModule\Domain\ValueObject;

use PHPUnit\Framework\TestCase;
use Tests\Doubles\SharedContext\SharedModule\Domain\ValueObject\TestValueObject;

class AbstractValueObjectTest extends TestCase
{
    public function test_to_string(): void
    {
        $value = 123456;
        $vo = new TestValueObject($value);

        $this->assertInstanceOf(TestValueObject::class, $vo);
        $this->assertEquals((string)$value, (string)$vo);
    }

    public function test_value(): void
    {
        $value = 123;
        $vo = new TestValueObject($value);

        $this->assertEquals($value, $vo->value());
    }

    public function test_equals(): void
    {
        $value1 = 123456;
        $vo1 = new TestValueObject($value1);

        $value2 = 123456;
        $vo2 = new TestValueObject($value2);

        $this->assertTrue($vo1->equals($vo2));
    }
}
