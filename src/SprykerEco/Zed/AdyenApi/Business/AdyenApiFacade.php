<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
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
    public function performPaymentsDetailsApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createPaymentsDetailsRequest()->request($requestTransfer);
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
    public function performAuthoriseApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createAuthoriseRequest()->request($requestTransfer);
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
    public function performAuthorise3dApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        return $this->getFactory()->createAuthorise3dRequest()->request($requestTransfer);
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
}
