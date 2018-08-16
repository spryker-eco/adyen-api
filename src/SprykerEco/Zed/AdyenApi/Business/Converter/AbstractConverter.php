<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use Psr\Http\Message\StreamInterface;
use SprykerEco\Zed\AdyenApi\AdyenApiConfig;
use SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface;

abstract class AbstractConverter implements AdyenApiConverterInterface
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected $config;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface
     */
    protected $encodingService;

    /**
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    abstract protected function getResponseTransfer(array $response): AdyenApiResponseTransfer;

    /**
     * @param \SprykerEco\Zed\AdyenApi\AdyenApiConfig $config
     * @param \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface $encodingService
     */
    public function __construct(
        AdyenApiConfig $config,
        AdyenApiToUtilEncodingServiceInterface $encodingService
    ) {
        $this->config = $config;
        $this->encodingService = $encodingService;
    }

    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function convertToResponseTransfer(StreamInterface $response): AdyenApiResponseTransfer
    {
        $decryptedResponse = $this->encodingService->decodeJson($response, true);

        return $this->getResponseTransfer($decryptedResponse);
    }
}
