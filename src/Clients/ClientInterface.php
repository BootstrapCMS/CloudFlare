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

/**
 * This is the client interface.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
interface ClientInterface
{
    /**
     * Get the analytics data for a given zone.
     *
     * @param string $zone
     * @param array  $params
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($zone, array $params);
}
