<?php

declare(strict_types=1);

namespace Amoya\Inespay\SharedContext\SharedModule\Infrastructure\Http\Exception;

use Exception;

/** @codeCoverageIgnore */
class HttpPostClientException extends Exception
{
    public static function failedRequest(int $statusCode, string $response): self
    {
        return new self("Failed to send notification. HTTP $statusCode. Response: $response");
    }

    public static function transportError(string $message): self
    {
        return new self("cURL error while sending notification: $message");
    }
}
