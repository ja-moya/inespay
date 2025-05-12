<?php

declare(strict_types=1);

namespace Tests\SharedContext\SharedModule\Domain\Enum;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Exception\EnumHelperException;
use PHPUnit\Framework\TestCase;
use Tests\Doubles\SharedContext\SharedModule\Domain\Enum\TestEnumHelper;

class EnumHelperTest extends TestCase
{
    public function test_enum(): void
    {
        $enum = TestEnumHelper::OPTION;

        $this->assertInstanceOf(TestEnumHelper::class, $enum);
        $this->assertTrue($enum->isOption());
        $this->assertFalse($enum->isTwoWords());
    }

    public function test_enum_with_multiple_words(): void
    {
        $enum = TestEnumHelper::TWO_WORDS;

        $this->assertInstanceOf(TestEnumHelper::class, $enum);
        $this->assertTrue($enum->isTwoWords());
        $this->assertFalse($enum->isOption());
    }

    public function test_enum_exception(): void
    {
        $enum = TestEnumHelper::OPTION;

        $this->expectException(EnumHelperException::class);
        $enum->isInvalidException();
    }

    public function test_method_not_found(): void
    {
        $enum = TestEnumHelper::OPTION;

        $this->expectException(EnumHelperException::class);
        $enum->inexistentMethod();
    }
}
