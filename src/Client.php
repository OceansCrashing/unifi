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
 * Class Client
 * @package Unifi
 */
class Client extends ClientAbstract
{
    /**
     * {@inheritdoc}
     */
    public function authorize($site, $mac, $minutes, $speed = 0, $bandwidth = 0)
    {
        $data = array(
            'cmd' => 'authorize-guest',
            'mac' => $mac,
            'minutes' => $minutes,
        );
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
        return $this->post("/api/s/{$site}/%s/cmd/stamgr", array(
            'cmd' => 'block-sta',
            'mac' => $mac,
        )) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function devices($site)
    {
        $response = $this->get("/api/s/{$site}/stat/device");
        return $response ? $response->data : array();
    }

    /**
     * {@inheritdoc}
     */
    public function guests($site)
    {
        $response = $this->get("/api/s/{$site}/stat/guest");
        return $response ? $response->data : array();
    }
    
    /**
     * {@inheritdoc}
     */
    public function clients($site)
    {
        $response = $this->get("/api/s/{$site}/stat/sta");
        return $response ? $response->data : array();
    }

    /**
     * {@inheritdoc}
     */
    public function login($username, $password)
    {
        return $this->post('/api/login', array(
            'username' => $username,
            'password' => $password,
        )) !== false;
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
        return $this->post("/api/s/{$site}/cmd/devmgr", array(
            'cmd' => 'restart',
            'mac' => $mac,
        )) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function unauthorize($site, $mac)
    {
        return $this->post("/api/s/{$site}/cmd/stamgr", array(
            'cmd' => 'unauthorize-guest',
            'mac' => $mac,
        )) !== false;
    }

    /**
     * {@inheritdoc}
     */
    public function wlanconf($site, $wlan, $data)
    {
        return $this->post("/api/s/{$site}/upd/wlanconf/{$wlan}", $data) !== false;
    }
}
