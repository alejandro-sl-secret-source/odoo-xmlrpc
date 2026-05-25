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
        $httpClient   = new GuzzleClient();
        $httpFactory  = new GuzzlePsr7Factory();

        $commonClient = new Client(
            EndPoints::Common->getFullUrl($url, $suffix),
            $httpClient,
            $httpFactory,
            $httpFactory
        );
        $objectClient = new Client(
            EndPoints::Object->getFullUrl($url, $suffix),
            $httpClient,
            $httpFactory,
            $httpFactory
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
