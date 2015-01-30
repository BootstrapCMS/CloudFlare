<?php

/*
 * This file is part of Laravel CloudFlare.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlare;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Lightgear\Asset\Asset;

/**
 * This is the cloudflare service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
        $this->setupPackage($this->app->asset);

        $this->setupRoutes($this->app->router);
    }

    /**
     * Setup the package.
     *
     * @param \Lightgear\Asset $asset
     *
     * @return void
     */
    protected function setupPackage(Asset $asset)
    {
        $source = realpath(__DIR__.'/../config/cloudflare.php');

        $this->publishes([$source => config_path('cloudflare.php')]);

        $this->mergeConfigFrom($source, 'cloudflare');

        $this->loadViewsFrom(realpath(__DIR__.'/../views'), 'cloudflare');

        $asset->registerScripts(['graham-campbell/cloudflare/assets/js/cloudflare.js'], '', 'cloudflare');
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
        $this->registerCloudFlareController();
    }

    /**
     * Register the cloudflare controller class.
     *
     * @return void
     */
    protected function registerCloudFlareController()
    {
        $this->app->bind('GrahamCampbell\CloudFlare\Http\Controllers\CloudFlareController', function ($app) {
            $zone = $app['cloudflareapi']
                ->connection($app['config']['cloudflare.connection'])
                ->zone($app['config']['cloudflare.zone']);

            $store = $app['cache']
                ->driver($app['config']['cloudflare.driver'])
                ->getStore();

            $key = $app['config']['cloudflare.key'];

            $middleware = $app['config']['cloudflare.middleware'];

            return new Http\Controllers\CloudFlareController($zone, $store, $key, $middleware);
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
