<?php

namespace AlazziAz\OdooXmlrpc;

use AlazziAz\OdooXmlrpc\Contracts\OdooClientContract;
use AlazziAz\OdooXmlrpc\Enums\EndPoints;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\HttpFactory as GuzzlePsr7Factory;
use Laminas\XmlRpc\Client;

class Odoo
{
    /**
     * Creates a new Odoo Client instance.
     */
    public static function client(string $url, string $suffix, string $db, string $username, string $password): OdooClientContract
    {
        $psr17  = new GuzzlePsr7Factory();
        $httpClient   = new GuzzleClient();

        $commonClient = new Client(
            EndPoints::Common->getFullUrl($url, $suffix),
            $httpClient,
            $psr17,
            $psr17
        );
        $objectClient = new Client(
            EndPoints::Object->getFullUrl($url, $suffix),
            $httpClient,
            $psr17,
            $psr17
        );

        return new OdooClient(
            commonClient: $commonClient,
            objectClient: $objectClient,
            db: $db,
            username: $username,
            password: $password,
        );
    }
}
