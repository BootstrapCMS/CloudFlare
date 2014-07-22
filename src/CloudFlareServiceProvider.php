<?php

/**
 * This file is part of Laravel CloudFlare by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\CloudFlare;

use Illuminate\Support\ServiceProvider;

/**
 * This is the cloudflare service provider class.
 *
 * @package    Laravel-CloudFlare
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare
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
        return array(
            //
        );
    }
}
