# invokatis/unifi
A simple client for [UBNT](https://www.ubnt.com/)'s new controller api to perform some basic tasks.

[![Latest Version][latest-version-image]][latest-version-url]
[![Downloads][downloads-image]][downloads-url]
[![PHP Version][php-version-image]][php-version-url]
[![License][license-image]][license-url]

Install
-------
```bash
composer require invokatis/unifi
```

Usage
-----
```php
<?php

$guzzle = new GuzzleHttp\Client([
   'base_uri' => 'https://localhost:8443/',
   'cookies' => true,
]);

/**
 * @desc Create a Unifi\Client and then login to controller.
 */
$client = new Unifi\Client($guzzle);
$client->login('admin_user', 'secret_pass');

/**
 * @desc Get list of connected devices for a site.
 */
$devices = $client->devices('default');

/**
 * @desc Get list of connected guests for a site.
 */
$guests = $client->guests('default');

/**
 * @desc Authorize a guest MAC address for 10 minutes.
 */
$client->authorize('default', '6f:d7:b9:7f:4e:61', 10);

/**
 * @desc Un-authorize a guest MAC address.
 */
$client->unauthorize('default', '6f:d7:b9:7f:4e:61');

/**
 * @desc Update WLAN configuration for a site & a provided WLAN ID.
 */
$client->wlanconf('default', 'dd982884edf68487cb8ff664b3dfdf12', [
    'name' => 'My New SSID',
]);

/**
 * @desc Reboot an access point.
 */
$client->reboot('default', '6f:d7:b9:7f:4e:61');

/**
 * @desc You can logout when you are done.
 */
$client->logout();
```

License
------
See [LICENSE.md][license-url] file.

[latest-version-image]: https://img.shields.io/github/release/invokatis/unifi.svg?style=flat-square
[latest-version-url]: https://github.com/invokatis/unifi/releases
[downloads-image]: https://img.shields.io/packagist/dt/invokatis/unifi.svg?style=flat-square
[downloads-url]: https://packagist.org/packages/invokatis/unifi
[php-version-image]: http://img.shields.io/badge/php-5.4+-8892be.svg?style=flat-square
[php-version-url]: https://packagist.org/packages/invokatis/unifi
[license-image]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[license-url]: LICENSE.md
