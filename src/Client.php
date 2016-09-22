<?php

/*
 * This file is part of vaibhavpandeyvpz/unifi-api package.
 *
 * (c) Vaibhav Pandey <contact@vaibhavpandey.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.md.
 */

namespace Unifi\Api;

use GuzzleHttp\Client as Guzzle;

/**
 * Class Client
 * @package Unifi\Api
 */
class Client implements ClientInterface
{
    /**
     * @var Guzzle
     */
    protected $client;

    /**
     * Client constructor.
     * @param Guzzle $client
     */
    public function __construct(Guzzle $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function authorize($site, $mac, $minutes, $speed = 0, $bandwidth = 0)
    {
        $data = [
            'cmd' => 'authorize-guest',
            'mac' => $mac,
            'minutes' => $minutes,
        ];
        if ($speed > 0) {
            $data['up'] = $speed;
            $data['down'] = $speed;
        }
        if ($bandwidth > 0) {
            $data['bytes'] = $bandwidth;
        }
        return $this->post("/api/s/{$site}/cmd/stamgr", $data) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function block($site, $mac)
    {
        return $this->post("/api/s/{$site}/%s/cmd/stamgr", [
            'cmd' => 'block-sta',
            'mac' => $mac,
        ]) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function devices($site)
    {
        $response = $this->get("/api/s/{$site}/stat/device");
        return $response ? $response->data : [];
    }

    /**
     * {@inheritdoc}
     */
    public function get($path, array $data = [])
    {
        $response = $this->client->request('GET', $path, [ 'query' => $data ]);
        if ($response->getStatusCode() == 200) {
            $json = json_decode($response->getBody());
            if ($json->meta->rc === 'ok') {
                return $json;
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function guests($site)
    {
        $response = $this->get("/api/s/{$site}/stat/sta");
        return $response ? $response->data : [];
    }

    /**
     * {@inheritdoc}
     */
    public function login($username, $password)
    {
        return $this->post('/api/login', [
            'username' => $username,
            'password' => $password,
        ]) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function logout()
    {
        $this->get('/api/logout');
    }

    /**
     * {@inheritdoc}
     */
    public function reboot($site, $mac)
    {
        return $this->post("/api/s/{$site}/cmd/devmgr", [
            'cmd' => 'restart',
            'mac' => $mac,
        ]) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function post($path, $data = null)
    {
        $response = $this->client->request('POST', $path, [ 'json' => $data ]);
        if ($response->getStatusCode() == 200) {
            $json = json_decode($response->getBody());
            if ($json->meta->rc === 'ok') {
                return $json;
            }
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function unauthorize($site, $mac)
    {
        return $this->post("/api/s/{$site}/cmd/stamgr", [
            'cmd' => 'unauthorize-guest',
            'mac' => $mac,
        ]) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function wlanconf($site, $wlan, $data)
    {
        return $this->post("/api/s/{$site}/upd/wlanconf/{$wlan}", $data) !== false;
    }
}
