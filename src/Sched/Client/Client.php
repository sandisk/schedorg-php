<?php

namespace Sched\Client;

use GuzzleHttp\Client as HttpClient;
use Sched\Request\AbstractRequest;

class Client
{

    /**
     * @var string Sched.org API key
     */
    protected $apiKey;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @var string API endpoint (http://your_conference.sched.org/api)
     */
    protected $baseEndpoint;

    /**
     * @param $apiKey
     * @param $baseEndpoint
     */
    public function __construct($apiKey, $baseEndpoint)
    {
        $this->apiKey       = $apiKey;
        $this->baseEndpoint = $baseEndpoint;
        $this->client       = new HttpClient();
    }

    /**
     * @param AbstractRequest $request
     * @return \Sched\Response\AbstractResponse
     */
    public function performRequest(AbstractRequest $request)
    {
        $httpResponse = $this->post($request->getApiEndpoint(), $request->getData());
        $response     = $request->getResponseObject();
        $response->setResponse($httpResponse);

        return $response;
    }

    /**
     * @param string $uri
     * @param array  $data
     * @return \GuzzleHttp\Message\ResponseInterface
     */
    protected function post($uri, $data = [])
    {
        $fullUri = $this->getEndpointUri($uri);
        $data    = array_merge($data, [
            'api_key' => $this->apiKey
        ]);

        return $this->client->post($fullUri, $this->getOptions($data));
    }

    /**
     * @param array $data
     * @return array
     */
    protected function getOptions($data = [])
    {
        return [
            'body'    => $data,
            'headers' => [
                'Accept' => 'application/json'
            ]
        ];
    }

    /**
     * @param $endpoint
     * @return string
     */
    protected function getEndpointUri($endpoint)
    {
        return sprintf('%s/%s', $this->baseEndpoint, $endpoint);
    }
}