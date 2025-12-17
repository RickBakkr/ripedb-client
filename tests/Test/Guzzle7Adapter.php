<?php

namespace Test;

use Dormilich\WebService\Adapter\ClientAdapter;
use GuzzleHttp\Client;

class Guzzle7Adapter implements ClientAdapter
{
    protected $client;

    protected $baseUri;

    /**
     * Create instance.
     *
     * @param array $options Guzzle configuration options.
     * @return self
     */
    public function __construct(array $options)
    {
        $this->client = new Client($options);
    }

    /**
     * Set the Guzzle base URI.
     *
     * @param string $uri Base URI to use.
     * @return void
     */
<<<<<<< HEAD:tests/Test/Guzzle7Adapter.php
    public function setBaseUri($uri): void
=======
    public function setBaseUri(string $uri)
>>>>>>> 691d25e14afbc701f68cd9599992b45d56f67c26:tests/Test/Guzzle6Adapter.php
    {
        $this->baseUri = $uri;
    }

    /**
     * Send a request to the targeted API URI and return the JSON parsed response body.
     *
     * @param string $method HTTP method.
     * @param string $path Request path.
     * @param string $body Request body.
     * @return array JSON parsed response body.
     */
<<<<<<< HEAD:tests/Test/Guzzle7Adapter.php
    public function request($method, $path, array $headers = NULL, $body = NULL): string
=======
    public function request(string $method, string $path, array $headers = NULL, $body = NULL): string
>>>>>>> 691d25e14afbc701f68cd9599992b45d56f67c26:tests/Test/Guzzle6Adapter.php
    {
        $options = [
            'base_uri' => $this->baseUri
        ];

        if (is_string($body)) {
            $options['body'] = $body;
        }
        elseif (is_array($body) or ($body instanceof \JsonSerializable)) {
            $options['json'] = $body;
        }

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        $response = $this->client->request($method, $path, $options);

        return $response->getBody();
    }
}
