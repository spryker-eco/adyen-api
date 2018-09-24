<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;

interface AdyenApiFacadeInterface
{
    /**
     * Specification:
     * - Queries the available payment methods for a transaction based on the transaction context.
     * - Gives back a list of the available payment methods.
     * - The response also returns which input details you need to collect from the shopper.
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
     * - Sends payment parameters (like amount, country, and currency) together with the input details collected from the shopper.
     * - The response returns the result of the payment request.
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
     * - Submits details for a payment created using make payment call.
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
     * - Make API call to Adyen to authorize payment.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performAuthorizeApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Completes the payment authorization for an authenticated 3D Secure session.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performAuthorize3dApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Captures the authorization hold on a payment.
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
     * - Cancels the authorization hold on a payment
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performCancelApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Refunds a payment that has previously been captured.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performRefundApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Cancels a payment if it has not yet been captured yet, or refunds it if it has already been captured
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performCancelOrRefundApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Cancels a previously authorized payment using a custom reference value.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performTechnicalCancelApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;

    /**
     * Specification:
     * - Allows you to increase or decrease the authorized amount after the initial authorization has taken place.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function performAdjustAuthorizationApiCall(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer;
}
