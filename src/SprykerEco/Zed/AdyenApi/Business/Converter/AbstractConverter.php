<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\AdyenApi\AdyenApiConfig;

abstract class AbstractConverter implements ConverterInterface
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected $config;

    /**
     * @param array $response
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    abstract protected function getResponseTransfer(array $response);

    /**
     * @param \SprykerEco\Zed\AdyenApi\AdyenApiConfig $config
     */
    public function __construct(AdyenApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function toTransactionResponseTransfer(StreamInterface $response): TransferInterface
    {
        $decryptedResponse = $this->decryptResponse($response);

        return $this->getResponseTransfer($decryptedResponse);
    }

    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return array
     */
    protected function decryptResponse(StreamInterface $response): array
    {
        parse_str($response->getContents(), $responseHeader);

        $decryptedResponseHeader = $this
            ->computopApiService
            ->decryptResponseHeader($responseHeader, $this->config->getBlowfishPass());

        return $decryptedResponseHeader;
    }
}
