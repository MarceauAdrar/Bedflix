<?php

namespace App\Tests\Controller;

use Symfony\Component\Panther\PantherTestCase;

final class HomeControllerPantherTest extends PantherTestCase
{
    public function testIndex(): void
    {
        // your app is automatically started using the built-in web server
        $client = static::createPantherClient([
            // 'hostname' => 'example.com', // defaults to 127.0.0.1
            'port' => 8001, // defaults to 9080
            'browser' => static::CHROME
        ]);
        $client->request('GET', '/');

        // use any PHPUnit assertion, including the ones provided by Symfony...
        $this->assertPageTitleContains('My Title');
        $this->assertSelectorTextContains('#main', 'My body');

        // ... or the one provided by Panther
        $this->assertSelectorIsEnabled('.search');
        $this->assertSelectorIsDisabled('[type="submit"]');
        $this->assertSelectorIsVisible('.errors');
        $this->assertSelectorIsNotVisible('.loading');
        $this->assertSelectorAttributeContains('.price', 'data-old-price', '42');
        $this->assertSelectorAttributeNotContains('.price', 'data-old-price', '36');
    }
}
