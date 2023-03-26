<?php

namespace Tests\Unit;

use Exception;
use Integrations\MailerLite\MailerLiteManager;
use Tests\TestCase;

class MailerLiteManagerTest extends TestCase
{
    public function testValidApiToken()
    {
        $validApiToken = config('mailer-lite.token');

        $mailerLiteManager = new MailerLiteManager;
        $this->assertTrue($mailerLiteManager->isValidApiToken($validApiToken));
    }

    public function testInvalidApiToken()
    {
        $invalidApiToken = '8585858';

        $mailerLiteManager = new MailerLiteManager;
        $this->expectException(Exception::class);
        $mailerLiteManager->isValidApiToken($invalidApiToken);
    }

    public function testSubscribersList()
    {
        $mailerLiteManager = new MailerLiteManager;
        $this->assertIsArray($mailerLiteManager->getSubscribersList());
    }
}
