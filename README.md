# vaibhavpandeyvpz/unifi-api
A simple client for [UBNT](https://www.ubnt.com/)'s new controller api to perform some basic tasks.

[![Latest Version](https://img.shields.io/github/release/vaibhavpandeyvpz/unifi-api.svg?style=flat-square)](https://github.com/vaibhavpandeyvpz/unifi-api/releases) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/vaibhavpandeyvpz/unifi-api/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/vaibhavpandeyvpz/unifi-api/?branch=master) [![Total Downloads](https://img.shields.io/packagist/dt/vaibhavpandeyvpz/unifi-api.svg?style=flat-square)](https://packagist.org/packages/vaibhavpandeyvpz/unifi-api) [![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

Install
-------
```bash
composer require vaibhavpandeyvpz/unifi-api
```

Usage
-----
```php
<?php

/**
 * @desc Create a new api client instance and login to
 *      controller using username & password.
 */
$guzzle = new GuzzleHttp\Client([
   'base_uri' => 'https://localhost:8443/',
   'cookies' => true,
]);

$client = new Unifi\Api\Client($guzzle);
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
 * @desc Update WLAN configuration for a site & a provided
 *      WLAN ID.
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
See [LICENSE.md](https://github.com/vaibhavpandeyvpz/unifi-api/blob/master/LICENSE.md) file.
