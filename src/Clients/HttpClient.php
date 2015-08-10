<?php

/*
 * This file is part of Laravel CloudFlare.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\CloudFlare\Clients;

use GuzzleHttp\ClientInterface as GuzzleClient;

/**
 * This is the http client class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class HttpClient implements ClientInterface
{
    /**
     * The client guzzle instance.
     *
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * Create a new http client instance.
     *
     * @param \GuzzleHttp\ClientInterface $client
     *
     * @return void
     */
    public function __construct(GuzzleClient $client)
    {
        $this->client = $client;
    }

    /**
     * Get the analytics data for a given zone.
     *
     * @param string $zone
     * @param array  $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($zone, array $params)
    {
        return $this->client->get("{$zone}/analytics/dashboard", ['query' => $params]);
    }
}
