<?php

/*
 * This file is part of Laravel CloudFlare.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlare\Http\Controllers;

use GrahamCampbell\CloudFlareAPI\Models\Zone;
use GrahamCampbell\Core\Http\Middleware\Ajax;
use Illuminate\Cache\StoreInterface;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\View;

/**
 * This is the cloudflare controller class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
     * @param string[]                                  $middleware
     *
     * @return void
     */
    public function __construct(Zone $zone, StoreInterface $store, $key, array $middleware)
    {
        $this->zone = $zone;
        $this->store = $store;
        $this->key = $key;

        $this->middleware(Ajax::class, ['only' => ['getData']]);

        foreach ($middleware as $class) {
            $this->middleware($class);
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

        return View::make('graham-campbell/cloudflare::index', ['data' => $data]);
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

        return View::make('graham-campbell/cloudflare::data', ['data' => $data]);
    }
}
