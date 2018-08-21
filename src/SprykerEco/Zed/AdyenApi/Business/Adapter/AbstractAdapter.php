<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use SprykerEco\Zed\AdyenApi\AdyenApiConfig;
use SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface;

abstract class AbstractAdapter implements AdyenApiAdapterInterface
{
    protected const DEFAULT_TIMEOUT = 45;
    protected const HEADER_CONTENT_TYPE_KEY = 'Content-Type';
    protected const HEADER_CONTENT_TYPE_VALUE = 'application/json';
    protected const HEADER_X_API_KEY = 'X-API-Key';

    /**
     * @var \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected $config;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface
     */
    protected $encodingService;

    /**
     * @var \GuzzleHttp\Client
     */
    protected $client;

    /**
     * @return string
     */
    abstract protected function getUrl(): string;

    /**
     * @param \SprykerEco\Zed\AdyenApi\AdyenApiConfig $config
     * @param \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface $encodingService
     */
    public function __construct(
        AdyenApiConfig $config,
        AdyenApiToUtilEncodingServiceInterface $encodingService
    ) {
        $this->client = new Client([
            RequestOptions::TIMEOUT => static::DEFAULT_TIMEOUT,
            RequestOptions::HEADERS => [
                static::HEADER_CONTENT_TYPE_KEY => static::HEADER_CONTENT_TYPE_VALUE,
                static::HEADER_X_API_KEY => $config->getApiKey(),
            ],
        ]);

        $this->config = $config;
        $this->encodingService = $encodingService;
    }

    /**
     * @param array $data
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest(array $data): ResponseInterface
    {
        $options[RequestOptions::BODY] = $this->encodingService->encodeJson($data);

        return $this->send($options);
    }

    /**
     * @param array $options
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function send(array $options = []): ResponseInterface
    {
        return $this->client->post(
            $this->getUrl(),
            $options
        );
    }
}
