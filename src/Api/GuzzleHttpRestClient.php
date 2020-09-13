<?php

namespace Grongor\KafkaRest\Api;

use GuzzleHttp\Client as GuzzleHttpClient;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use Http\Factory\Guzzle\UriFactory;
use JMS\Serializer\SerializerBuilder;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;

/**
 * Guzzle based HTTP-REST client for Kakfa REST proxy
 *
 * @package Grongor\KafkaRest\Api
 * @author Waseem Ahmed <wasim.ahmed@careem.com>
 */
class GuzzleHttpRestClient extends HttpRestClient
{
    /**
     * Constructor
     *
     * @param string $apiUri Base URL for Kafka REST proxy
     * @param GuzzleHttpClient|null $client
     * @param LoggerInterface|null $logger
     */
    public function __construct(string $apiUri, GuzzleHttpClient $client = null, LoggerInterface $logger = null)
    {
        if ($client == null) {
            $client = new GuzzleHttpClient();
        }

        if ($logger === null) {
            $logger = new NullLogger();
        }

        $requestFactory = new RequestFactory();
        $streamFactory = new StreamFactory();
        $uriFactory = new UriFactory();
        $serializer = SerializerBuilder::create()->build();

        parent::__construct($client, $logger, $requestFactory, $serializer, $streamFactory, $uriFactory, $apiUri);
    }
}