<?php

declare(strict_types=1);

namespace Tests\PaymentContext\PaymentModule\Infrastructure\Http;

use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Entity\Payment;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\Enum\PaymentStatus;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentAmount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentCreditorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentDebtorAccount;
use Amoya\Inespay\PaymentContext\PaymentModule\Domain\ValueObject\PaymentNotificationId;
use Amoya\Inespay\PaymentContext\PaymentModule\Infrastructure\Http\HttpNotificationService;
use Amoya\Inespay\PaymentContext\PaymentModule\Infrastructure\Http\HttpPostClientInterface;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PHPUnit\Framework\TestCase;

class HttpNotificationServiceTest extends TestCase
{
    private function createPayment(): Payment
    {
        return new Payment(
            new PaymentAmount(99.99),
            PaymentStatus::COMPLETED,
            new PaymentCreditorAccount('cred-001'),
            new PaymentDebtorAccount('debt-001'),
            PaymentNotificationId::generate()
        );
    }

    public function test_it_send_right_data(): void
    {
        $payment = $this->createPayment();

        $httpPostClientMocked = $this->createMock(HttpPostClientInterface::class);
        $httpPostClientMocked
            ->expects($this->once())
            ->method('sendJson')
            ->with(
                'http://localhost',
                $this->callback(function (array $headers): bool {
                    if ($headers['Content-Type'] !== 'application/json') {
                        return false;
                    }

                    if (!isset($headers['Signature'])) {
                        return false;
                    }

                    try {
                        $decoded = JWT::decode($headers['Signature'], new Key('test-secret', 'HS256'));
                        $bodyJson = $decoded->body;
                        $body = json_decode($bodyJson, true);
                        return isset($body['amount']) && $body['amount'] === 99.99;
                    } catch (\Throwable) {
                        return false;
                    }
                }),
                $this->callback(function (array $body) use ($payment): bool {
                    return $body['amount'] === $payment->amount()->value()
                        && $body['status'] === $payment->status()->value
                        && $body['creditor_account'] === $payment->creditorAccount()->value()
                        && $body['debtor_account'] === $payment->debtorAccount()->value()
                        && $body['notification_id'] === $payment->notificationId()->value();
                }),
            );

        $service = new HttpNotificationService(
            'http://localhost',
            'test-secret',
            $httpPostClientMocked);

        $service->send($payment);
    }
}
