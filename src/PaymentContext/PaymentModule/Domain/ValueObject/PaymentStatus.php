<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Enum\EnumHelper;

/**
 * @method bool isPending()
 * @method bool isCompleted()
 * @method bool isFailed()
 */
enum PaymentStatus: string
{
    use EnumHelper;

    case Pending = 'pending';
    case Completed = 'completed';
    case Failed = 'failed';
}
