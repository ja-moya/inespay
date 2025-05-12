<?php

declare(strict_types=1);

namespace Amoya\Inespay\PaymentContext\PaymentModule\Domain\Enum;

use Amoya\Inespay\SharedContext\SharedModule\Domain\Enum\EnumHelper;

/**
 * @method bool isPending()
 * @method bool isInProgress()
 * @method bool isCompleted()
 * @method bool isFailed()
 */
enum PaymentStatus: string
{
    use EnumHelper;

    case PENDING = 'pending';
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}
