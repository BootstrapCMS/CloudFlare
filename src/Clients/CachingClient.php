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

use Illuminate\Contracts\Cache\Repository;

/**
 * This is the caching client class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class CachingClient implements ClientInterface
{
    /**
     * The underlying client instance.
     *
     * @var \GrahamCampbell\CloudFlare\Clients\ClientInterface
     */
    protected $client;

    /**
     * The illuminate cache repository instance.
     *
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * The email address used.
     *
     * @var string
     */
    protected $email;

    /**
     * Create a new caching client instance.
     *
     * @param \GrahamCampbell\CloudFlare\Clients\ClientInterface $client
     * @param \Illuminate\Contracts\Cache\Repository             $cache
     * @param string                                             $email
     *
     * @return void
     */
    public function __construct(ClientInterface $client, Repository $cache, $email)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->email = $email;
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
        return $this->cache->remember(sha1($this->email.json_encode($params)), 720, function () use ($zone, $params) {
            return $this->client->get($zone, $params);
        });
    }
}
