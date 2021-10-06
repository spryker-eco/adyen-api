<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\AdyenApi\AdyenApiConstants;

class AdyenApiConfig extends AbstractBundleConfig
{
    /**
     * @api
     *
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->get(AdyenApiConstants::API_KEY);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getPaymentMethodsActionUrl(): string
    {
        return $this->get(AdyenApiConstants::GET_PAYMENT_METHODS_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getMakePaymentActionUrl(): string
    {
        return $this->get(AdyenApiConstants::MAKE_PAYMENT_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getPaymentsDetailsActionUrl(): string
    {
        return $this->get(AdyenApiConstants::PAYMENTS_DETAILS_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getAuthorizeActionUrl(): string
    {
        return $this->get(AdyenApiConstants::AUTHORIZE_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getAuthorize3dActionUrl(): string
    {
        return $this->get(AdyenApiConstants::AUTHORIZE_3D_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getCaptureActionUrl(): string
    {
        return $this->get(AdyenApiConstants::CAPTURE_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getCancelActionUrl(): string
    {
        return $this->get(AdyenApiConstants::CANCEL_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getRefundActionUrl(): string
    {
        return $this->get(AdyenApiConstants::REFUND_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getCancelOrRefundActionUrl(): string
    {
        return $this->get(AdyenApiConstants::CANCEL_OR_REFUND_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getTechnicalCancelActionUrl(): string
    {
        return $this->get(AdyenApiConstants::TECHNICAL_CANCEL_ACTION_URL);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getAdjustAuthorizationActionUrl(): string
    {
        return $this->get(AdyenApiConstants::ADJUST_AUTHORIZATION_ACTION_URL);
    }
}
