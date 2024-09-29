<?php

namespace Nicelizhi\Airwallex;

use Nicelizhi\Airwallex\Exception\ApiException;
use Nicelizhi\Airwallex\Exception\InvalidArgumentException;
use Nicelizhi\Airwallex\Exception\RuntimeException;
use Nicelizhi\Airwallex\HttpClient\HttpClientInterface;
use Nicelizhi\Airwallex\Util\Util;

use GuzzleHttp\Client as GuzzleHttpClient;




class Airwallex
{
    const VERSION = '1.0.0';

    const API_BASE = 'https://api.airwallex.com';

    const API_VERSION = 'v1';

    const API_URL = self::API_BASE . '/' . self::API_VERSION;

    private $apiKey;

    private $apiBase;

    private $env; 

    private $httpClient;



    public function __construct($apiKey = null, $env = null, $apiBase = null)
    {
        $this->apiKey = $apiKey;
        $this->apiBase = $apiBase ?: self::API_BASE;
        $this->env = $env;

        if(empty($this->httpClient)) {
            $this->httpClient = new GuzzleHttpClient(
                [
                    'base_uri' => $this->apiBase,
                    'headers' => [
                        'Content-Type' => 'application/json',
                        'Charset' => 'UTF-8',
                        'Authorization' => 'Bearer ' . $this->getToken()
                    ]
                ]
            );
        }
        
    }

    public function getToken()
    {
        
    }
}