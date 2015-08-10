<?php

/*
 * This file is part of Laravel CloudFlare.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\CloudFlare;

use GrahamCampbell\CloudFlare\Clients\ClientInterface;
use GrahamCampbell\CloudFlare\CloudFlareServiceProvider;
use GrahamCampbell\TestBench\AbstractPackageTestCase;
use GrahamCampbell\TestBenchCore\ServiceProviderTrait;

/**
 * This is the service provider test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class ServiceProviderTest extends AbstractPackageTestCase
{
    use ServiceProviderTrait;

    /**
     * Get the service provider class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string
     */
    protected function getServiceProviderClass($app)
    {
        return CloudFlareServiceProvider::class;
    }

    public function testAnalyticsClientIsInjectable()
    {
        $this->assertIsInjectable(ClientInterface::class);
    }
}
