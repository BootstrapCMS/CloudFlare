Laravel CloudFlare
==================

Laravel CloudFlare was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and provides a simple [CloudFlare](https://www.cloudflare.com/) module for [Laravel 5](http://laravel.com). It utilises a few of my packages including [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) and [Laravel CloudFlare API](https://github.com/BootstrapCMS/CloudFlare-API). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/BootstrapCMS/CloudFlare/releases), [license](LICENSE), [api docs](http://docs.gjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).

![Laravel CloudFlare](https://cloud.githubusercontent.com/assets/2829600/4432321/c18eb49c-468c-11e4-9f4d-8ece7a481d29.PNG)

<p align="center">
<a href="https://travis-ci.org/BootstrapCMS/CloudFlare"><img src="https://img.shields.io/travis/BootstrapCMS/CloudFlare/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BootstrapCMS/CloudFlare/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/BootstrapCMS/CloudFlare.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/BootstrapCMS/CloudFlare"><img src="https://img.shields.io/scrutinizer/g/BootstrapCMS/CloudFlare.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/BootstrapCMS/CloudFlare/releases"><img src="https://img.shields.io/github/release/BootstrapCMS/CloudFlare.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.3+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel CloudFlare, simply add the following line to the require block of your `composer.json` file:

```
"graham-campbell/cloudflare": "0.3.*"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

You will need to register a few service providers before you attempt to load the Laravel CloudFlare service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'Lightgear\Asset\AssetServiceProvider'`
* `'GrahamCampbell\Core\CoreServiceProvider'`
* `'GrahamCampbell\CloudFlareAPI\CloudFlareAPIServiceProvider'`

Once Laravel CloudFlare is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\CloudFlare\CloudFlareServiceProvider'`

#### Looking for a laravel 4 compatable version?

Checkout the [0.2 branch](https://github.com/BootstrapCMS/CloudFlare/tree/0.2), installable by requiring `"graham-campbell/cloudflare": "0.2.*"`.


## Configuration

Laravel CloudFlare supports optional configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/cloudflare.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are a few config options:

##### Middleware

This option (`'middlware'`) defines the middleware to be put in front of the endpoints provided by this package. A common use will be for your own authentication middleware. The default value for this setting is `[]`.

##### Connection

This option (`'connection'`) defines the connection to use for api calls to CloudFlare. Set this to null to use the default connection, or specify a connection name as defined in your cloudflare-api config file. The default value for this setting is `null`.

##### Zone

This option (`'zone'`) defines the zone to use for api calls to CloudFlare. The default value for this setting is `'example.com'`.

##### Cache Driver

This option (`'driver'`) defines the cache driver to be used. It may be the name of any driver set in config/cache.php. Setting it to null will use the driver you have set as default in config/cache.php. The default value for this setting is `null`.

##### Cache Key

This option (`'key'`) defines the cache key to be used for storing the stats cache. The default value for this setting is `'cloudflarestats'`.


##### Additional Configuration

You may want to check out the config for both `graham-campbell/cloudflare-api` and `graham-campbell/core` too.


## Usage

Laravel CloudFlare is designed to work with [Bootstrap CMS](https://github.com/BootstrapCMS/CMS). In order for it to work in any Laravel application, you must ensure that you know how to use my [Laravel Core](https://github.com/GrahamCampbell/Laravel-Core) package as configuration and knowledge of the `app:install` and `app:update ` commands is required.

Laravel CloudFlare will register two routes. `'cloudflare'` (`cloudflare.index`) should be accessed to show the CloudFlare statistics page, and `'cloudflare/data'` (`cloudflare.data`) is internally used by this package.

The internals of Laravel CloudFlare are not documented here, but feel free to check out the [API Documentation](http://docs.gjcampbell.co.uk).


## License

Laravel CloudFlare is licensed under [The MIT License (MIT)](LICENSE).
