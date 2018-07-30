<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\AdyenApi\AdyenApiDependencyProvider;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Adapter\GetPaymentMethodsAdapter;
use SprykerEco\Zed\AdyenApi\Business\Converter\ConverterInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\GetPaymentMethodsConverter;
use SprykerEco\Zed\AdyenApi\Business\Mapper\GetPaymentMethodsMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\MapperInterface;
use SprykerEco\Zed\AdyenApi\Business\Request\GetPaymentMethodsRequest;
use SprykerEco\Zed\AdyenApi\Business\Request\RequestInterface;
use SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface;

/**
 * @method \SprykerEco\Zed\AdyenApi\AdyenApiConfig getConfig()
 */
class AdyenApiBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\RequestInterface
     */
    public function createGetPaymentMethodsRequest(): RequestInterface
    {
        return new GetPaymentMethodsRequest(
            $this->createGetPaymentMethodsAdapter(),
            $this->createGetPaymentMethodsConverter(),
            $this->createGetPaymentMethodsMapper()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdapterInterface
     */
    protected function createGetPaymentMethodsAdapter(): AdapterInterface
    {
        return new GetPaymentMethodsAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\ConverterInterface
     */
    protected function createGetPaymentMethodsConverter(): ConverterInterface
    {
        return new GetPaymentMethodsConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\MapperInterface
     */
    protected function createGetPaymentMethodsMapper(): MapperInterface
    {
        return new GetPaymentMethodsMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): AdyenApiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(AdyenApiDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
