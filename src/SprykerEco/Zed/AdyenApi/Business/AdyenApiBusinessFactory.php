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
use SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollection;
use SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollectionInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\CreditCard\MakePaymentCreditCardConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\GetPaymentMethods\GetPaymentMethodsConverter;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;
use SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollection;
use SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollectionInterface;
use SprykerEco\Zed\AdyenApi\Business\Mapper\CreditCard\MakePaymentCreditCardMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\GetPaymentMethods\GetPaymentMethodsMapper;
use SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface;
use SprykerEco\Zed\AdyenApi\Business\Request\GetPaymentMethodsRequest;
use SprykerEco\Zed\AdyenApi\Business\Request\MakePaymentRequest;
use SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiRequestValidatorInterface;
use SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiResponseValidatorInterface;
use SprykerEco\Zed\AdyenApi\Business\Validator\CreditCard\Request\MakePaymentCreditCardRequestValidator;
use SprykerEco\Zed\AdyenApi\Business\Validator\CreditCard\Request\MakePaymentCreditCardResponseValidator;
use SprykerEco\Zed\AdyenApi\Business\Validator\GetPaymentMethods\Request\GetPaymentMethodsRequestValidator;
use SprykerEco\Zed\AdyenApi\Business\Validator\GetPaymentMethods\Request\GetPaymentMethodsResponseValidator;
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
        return new GetPaymentMethodsRequest(
            $this->createGetPaymentMethodsAdapter(),
            $this->createGetPaymentMethodsConverterCollection(),
            $this->createGetPaymentMethodsMapperCollection(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createMakePaymentRequest(): AdyenApiRequestInterface
    {
        return new MakePaymentRequest(
            $this->createMakePaymentAdapter(),
            $this->createMakePaymentConverterCollection(),
            $this->createMakePaymentMapperCollection(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollectionInterface
     */
    protected function createGetPaymentMethodsConverterCollection(): AdyenApiConverterCollectionInterface
    {
        $collection = new AdyenApiConverterCollection();
        $collection->add($this->getConfig()->getPaymentMethodsKey(), $this->createGetPaymentMethodsConverter());

        return $collection;
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollectionInterface
     */
    protected function createMakePaymentConverterCollection(): AdyenApiConverterCollectionInterface
    {
        $collection = new AdyenApiConverterCollection();
        $collection->add($this->getConfig()->getCreditCardPaymentMethod(), $this->createMakePaymentCreditCardConverter());

        return $collection;
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollectionInterface
     */
    protected function createGetPaymentMethodsMapperCollection(): AdyenApiMapperCollectionInterface
    {
        $collection = new AdyenApiMapperCollection();
        $collection->add($this->getConfig()->getPaymentMethodsKey(), $this->createGetPaymentMethodsMapper());

        return $collection;
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollectionInterface
     */
    protected function createMakePaymentMapperCollection(): AdyenApiMapperCollectionInterface
    {
        $collection = new AdyenApiMapperCollection();
        $collection->add($this->getConfig()->getCreditCardPaymentMethod(), $this->createMakePaymentCreditCardMapper());

        return $collection;
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createGetPaymentMethodsAdapter(): AdyenApiAdapterInterface
    {
        return new GetPaymentMethodsAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createMakePaymentAdapter(): AdyenApiAdapterInterface
    {
        return new MakePaymentAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    protected function createGetPaymentMethodsConverter(): AdyenApiConverterInterface
    {
        return new GetPaymentMethodsConverter(
            $this->getConfig(),
            $this->createGetPaymentMethodsResponseValidator(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    protected function createMakePaymentCreditCardConverter(): AdyenApiConverterInterface
    {
        return new MakePaymentCreditCardConverter(
            $this->getConfig(),
            $this->createMakePaymentCreditCardResponseValidator(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    protected function createGetPaymentMethodsMapper(): AdyenApiMapperInterface
    {
        return new GetPaymentMethodsMapper(
            $this->getConfig(),
            $this->createGetPaymentMethodsRequestValidator()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    protected function createMakePaymentCreditCardMapper(): AdyenApiMapperInterface
    {
        return new MakePaymentCreditCardMapper(
            $this->getConfig(),
            $this->createMakePaymentCreditCardRequestValidator()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiRequestValidatorInterface
     */
    protected function createGetPaymentMethodsRequestValidator(): AdyenApiRequestValidatorInterface
    {
        return new GetPaymentMethodsRequestValidator();
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiResponseValidatorInterface
     */
    protected function createGetPaymentMethodsResponseValidator(): AdyenApiResponseValidatorInterface
    {
        return new GetPaymentMethodsResponseValidator();
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiRequestValidatorInterface
     */
    protected function createMakePaymentCreditCardRequestValidator(): AdyenApiRequestValidatorInterface
    {
        return new MakePaymentCreditCardRequestValidator();
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiResponseValidatorInterface
     */
    protected function createMakePaymentCreditCardResponseValidator(): AdyenApiResponseValidatorInterface
    {
        return new MakePaymentCreditCardResponseValidator();
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface
     */
    protected function getUtilEncodingService(): AdyenApiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(AdyenApiDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
