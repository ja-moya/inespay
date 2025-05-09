<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Domain\Exception;

use Exception;

class DomainException extends Exception
{
    public function __construct(string $message = "Unknown exception", int $code = 0, Exception $exception = null)
    {
        parent::__construct($message, $code, $exception);
    }
}
