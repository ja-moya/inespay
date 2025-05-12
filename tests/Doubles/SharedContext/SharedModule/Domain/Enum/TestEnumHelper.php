<?php

declare(strict_types=1);

namespace Tests\Doubles\SharedContext\SharedModule\Domain\Enum;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Enum\EnumHelper;

/**
 * @method bool isOption()
 * @method bool isTwoWords()
 */
enum TestEnumHelper: string
{
    use EnumHelper;

    case OPTION = 'option';
    case TWO_WORDS = 'two_words';
}
