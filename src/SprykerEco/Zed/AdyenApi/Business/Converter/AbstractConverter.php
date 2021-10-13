<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiErrorResponseTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use Psr\Http\Message\ResponseInterface;
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
     * @param \Generated\Shared\Transfer\AdyenApiResponseTransfer $responseTransfer
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    abstract protected function updateResponseTransfer(AdyenApiResponseTransfer $responseTransfer, array $response): AdyenApiResponseTransfer;

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
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function convertToResponseTransfer(?ResponseInterface $response = null, $isSuccess = true): AdyenApiResponseTransfer
    {
        $responseBody = $response ? $this->encodingService->decodeJson($response->getBody(), true) : [];
        $responseTransfer = new AdyenApiResponseTransfer();
        $responseTransfer->setIsSuccess($isSuccess);

        if ($isSuccess) {
            return $this->updateResponseTransfer($responseTransfer, $responseBody);
        }

        $error = (new AdyenApiErrorResponseTransfer())->fromArray($responseBody, true);
        $responseTransfer->setError($error);

        return $responseTransfer;
    }
}
