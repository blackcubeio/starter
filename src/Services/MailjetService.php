<?php

declare(strict_types=1);

/**
 * MailjetService.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Services;

use Mailjet\Client;
use Mailjet\Resources;
use Psr\EventDispatcher\EventDispatcherInterface;
use RuntimeException;
use Yiisoft\Mailer\BaseMailer;
use Yiisoft\Mailer\MessageInterface;
use Yiisoft\Mailer\MessageSettings;

class MailjetService extends BaseMailer
{
    public function __construct(
        private readonly Client $client,
        ?MessageSettings $defaultMessageSettings = null,
        ?EventDispatcherInterface $eventDispatcher = null,
    ) {
        parent::__construct($defaultMessageSettings, $eventDispatcher);
    }

    protected function sendMessage(MessageInterface $message): void
    {
        $body = ['Messages' => [
            [
                'From' => $this->normalizeAddress($message->getFrom()),
                'To' => $this->normalizeAddresses($message->getTo()),
                'Subject' => $message->getSubject(),
                'TextPart' => $message->getTextBody(),
                'HTMLPart' => $message->getHtmlBody(),
            ],
        ]];

        $response = $this->client->post(Resources::$Email, ['body' => $body]);

        if ($response->success() !== true) {
            throw new RuntimeException(
                'Mailjet send failed ('.($response->getStatus() ?? 0).'): '.($response->getReasonPhrase() ?? 'unknown')
            );
        }
    }

    /**
     * @param array<string,string>|string|null $address
     * @return array{Email: string, Name?: string}|null
     */
    private function normalizeAddress(array|string|null $address): ?array
    {
        if ($address === null) {
            return null;
        }
        if (is_array($address) === true) {
            $email = array_key_first($address);
            $name = $address[$email];
            if (is_int($email) === true) {
                return ['Email' => $name];
            }
            return ['Email' => $email, 'Name' => $name];
        }
        if (preg_match('/^\s*(.+?)\s*<\s*(.+?)\s*>\s*$/', $address, $matches) === 1) {
            return ['Email' => $matches[2], 'Name' => trim($matches[1], '"')];
        }
        return ['Email' => $address];
    }

    /**
     * @param array<string,string>|string|null $addresses
     * @return array<int,array{Email: string, Name?: string}>|null
     */
    private function normalizeAddresses(array|string|null $addresses): ?array
    {
        if ($addresses === null) {
            return null;
        }
        if (is_string($addresses) === true) {
            $normalized = $this->normalizeAddress($addresses);
            return $normalized !== null ? [$normalized] : null;
        }
        $result = [];
        foreach ($addresses as $email => $name) {
            if (is_int($email) === true) {
                $normalized = $this->normalizeAddress($name);
            } else {
                $normalized = $this->normalizeAddress([$email => $name]);
            }
            if ($normalized !== null) {
                $result[] = $normalized;
            }
        }
        return $result !== [] ? $result : null;
    }
}
