<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\AdyenApi\Business;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\AdyenApiAdjustAuthorizationResponseTransfer;
use Generated\Shared\Transfer\AdyenApiAuthorize3dResponseTransfer;
use Generated\Shared\Transfer\AdyenApiAuthorizeResponseTransfer;
use Generated\Shared\Transfer\AdyenApiCancelOrRefundResponseTransfer;
use Generated\Shared\Transfer\AdyenApiCancelResponseTransfer;
use Generated\Shared\Transfer\AdyenApiCaptureResponseTransfer;
use Generated\Shared\Transfer\AdyenApiMakePaymentResponseTransfer;
use Generated\Shared\Transfer\AdyenApiPaymentDetailsResponseTransfer;
use Generated\Shared\Transfer\AdyenApiPaymentMethodTransfer;
use Generated\Shared\Transfer\AdyenApiRefundResponseTransfer;
use Generated\Shared\Transfer\AdyenApiTechnicalCancelResponseTransfer;

/**
 * @group Functional
 * @group SprykerEco
 * @group Zed
 * @group AdyenApi
 * @group Business
 */
class FacadeTest extends Test
{
    /**
     * @var \SprykerEcoTest\Zed\AdyenApi\Business\FacadeTestHelper
     */
    protected $helper;

    /**
     * @param \SprykerEcoTest\Zed\AdyenApi\Business\FacadeTestHelper $helper
     *
     * @return void
     */
    protected function _inject(FacadeTestHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * @return void
     */
    public function testPerformGetPaymentMethodsApiCall(): void
    {
        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performGetPaymentMethodsApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertNotEmpty($responseTransfer->getPaymentMethods());

        /** @var \Generated\Shared\Transfer\AdyenApiPaymentMethodTransfer $paymentMethodTransfer */
        $paymentMethodTransfer = $responseTransfer->getPaymentMethods()->offsetGet(0);
        $this->assertInstanceOf(AdyenApiPaymentMethodTransfer::class, $paymentMethodTransfer);
        $this->assertNotEmpty($paymentMethodTransfer->getName());
        $this->assertNotEmpty($paymentMethodTransfer->getType());
    }

    /**
     * @return void
     */
    public function testPerformMakePaymentApiCall(): void
    {
        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performMakePaymentApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiMakePaymentResponseTransfer::class,
            $responseTransfer->getMakePaymentResponse()
        );
        $this->assertNotEmpty($responseTransfer->getMakePaymentResponse()->getResultCode());
    }

    /**
     * @return void
     */
    public function testPerformPaymentDetailsApiCall(): void
    {
        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performPaymentDetailsApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiPaymentDetailsResponseTransfer::class,
            $responseTransfer->getPaymentDetailsResponse()
        );
        $this->assertNotEmpty($responseTransfer->getPaymentDetailsResponse()->getResultCode());
        $this->assertNotEmpty($responseTransfer->getPaymentDetailsResponse()->getPspReference());
    }

    /**
     * @return void
     */
    public function testPerformAuthorizeApiCall(): void
    {
        $this->markTestSkipped('Method isn\'t used.');

        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performAuthorizeApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiAuthorizeResponseTransfer::class,
            $responseTransfer->getAuthorizeResponse()
        );
    }

    /**
     * @return void
     */
    public function testPerformAuthorize3dApiCall(): void
    {
        $this->markTestSkipped('Method isn\'t used.');

        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performAuthorize3dApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiAuthorize3dResponseTransfer::class,
            $responseTransfer->getAuthorize3dResponse()
        );
    }

    /**
     * @return void
     */
    public function testPerformCaptureApiCall(): void
    {
        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performCaptureApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiCaptureResponseTransfer::class,
            $responseTransfer->getCaptureResponse()
        );
        $this->assertNotEmpty($responseTransfer->getCaptureResponse()->getPspReference());
        $this->assertNotEmpty($responseTransfer->getCaptureResponse()->getResponse());
        $this->assertEquals('[capture-received]', $responseTransfer->getCaptureResponse()->getResponse());
    }

    /**
     * @return void
     */
    public function testPerformCancelApiCall(): void
    {
        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performCancelApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiCancelResponseTransfer::class,
            $responseTransfer->getCancelResponse()
        );
        $this->assertNotEmpty($responseTransfer->getCancelResponse()->getPspReference());
        $this->assertNotEmpty($responseTransfer->getCancelResponse()->getResponse());
        $this->assertEquals('[cancel-received]', $responseTransfer->getCancelResponse()->getResponse());
    }

    /**
     * @return void
     */
    public function testPerformRefundApiCall(): void
    {
        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performRefundApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiRefundResponseTransfer::class,
            $responseTransfer->getRefundResponse()
        );
        $this->assertNotEmpty($responseTransfer->getRefundResponse()->getPspReference());
        $this->assertNotEmpty($responseTransfer->getRefundResponse()->getResponse());
        $this->assertEquals('[refund-received]', $responseTransfer->getRefundResponse()->getResponse());
    }

    /**
     * @return void
     */
    public function testPerformCancelOrRefundApiCall(): void
    {
        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performCancelOrRefundApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiCancelOrRefundResponseTransfer::class,
            $responseTransfer->getCancelOrRefundResponse()
        );
        $this->assertNotEmpty($responseTransfer->getCancelOrRefundResponse()->getPspReference());
        $this->assertNotEmpty($responseTransfer->getCancelOrRefundResponse()->getResponse());
        $this->assertEquals('[cancelOrRefund-received]', $responseTransfer->getCancelOrRefundResponse()->getResponse());
    }

    /**
     * @return void
     */
    public function testPerformTechnicalCancelApiCall(): void
    {
        $this->markTestSkipped('Method isn\'t used.');

        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performTechnicalCancelApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiTechnicalCancelResponseTransfer::class,
            $responseTransfer->getTechnicalCancelResponse()
        );
    }

    /**
     * @return void
     */
    public function testPerformAdjustAuthorizationApiCall(): void
    {
        $this->markTestSkipped('Method isn\'t used.');

        $facade = $this->helper->createFacade();
        $requestTransfer = $this->helper->createAdyenApiRequestTransfer();
        $responseTransfer = $facade->performAdjustAuthorizationApiCall($requestTransfer);

        $this->assertTrue($responseTransfer->getIsSuccess());
        $this->assertNull($responseTransfer->getError());
        $this->assertInstanceOf(
            AdyenApiAdjustAuthorizationResponseTransfer::class,
            $responseTransfer->getAdjustAuthorizationResponse()
        );
    }
}
