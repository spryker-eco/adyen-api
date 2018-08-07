<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Request;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use SprykerEco\Zed\AdyenApi\AdyenApiConfig;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollectionInterface;
use SprykerEco\Zed\AdyenApi\Business\Exception\AdyenApiRequestMethodNotSpecifiedException;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;
use SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollectionInterface;

abstract class AbstractRequest implements AdyenApiRequestInterface
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected $adapter;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollectionInterface
     */
    protected $converterCollection;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollectionInterface
     */
    protected $mapperCollection;

    /**
     * @var \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected $config;

    /**
     * @var string
     */
    protected $method;

    /**
     * @param \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface $adapter
     * @param \SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollectionInterface $converterCollection
     * @param \SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollectionInterface $mapperCollection
     * @param \SprykerEco\Zed\AdyenApi\AdyenApiConfig $config
     */
    public function __construct(
        AdyenApiAdapterInterface $adapter,
        AdyenApiConverterCollectionInterface $converterCollection,
        AdyenApiMapperCollectionInterface $mapperCollection,
        AdyenApiConfig $config
    ) {
        $this->adapter = $adapter;
        $this->converterCollection = $converterCollection;
        $this->mapperCollection = $mapperCollection;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return void
     */
    abstract protected function setMethod(AdyenApiRequestTransfer $requestTransfer);

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function request(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        $this->setMethod($requestTransfer);
        $requestData = $this->getMapper()->buildRequest($requestTransfer);

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

        return $this->getConverter()->convertToResponseTransfer($response);
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    protected function getConverter(): AdyenApiConverterInterface
    {
        return $this->converterCollection->get($this->getMethod());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    protected function getMapper(): AdyenApiMapperInterface
    {
        return $this->mapperCollection->get($this->getMethod());
    }

    /**
     * @throws \SprykerEco\Zed\AdyenApi\Business\Exception\AdyenApiRequestMethodNotSpecifiedException
     *
     * @return string
     */
    protected function getMethod()
    {
        if (empty($this->method)) {
            throw new AdyenApiRequestMethodNotSpecifiedException(
                sprintf('Request method could not be empty.')
            );
        }

        return $this->method;
    }
}
