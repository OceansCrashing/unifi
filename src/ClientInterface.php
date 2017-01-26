<?php

/*
 * This file is part of invokatis/unifi package.
 *
 * (c) Invokatis Technologies <admin@invokatis.tech>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Unifi;

/**
 * Interface ClientInterface
 * @package Unifi
 */
interface ClientInterface
{
    /**
     * @param string $site Unique ID of the site
     * @param string $mac MAC address of guest to authorize
     * @param int $minutes Duration for how long the guest will remain connected in minutes
     * @param int $speed Up/down speed allowed in KB/s
     * @param int $bandwidth Maximum data transfer allowed in MBs
     * @return bool
     */
    public function authorize($site, $mac, $minutes, $speed = 0, $bandwidth = 0);

    /**
     * @param string $site
     * @param string $mac
     * @return bool
     */
    public function block($site, $mac);

    /**
     * @param string $site
     * @return array
     */
    public function devices($site);

    /**
     * @param string $path
     * @param array $data
     * @return object|bool
     */
    public function get($path, array $data = array());

    /**
     * @param string $site
     * @return array
     */
    public function guests($site);

    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login($username, $password);

    public function logout();

    /**
     * @param string $path
     * @param array|object|null $data
     * @return object|bool
     */
    public function post($path, $data = null);

    /**
     * @param string $site
     * @param string $mac
     * @return bool
     */
    public function reboot($site, $mac);

    /**
     * @param string $site
     * @param string $mac
     * @return bool
     */
    public function unauthorize($site, $mac);

    /**
     * @param string $site
     * @param string $wlan
     * @param array|object $data
     * @return bool
     */
    public function wlanconf($site, $wlan, $data);
}
