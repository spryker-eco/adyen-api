<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @method \SprykerEco\Zed\AdyenApi\Business\AdyenApiBusinessFactory getFactory()
 */
class AdyenApiFacade extends AbstractFacade implements AdyenApiFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performGetPaymentMethodsApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createGetPaymentMethodsRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performMakePaymentApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createMakePaymentRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performPaymentDetailsApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createPaymentDetailsRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performAuthorizeApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createAuthorizeRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performAuthorize3dApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createAuthorize3dRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performCaptureApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createCaptureRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performCancelApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createCancelRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performRefundApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createRefundRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performCancelOrRefundApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createCancelOrRefundRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performTechnicalCancelApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createTechnicalCancelRequest()->request($requestTransfer);
    }

    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performAdjustAuthorizationApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createAdjustAuthorizationRequest()->request($requestTransfer);
    }
}
