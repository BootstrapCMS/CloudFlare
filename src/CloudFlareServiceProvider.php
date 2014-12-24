<?php

/*
 * This file is part of Laravel CloudFlare by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\CloudFlare;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Lightgear\Asset\Asset;

/**
 * This is the cloudflare service provider class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare/blob/master/LICENSE.md> Apache 2.0
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

        $this->setupAssets($this->app['asset']);

        $this->setupRoutes($this->app['router']);
    }

    /**
     * Setup the assets.
     *
     * @param \Lightgear\Asset $asset
     *
     * @return void
     */
    protected function setupAssets(Asset $asset)
    {
        $asset->registerScripts(['graham-campbell/cloudflare/src/assets/js/cloudflare.js'], '', 'cloudflare');
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
                ->connection($app['config']['graham-campbell/cloudflare::connection'])
                ->zone($app['config']['graham-campbell/cloudflare::zone']);

            $store = $app['cache']
                ->driver($app['config']['graham-campbell/cloudflare::driver'])
                ->getStore();

            $key = $app['config']['graham-campbell/cloudflare::key'];

            $middleware = $app['config']['graham-campbell/cloudflare::middleware'];

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
