<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Request;

use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Shared\Kernel\Transfer\TransferInterface;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\AdyenApi\Business\Mapper\MapperInterface;

abstract class AbstarctRequest
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Adapter\AdapterInterface
     */
    protected $adapter;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Converter\ConverterInterface
     */
    protected $converter;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Mapper\MapperInterface
     */
    protected $mapper;

    /**
     * @param \SprykerEco\Zed\AdyenApi\Business\Adapter\AdapterInterface $adapter
     * @param \SprykerEco\Zed\AdyenApi\Business\Converter\ConverterInterface $converter
     * @param \SprykerEco\Zed\AdyenApi\Business\Mapper\MapperInterface $mapper
     */
    public function __construct(
        AdapterInterface $adapter,
        ConverterInterface $converter,
        MapperInterface $mapper
    ) {
        $this->adapter = $adapter;
        $this->converter = $converter;
        $this->mapper = $mapper;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function request(QuoteTransfer $quoteTransfer): TransferInterface
    {
        $requestData = $this->mapper->buildRequest($quoteTransfer);

        return $this->sendRequest($requestData);
    }

    /**
     * @param array $requestData
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    protected function sendRequest(array $requestData): TransferInterface
    {
        $response = $this->adapter->sendRequest($requestData);

        return $this->converter->convertToResponseTransfer($response);
    }
}