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

use Illuminate\Support\ServiceProvider;

/**
 * This is the cloudflare service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CloudFlareServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('graham-campbell/cloudflare', 'graham-campbell/cloudflare', __DIR__);

        include __DIR__.'/routes.php';
        include __DIR__.'/assets.php';
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
        $this->app->bind('GrahamCampbell\CloudFlare\Controllers\CloudFlareController', function ($app) {
            $zone = $app['cloudflareapi']
                ->connection($app['config']['graham-campbell/cloudflare::connection'])
                ->zone($app['config']['graham-campbell/cloudflare::zone']);

            $store = $app['cache']
                ->driver($app['config']['graham-campbell/cloudflare::driver'])
                ->getStore();

            $key = $app['config']['graham-campbell/cloudflare::key'];

            $filters = $app['config']['graham-campbell/cloudflare::filters'];

            return new Controllers\CloudFlareController($zone, $store, $key, $filters);
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
