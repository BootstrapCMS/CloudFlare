<?php

/*
 * This file is part of Laravel CloudFlare.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

$router->get('cloudflare', ['as' => 'cloudflare.index', 'uses' => 'CloudFlareController@getIndex']);

$router->get('cloudflare/data', ['as' => 'cloudflare.data', 'uses' => 'CloudFlareController@getData']);
