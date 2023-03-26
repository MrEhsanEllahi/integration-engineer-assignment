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

    public function testGetSubscriber()
    {
        $mailerLiteManager = new MailerLiteManager;
        $subscribersList = $mailerLiteManager->getSubscribersList();

        // Check if the list is not empty
        $this->assertNotEmpty($subscribersList, "Subscribers list is empty");

        if (!empty($subscribersList)) {
            // Get the ID of the first subscriber
            $subscriberId = $subscribersList['data'][0]->id;

            $subscriber = $mailerLiteManager->getSubscriber($subscriberId);
            $this->assertIsObject($subscriber);
        }
    }

    public function testCreateSubscriber()
    {
        $mailerLiteManager = new MailerLiteManager;

        // Create dummy subscriber data
        $subscriberData = [
            'email' => 'test@example.com',
            'fields' => [
                'name' => 'Test User',
                'country' => 'United States',
            ],
        ];

        $noExceptionThrown = false;

        try {
            $mailerLiteManager->addSubscriber($subscriberData);
            $noExceptionThrown = true;
        } catch (Exception $e) {
            // If an exception is thrown, the test will fail
        }

        // Assert that no exception was thrown
        $this->assertTrue($noExceptionThrown, 'An exception was thrown during the addSubscriber() call.');
    }

    public function testUpdateSubscriber()
    {
        $mailerLiteManager = new MailerLiteManager;
        $subscribersList = $mailerLiteManager->getSubscribersList();

        // Check if the list is not empty
        $this->assertNotEmpty($subscribersList, "Subscribers list is empty");

        if (!empty($subscribersList)) {
            $noExceptionThrown = false;

            try {
                // Get the first subscriber
                $subscriber = $subscribersList['data'][0];

                // Update the name of the subscriber
                $subscriber->name = 'Updated Test Name';

                // Prepare the update data
                $updatedSubscriber = [
                    'email' => $subscriber->email,
                    'fields' => [
                        'name' => $subscriber->name,
                        'country' => $subscriber->country,
                    ],
                ];

                $mailerLiteManager->updateSubscriber($updatedSubscriber);
                $noExceptionThrown = true;
            } catch (Exception $e) {
                // If an exception is thrown, the test will fail
            }
            
            // Assert that no exception was thrown
            $this->assertTrue($noExceptionThrown, 'An exception was thrown during the updateSubscriber() call.');
        }
    }

    public function testRemoveSubscriber()
    {
        $mailerLiteManager = new MailerLiteManager;
        $subscribersList = $mailerLiteManager->getSubscribersList();

        // Check if the list is not empty
        $this->assertNotEmpty($subscribersList, "Subscribers list is empty");

        if (!empty($subscribersList)) {
            $noExceptionThrown = false;

            try {
                // Get the ID of the first subscriber
                $subscriberId = $subscribersList['data'][0]->id;

                $mailerLiteManager->removeSubscriber($subscriberId);
                $noExceptionThrown = true;
            } catch (Exception $e) {
                // If an exception is thrown, the test will fail
            }
            
            // Assert that no exception was thrown
            $this->assertTrue($noExceptionThrown, 'An exception was thrown during the updateSubscriber() call.');
        }
    }
}
