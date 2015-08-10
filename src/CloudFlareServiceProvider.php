<?php

/*
 * This file is part of Laravel CloudFlare.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlare;

use GrahamCampbell\CloudFlare\Clients\CachingClient;
use GrahamCampbell\CloudFlare\Clients\ClientInterface;
use GrahamCampbell\CloudFlare\Clients\HttpClient;
use GrahamCampbell\CloudFlare\Http\Controllers\CloudFlareController;
use GuzzleHttp\Client;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;

/**
 * This is the cloudflare service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CloudFlareServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->setupPackage();

        $this->setupRoutes($this->app->router);
    }

    /**
     * Setup the package.
     *
     * @return void
     */
    protected function setupPackage()
    {
        $source = realpath(__DIR__.'/../config/cloudflare.php');

        $this->publishes([$source => config_path('cloudflare.php')]);

        $this->mergeConfigFrom($source, 'cloudflare');

        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'cloudflare');
    }

    /**
     * Setup the routes.
     *
     * @param \Illuminate\Routing\Router $router
     *
     * @return void
     */
    protected function setupRoutes(Router $router)
    {
        $router->group(['namespace' => 'GrahamCampbell\CloudFlare\Http\Controllers'], function (Router $router) {
            require __DIR__.'/Http/routes.php';
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerAnalyticsClient();
        $this->registerCloudFlareController();
    }

    /**
     * Register the analytics client class.
     *
     * @return void
     */
    protected function registerAnalyticsClient()
    {
        $this->app->bind(ClientInterface::class, function ($app) {
            $config = $app->config->get('cloudflare');

            $client = new Client([
                'base_uri' => 'https://api.cloudflare.com/client/v4/zones/',
                'headers'  => ['Accept' => 'application/json', 'X-Auth-Key' => $config['key'], 'X-Auth-Email' => $config['email']],
            ]);

            $http = new HttpClient($client);

            $cache = $app->cache->driver($config['cache']);

            return new CachingClient($http, $cache, $config['email']);
        });
    }

    /**
     * Register the cloudflare controller class.
     *
     * @return void
     */
    protected function registerCloudFlareController()
    {
        $this->app->bind(CloudFlareController::class, function ($app) {
            $client = $app->make(ClientInterface::class);
            $config = $app->config->get('cloudflare');

            return new CloudFlareController($client, $config['zone'], $config['middleware']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            //
        ];
    }
}
