<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;

interface AdyenApiFacadeInterface
{
    /**
     * Specification:
     * - Make API call to Adyen for receive available payment methods.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performGetPaymentMethodsApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Make API call to Adyen to make payment.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performMakePaymentApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Make API call to Adyen to submit details from make payment request.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performPaymentsDetailsApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Make API call to Adyen to authorise payment.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performAuthoriseApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Make API call to Adyen to authorise 3d payment.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performAuthorise3dApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Make API call to Adyen to capture payment.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performCaptureApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Make API call to Adyen to cancel payment.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performCancelApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;
}
