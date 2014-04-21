Laravel CloudFlare
==================


[![Build Status](https://img.shields.io/travis/GrahamCampbell/Laravel-CloudFlare/master.svg)](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare)
[![Coverage Status](https://img.shields.io/coveralls/GrahamCampbell/Laravel-CloudFlare/master.svg)](https://coveralls.io/r/GrahamCampbell/Laravel-CloudFlare)
[![Software License](https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg)](https://github.com/GrahamCampbell/Laravel-CloudFlare/blob/master/LICENSE.md)
[![Latest Version](https://img.shields.io/github/release/GrahamCampbell/Laravel-CloudFlare.svg)](https://github.com/GrahamCampbell/Laravel-CloudFlare/releases)
[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare/badges/quality-score.png?s=71ef8ad10b5b4b0a664a82bab0403ce2511b3b7a)](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/265a732f-b8e7-4bc5-b468-224587f3ce8d/mini.png)](https://insight.sensiolabs.com/projects/265a732f-b8e7-4bc5-b468-224587f3ce8d)


## What Is Laravel CloudFlare?

Laravel CloudFlare provides a simple [CloudFlare](https://www.cloudflare.com/) module for [Laravel 4.1](http://laravel.com).

* Laravel CloudFlare was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell).
* Laravel CloudFlare relies on a few of my packages including [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) and [Laravel CloudFlare API](https://github.com/GrahamCampbell/Laravel-CloudFlare-API).
* Laravel CloudFlare uses [Travis CI](https://travis-ci.org/GrahamCampbell/Laravel-CloudFlare) with [Coveralls](https://coveralls.io/r/GrahamCampbell/Laravel-CloudFlare) to check everything is working.
* Laravel CloudFlare uses [Scrutinizer CI](https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-CloudFlare) and [SensioLabsInsight](https://insight.sensiolabs.com/projects/265a732f-b8e7-4bc5-b468-224587f3ce8d) to run additional checks.
* Laravel CloudFlare uses [Composer](https://getcomposer.org) to load and manage dependencies.
* Laravel CloudFlare provides a [change log](https://github.com/GrahamCampbell/Laravel-CloudFlare/blob/master/CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-CloudFlare/releases), and [api docs](http://grahamcampbell.github.io/Laravel-CloudFlare).
* Laravel CloudFlare is licensed under the Apache License, available [here](https://github.com/GrahamCampbell/Laravel-CloudFlare/blob/master/LICENSE.md).


## System Requirements

* PHP 5.4.7+ or HHVM 3.0+ is required.
* You will need [Laravel 4.1](http://laravel.com) because this package is designed for it.
* You will need [Composer](https://getcomposer.org) installed to load the dependencies of Laravel CloudFlare.


## Installation

Please check the system requirements before installing Laravel CloudFlare.

To get the latest version of Laravel CloudFlare, simply require `"graham-campbell/cloudflare": "0.1.*@dev"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

You will need to register a few service providers before you attempt to load the Laravel CloudFlare service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'Lightgear\Asset\AssetServiceProvider'`
* `'GrahamCampbell\Core\CoreServiceProvider'`
* `'GrahamCampbell\Viewer\ViewerServiceProvider'`
* `'GrahamCampbell\CoreAPI\CoreAPIServiceProvider'`
* `'GrahamCampbell\CloudFlareAPI\CloudFlareAPIServiceProvider'`

Once Laravel CloudFlare is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\CloudFlare\CloudFlareServiceProvider'`


## Configuration

Laravel CloudFlare supports optional configuration.

To get started, first publish the package config file:

    php artisan config:publish graham-campbell/cloudflare

There is one config option:

**Filters**

This option (`'filters'`) defines the filters to be put in front of the endpoints provided by this package. A common use will be for your own authentication filters. The default value for this setting is `array()`.

**Additional Configuration**

You may want to check out the config for `graham-campbell/cloudflare-api` too.


## Usage

There is currently no usage documentation besides the [API Documentation](http://grahamcampbell.github.io/Laravel-CloudFlare
) for Laravel CloudFlare.

You may see an example of implementation in [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## Updating Your Fork

Before submitting a pull request, you should ensure that your fork is up to date.

You may fork Laravel CloudFlare:

    git remote add upstream git://github.com/GrahamCampbell/Laravel-CloudFlare.git

The first command is only necessary the first time. If you have issues merging, you will need to get a merge tool such as [P4Merge](http://perforce.com/product/components/perforce_visual_merge_and_diff_tools).

You can then update the branch:

    git pull --rebase upstream master
    git push --force origin <branch_name>

Once it is set up, run `git mergetool`. Once all conflicts are fixed, run `git rebase --continue`, and `git push --force origin <branch_name>`.


## Pull Requests

Please review these guidelines before submitting any pull requests.

* When submitting bug fixes, check if a maintenance branch exists for an older series, then pull against that older branch if the bug is present in it.
* Before sending a pull request for a new feature, you should first create an issue with [Proposal] in the title.
* Please follow the [PSR-2 Coding Style](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md) and [PHP-FIG Naming Conventions](https://github.com/php-fig/fig-standards/blob/master/bylaws/002-psr-naming-conventions.md).


## License

Apache License

Copyright 2014 Graham Campbell

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
