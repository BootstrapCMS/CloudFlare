<?php

/*
 * This file is part of Laravel CloudFlare.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

Route::get('cloudflare', [
    'as'   => 'cloudflare.index',
    'uses' => 'GrahamCampbell\CloudFlare\Controllers\CloudFlareController@getIndex',
]);

Route::get('cloudflare/data', [
    'as'   => 'cloudflare.data',
    'uses' => 'GrahamCampbell\CloudFlare\Controllers\CloudFlareController@getData',
]);
