<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\AdyenApi\AdyenApiDependencyProvider;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Adapter\GetPaymentMethodsAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\MakePaymentAdapter;
use SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\GetPaymentMethodsConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\MakePaymentConverter;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;
use SprykerEco\Zed\AdyenApi\Business\Mapper\GetPaymentMethodsMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\MakePaymentMapper;
use SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequest;
use SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface;
use SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface;

/**
 * @method \SprykerEco\Zed\AdyenApi\AdyenApiConfig getConfig()
 */
class AdyenApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createGetPaymentMethodsRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createGetPaymentMethodsAdapter(),
            $this->createGetPaymentMethodsConverter(),
            $this->createGetPaymentMethodsMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createMakePaymentRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createMakePaymentAdapter(),
            $this->createMakePaymentConverter(),
            $this->createMakePaymentMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createGetPaymentMethodsAdapter(): AdyenApiAdapterInterface
    {
        return new GetPaymentMethodsAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createMakePaymentAdapter(): AdyenApiAdapterInterface
    {
        return new MakePaymentAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createGetPaymentMethodsConverter(): AdyenApiConverterInterface
    {
        return new GetPaymentMethodsConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createMakePaymentConverter(): AdyenApiConverterInterface
    {
        return new MakePaymentConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createGetPaymentMethodsMapper(): AdyenApiMapperInterface
    {
        return new GetPaymentMethodsMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createMakePaymentMapper(): AdyenApiMapperInterface
    {
        return new MakePaymentMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): AdyenApiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(AdyenApiDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
