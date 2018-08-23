<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\AdyenApi\AdyenApiDependencyProvider;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdjustAuthorizationAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Adapter\Authorize3dAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AuthorizeAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CancelAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CancelOrRefundAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CaptureAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\GetPaymentMethodsAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\MakePaymentAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\PaymentsDetailsAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\RefundAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\TechnicalCancelAdapter;
use SprykerEco\Zed\AdyenApi\Business\Converter\AdjustAuthorizationConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\Authorize3dConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\AuthorizeConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\CancelConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\CancelOrRefundConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\CaptureConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\GetPaymentMethodsConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\MakePaymentConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\PaymentsDetailsConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\RefundConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\TechnicalCancelConverter;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdjustAuthorizationMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;
use SprykerEco\Zed\AdyenApi\Business\Mapper\Authorize3dMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AuthorizeMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\CancelMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\CancelOrRefundMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\CaptureMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\GetPaymentMethodsMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\MakePaymentMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\PaymentsDetailsMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\RefundMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\TechnicalCancelMapper;
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
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createPaymentsDetailsRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createPaymentsDetailsAdapter(),
            $this->createPaymentsDetailsConverter(),
            $this->createPaymentsDetailsMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createAuthorizeRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createAuthorizeAdapter(),
            $this->createAuthorizeConverter(),
            $this->createAuthorizeMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createAuthorize3dRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createAuthorize3dAdapter(),
            $this->createAuthorize3dConverter(),
            $this->createAuthorize3dMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createCaptureRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createCaptureAdapter(),
            $this->createCaptureConverter(),
            $this->createCaptureMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createCancelRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createCancelAdapter(),
            $this->createCancelConverter(),
            $this->createCancelMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createRefundRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createRefundAdapter(),
            $this->createRefundConverter(),
            $this->createRefundMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createCancelOrRefundRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createCancelOrRefundAdapter(),
            $this->createCancelOrRefundConverter(),
            $this->createCancelOrRefundMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createTechnicalCancelRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createTechnicalCancelAdapter(),
            $this->createTechnicalCancelConverter(),
            $this->createTechnicalCancelMapper(),
            $this->getConfig()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiRequestInterface
     */
    public function createAdjustAuthorizationRequest(): AdyenApiRequestInterface
    {
        return new AdyenApiRequest(
            $this->createAdjustAuthorizationAdapter(),
            $this->createAdjustAuthorizationConverter(),
            $this->createAdjustAuthorizationMapper(),
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
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createPaymentsDetailsAdapter(): AdyenApiAdapterInterface
    {
        return new PaymentsDetailsAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createAuthorizeAdapter(): AdyenApiAdapterInterface
    {
        return new AuthorizeAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createAuthorize3dAdapter(): AdyenApiAdapterInterface
    {
        return new Authorize3dAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createCaptureAdapter(): AdyenApiAdapterInterface
    {
        return new CaptureAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createCancelAdapter(): AdyenApiAdapterInterface
    {
        return new CancelAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createRefundAdapter(): AdyenApiAdapterInterface
    {
        return new RefundAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createCancelOrRefundAdapter(): AdyenApiAdapterInterface
    {
        return new CancelOrRefundAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createTechnicalCancelAdapter(): AdyenApiAdapterInterface
    {
        return new TechnicalCancelAdapter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    public function createAdjustAuthorizationAdapter(): AdyenApiAdapterInterface
    {
        return new AdjustAuthorizationAdapter(
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
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createPaymentsDetailsConverter(): AdyenApiConverterInterface
    {
        return new PaymentsDetailsConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createAuthorizeConverter(): AdyenApiConverterInterface
    {
        return new AuthorizeConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createAuthorize3dConverter(): AdyenApiConverterInterface
    {
        return new Authorize3dConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createCaptureConverter(): AdyenApiConverterInterface
    {
        return new CaptureConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createCancelConverter(): AdyenApiConverterInterface
    {
        return new CancelConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createRefundConverter(): AdyenApiConverterInterface
    {
        return new RefundConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createCancelOrRefundConverter(): AdyenApiConverterInterface
    {
        return new CancelOrRefundConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createTechnicalCancelConverter(): AdyenApiConverterInterface
    {
        return new TechnicalCancelConverter(
            $this->getConfig(),
            $this->getUtilEncodingService()
        );
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function createAdjustAuthorizationConverter(): AdyenApiConverterInterface
    {
        return new AdjustAuthorizationConverter(
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
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createPaymentsDetailsMapper(): AdyenApiMapperInterface
    {
        return new PaymentsDetailsMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createAuthorizeMapper(): AdyenApiMapperInterface
    {
        return new AuthorizeMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createAuthorize3dMapper(): AdyenApiMapperInterface
    {
        return new Authorize3dMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createCaptureMapper(): AdyenApiMapperInterface
    {
        return new CaptureMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createCancelMapper(): AdyenApiMapperInterface
    {
        return new CancelMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createRefundMapper(): AdyenApiMapperInterface
    {
        return new RefundMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createCancelOrRefundMapper(): AdyenApiMapperInterface
    {
        return new CancelOrRefundMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createTechnicalCancelMapper(): AdyenApiMapperInterface
    {
        return new TechnicalCancelMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function createAdjustAuthorizationMapper(): AdyenApiMapperInterface
    {
        return new AdjustAuthorizationMapper($this->getConfig());
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface
     */
    public function getUtilEncodingService(): AdyenApiToUtilEncodingServiceInterface
    {
        return $this->getProvidedDependency(AdyenApiDependencyProvider::SERVICE_UTIL_ENCODING);
    }
}
