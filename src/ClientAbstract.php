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

use GuzzleHttp\ClientInterface as Guzzle;

/**
 * Class ClientAbstract
 * @package Unifi
 */
abstract class ClientAbstract implements ClientInterface
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
    public function get($path, array $data = array())
    {
        $response = $this->client->request('GET', $path, array( 'query' => $data ));
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
    public function post($path, $data = null)
    {
        $response = $this->client->request('POST', $path, array( 'json' => $data ));
        if ($response->getStatusCode() == 200) {
            $json = json_decode($response->getBody());
            if ($json->meta->rc === 'ok') {
                return $json;
            }
        }
        return false;
    }
}
