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

namespace GrahamCampbell\CloudFlare\Controllers;

use GrahamCampbell\CloudFlareAPI\Models\Zone;
use Illuminate\Cache\StoreInterface;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

/**
 * This is the cloudflare controller class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-CloudFlare/blob/master/LICENSE.md> Apache 2.0
 */
class CloudFlareController extends Controller
{
    /**
     * The zone model instance.
     *
     * @var \GrahamCampbell\CloudFlareAPI\Models\Zone
     */
    protected $zone;

    /**
     * The store instance.
     *
     * @var \Illuminate\Cache\StoreInterface
     */
    protected $store;

    /**
     * The store key.
     *
     * @var string
     */
    protected $key;

    /**
     * Create a new instance.
     *
     * @param \GrahamCampbell\CloudFlareAPI\Models\Zone $zone
     * @param \Illuminate\Cache\StoreInterface          $store
     * @param string                                    $key
     * @param string[]                                  $filters
     *
     * @return void
     */
    public function __construct(Zone $zone, StoreInterface $store, $key, array $filters)
    {
        $this->zone = $zone;
        $this->store = $store;
        $this->key = $key;

        $this->beforeFilter('ajax', array('only' => array('getData')));

        foreach ($filters as $filter) {
            $this->beforeFilter($filter, array('only' => array('getIndex', 'getData')));
        }
    }

    /**
     * Display the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $data = $this->store->get($this->key);

        return View::make('graham-campbell/cloudflare::index', array('data' => $data));
    }

    /**
     * Display the traffic data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $data = $this->zone->getTraffic();

        $this->store->put($this->key, $data, 30);

        return View::make('graham-campbell/cloudflare::data', array('data' => $data));
    }
}
