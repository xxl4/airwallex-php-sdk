<?php
namespace Nicelizhi\Airwallex\Client;

use Nicelizhi\Airwallex\Exception\InvalidApiKeyException;

class ApiKey
{
    /**
     * @var string apiKey
     */
    private $apiKey;
    /**
     * @var string clientId
     */
    private $clientId;
    /**
     * @var string clientSecret
     */
    private $clientSecret;

    /**
     * ApiKey constructor.
     * @param string $apiKey
     */
    public function __construct(
        string $apiKey,
        string $clientId,
        string $clientSecret
    ) {
        $this->initApiKey($apiKey, $clientId, $clientSecret);
    }

    /**
     * @param string $apiKey
     */
    private function initApiKey(string $apiKey, string $clientId, string $clientSecret)
    {
        if (strlen($apiKey) < 5) {
            throw new InvalidApiKeyException('Invalid API key');
        }

        $this->apiKey = $apiKey;
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
    }

    public function __set($name, $value) {
        $this->$name = $value;
    }

    public function __get($name) {
        return $this->$name;
    }
}
