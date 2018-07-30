<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Request;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\AdyenApi\Business\Mapper\MapperInterface;

abstract class AbstarctRequest implements RequestInterface
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
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function request(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        $requestData = $this->mapper->buildRequest($requestTransfer);

        return $this->sendRequest($requestData);
    }

    /**
     * @param array $requestData
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    protected function sendRequest(array $requestData): AdyenApiResponseTransfer
    {
        $response = $this->adapter->sendRequest($requestData);

        return $this->converter->convertToResponseTransfer($response);
    }
}
