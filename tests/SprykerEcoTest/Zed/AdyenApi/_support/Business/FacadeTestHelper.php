<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\AdyenApi\Business;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\AdyenApiAmountTransfer;
use Generated\Shared\Transfer\AdyenApiCancelOrRefundRequestTransfer;
use Generated\Shared\Transfer\AdyenApiCancelRequestTransfer;
use Generated\Shared\Transfer\AdyenApiCaptureRequestTransfer;
use Generated\Shared\Transfer\AdyenApiGetPaymentMethodsRequestTransfer;
use Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer;
use Generated\Shared\Transfer\AdyenApiPaymentsDetailsRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRefundRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use Spryker\Service\UtilEncoding\UtilEncodingService;
use SprykerEco\Zed\AdyenApi\AdyenApiConfig;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CancelAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CancelOrRefundAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CaptureAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\GetPaymentMethodsAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\MakePaymentAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\PaymentsDetailsAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\RefundAdapter;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiBusinessFactory;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiFacade;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiFacadeInterface;
use SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceBridge;
use SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface;

class FacadeTestHelper extends Test
{
    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\AdyenApiFacadeInterface
     */
    public function createFacade(): AdyenApiFacadeInterface
    {
        $facade = (new AdyenApiFacade())
            ->setFactory($this->createFactory());

        return $facade;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\AdyenApi\Business\AdyenApiBusinessFactory
     */
    public function createFactory(): AdyenApiBusinessFactory
    {
        $builder = $this->getMockBuilder(AdyenApiBusinessFactory::class);
        $builder->setMethods(
            [
                'getConfig',
                'getUtilEncodingService',
                'createGetPaymentMethodsAdapter',
                'createMakePaymentAdapter',
                'createPaymentsDetailsAdapter',
                'createCaptureAdapter',
                'createCancelAdapter',
                'createRefundAdapter',
                'createCancelOrRefundAdapter',
            ]
        );

        $stub = $builder->getMock();
        $stub->method('getConfig')
            ->willReturn($this->createConfig());
        $stub->method('getUtilEncodingService')
            ->willReturn($this->createUtilEncodingService());
        $stub->method('createGetPaymentMethodsAdapter')
            ->willReturn($this->createGetPaymentMethodsAdapter());
        $stub->method('createMakePaymentAdapter')
            ->willReturn($this->createMakePaymentAdapter());
        $stub->method('createPaymentsDetailsAdapter')
            ->willReturn($this->createPaymentsDetailsAdapter());
        $stub->method('createCaptureAdapter')
            ->willReturn($this->createCaptureAdapter());
        $stub->method('createCancelAdapter')
            ->willReturn($this->createCancelAdapter());
        $stub->method('createRefundAdapter')
            ->willReturn($this->createRefundAdapter());
        $stub->method('createCancelOrRefundAdapter')
            ->willReturn($this->createCancelOrRefundAdapter());

        return $stub;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiRequestTransfer
     */
    public function createAdyenApiRequestTransfer(): AdyenApiRequestTransfer
    {
        $requestTransfer = (new AdyenApiRequestTransfer())
            ->setPaymentMethodsRequest($this->createGetPaymentMethodsRequestTransfer())
            ->setMakePaymentRequest($this->createMakePaymentRequestTransfer())
            ->setPaymentsDetailsRequest($this->createPaymentsDetailsRequestTransfer())
            ->setCaptureRequest($this->createCaptureRequestTransfer())
            ->setCancelRequest($this->createCancelRequestTransfer())
            ->setRefundRequest($this->createRefundRequestTransfer())
            ->setCancelOrRefundRequest($this->createCancelOrRefundRequestTransfer());

        return $requestTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiGetPaymentMethodsRequestTransfer
     */
    protected function createGetPaymentMethodsRequestTransfer(): AdyenApiGetPaymentMethodsRequestTransfer
    {
        $getPaymentMethodsRequestTransfer = (new AdyenApiGetPaymentMethodsRequestTransfer())
            ->setMerchantAccount(FacadeTestConstants::REQUEST_MERCHANT_ACCOUNT)
            ->setCountryCode(FacadeTestConstants::REQUEST_COUNTRY_CODE)
            ->setAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(FacadeTestConstants::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(FacadeTestConstants::REQUEST_AMOUNT_VALUE)
            )
            ->setChannel(FacadeTestConstants::REQUEST_CHANNEL);

        return $getPaymentMethodsRequestTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer
     */
    protected function createMakePaymentRequestTransfer(): AdyenApiMakePaymentRequestTransfer
    {
        $makePaymentRequestTransfer = (new AdyenApiMakePaymentRequestTransfer())
            ->setMerchantAccount(FacadeTestConstants::REQUEST_MERCHANT_ACCOUNT)
            ->setReference(FacadeTestConstants::REQUEST_REFERENCE)
            ->setAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(FacadeTestConstants::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(FacadeTestConstants::REQUEST_AMOUNT_VALUE)
            )
            ->setReturnUrl(FacadeTestConstants::REQUEST_RETURN_URL)
            ->setCountryCode(FacadeTestConstants::REQUEST_COUNTRY_CODE)
            ->setPaymentMethod(FacadeTestConstants::REQUEST_PAYLOAD_CREDIT_CARD);

        return $makePaymentRequestTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiPaymentsDetailsRequestTransfer
     */
    protected function createPaymentsDetailsRequestTransfer(): AdyenApiPaymentsDetailsRequestTransfer
    {
        $paymentsDetailsRequestTransfer = (new AdyenApiPaymentsDetailsRequestTransfer())
            ->setPaymentData(FacadeTestConstants::REQUEST_DETAILS_PAYMENT_DATA)
            ->setDetails(FacadeTestConstants::REQUEST_DETAILS);

        return $paymentsDetailsRequestTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiCaptureRequestTransfer
     */
    protected function createCaptureRequestTransfer(): AdyenApiCaptureRequestTransfer
    {
        $captureTransfer = (new AdyenApiCaptureRequestTransfer())
            ->setMerchantAccount(FacadeTestConstants::REQUEST_MERCHANT_ACCOUNT)
            ->setOriginalReference(FacadeTestConstants::REQUEST_PSP_REFERENCE)
            ->setOriginalMerchantReference(FacadeTestConstants::REQUEST_REFERENCE)
            ->setModificationAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(FacadeTestConstants::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(FacadeTestConstants::REQUEST_AMOUNT_VALUE)
            );

        return $captureTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiCancelRequestTransfer
     */
    protected function createCancelRequestTransfer(): AdyenApiCancelRequestTransfer
    {
        $cancelTransfer = (new AdyenApiCancelRequestTransfer())
            ->setMerchantAccount(FacadeTestConstants::REQUEST_MERCHANT_ACCOUNT)
            ->setOriginalReference(FacadeTestConstants::REQUEST_PSP_REFERENCE)
            ->setOriginalMerchantReference(FacadeTestConstants::REQUEST_REFERENCE);

        return $cancelTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiRefundRequestTransfer
     */
    protected function createRefundRequestTransfer(): AdyenApiRefundRequestTransfer
    {
        $refundTransfer = (new AdyenApiRefundRequestTransfer())
            ->setMerchantAccount(FacadeTestConstants::REQUEST_MERCHANT_ACCOUNT)
            ->setOriginalReference(FacadeTestConstants::REQUEST_PSP_REFERENCE)
            ->setOriginalMerchantReference(FacadeTestConstants::REQUEST_REFERENCE)
            ->setModificationAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(FacadeTestConstants::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(FacadeTestConstants::REQUEST_AMOUNT_VALUE)
            );

        return $refundTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiCancelOrRefundRequestTransfer
     */
    protected function createCancelOrRefundRequestTransfer(): AdyenApiCancelOrRefundRequestTransfer
    {
        $cancelOrRefundTransfer = (new AdyenApiCancelOrRefundRequestTransfer())
            ->setMerchantAccount(FacadeTestConstants::REQUEST_MERCHANT_ACCOUNT)
            ->setOriginalReference(FacadeTestConstants::REQUEST_PSP_REFERENCE)
            ->setOriginalMerchantReference(FacadeTestConstants::REQUEST_REFERENCE)
            ->setModificationAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(FacadeTestConstants::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(FacadeTestConstants::REQUEST_AMOUNT_VALUE)
            );

        return $cancelOrRefundTransfer;
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected function createConfig(): AdyenApiConfig
    {
        return new AdyenApiConfig();
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface
     */
    protected function createUtilEncodingService(): AdyenApiToUtilEncodingServiceInterface
    {
        $service = new UtilEncodingService();

        return new AdyenApiToUtilEncodingServiceBridge($service);
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createGetPaymentMethodsAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(GetPaymentMethodsAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(FacadeTestConstants::RESPONSE_BODY_GET_PAYMENT_METHODS));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createMakePaymentAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(MakePaymentAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(FacadeTestConstants::RESPONSE_BODY_MAKE_PAYMENT));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createPaymentsDetailsAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(PaymentsDetailsAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(FacadeTestConstants::RESPONSE_BODY_PAYMENT_DETAILS));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createCaptureAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(CaptureAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(FacadeTestConstants::RESPONSE_BODY_CAPTURE));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createCancelAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(CancelAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(FacadeTestConstants::RESPONSE_BODY_CANCEL));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createRefundAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(RefundAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(FacadeTestConstants::RESPONSE_BODY_REFUND));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createCancelOrRefundAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(CancelOrRefundAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(FacadeTestConstants::RESPONSE_BODY_CANCEL_OR_REFUND));

        return $stub;
    }

    /**
     * @param string $bodyContent
     * @param int $statusCode
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function createResponse(string $bodyContent, int $statusCode = 200): ResponseInterface
    {
        return new Response($statusCode, FacadeTestConstants::RESPONSE_HEADERS, $bodyContent);
    }
}
