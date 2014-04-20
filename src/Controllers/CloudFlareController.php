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

namespace GrahamCampbell\CloudFlare\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\View;
use GrahamCampbell\Viewer\Facades\Viewer;
use GrahamCampbell\CloudFlareAPI\Facades\CloudFlareAPI;

/**
 * This is the cloudflare controller class.
 *
 * @package    Laravel-CloudFlare
 * @author     Graham Campbell
 * @copyright  Copyright 2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-CloudFlare/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-CloudFlare
 */
class CloudFlareController extends Controller
{
    /**
     * Create a new instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->beforeFilter('ajax', array('only' => array('getData')));

        $filters = Config::get('graham-campbell/cloudflare::filters');

        if (is_array($filters) && !empty($filters)) {
            foreach ($filters as $filter) {
                $this->beforeFilter($filter, array('only' => array('getIndex', 'getData')));
            }
        }
    }

    /**
     * Display the index page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return Viewer::make('graham-campbell/cloudflare::index', array(), 'admin');
    }

    /**
     * Display a data.
     *
     * @return \Illuminate\Http\Response
     */
    public function getData()
    {
        $stats = CloudFlareAPI::apiStats();
        $data = $stats->json()['response']['result']['objs']['0']['trafficBreakdown'];
        return View::make('graham-campbell/cloudflare::data', array('data' => $data));
    }
}
