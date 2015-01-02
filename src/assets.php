<?php

/*
 * This file is part of Laravel CloudFlare.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Lightgear\Asset\Facades\Asset;

Asset::registerScripts([
    'graham-campbell/cloudflare/src/assets/js/cloudflare.js',
], '', 'cloudflare');
