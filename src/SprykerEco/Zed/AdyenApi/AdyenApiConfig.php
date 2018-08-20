<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\AdyenApi\AdyenApiConstants;

class AdyenApiConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getApiKey(): string
    {
        return $this->get(AdyenApiConstants::API_KEY);
    }

    /**
     * @return string
     */
    public function getPaymentMethodsActionUrl(): string
    {
        return $this->get(AdyenApiConstants::GET_PAYMENT_METHODS_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getMakePaymentActionUrl(): string
    {
        return $this->get(AdyenApiConstants::MAKE_PAYMENT_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getPaymentsDetailsActionUrl(): string
    {
        return $this->get(AdyenApiConstants::PAYMENTS_DETAILS_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getAuthoriseActionUrl(): string
    {
        return $this->get(AdyenApiConstants::AUTHORISE_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getAuthorise3dActionUrl(): string
    {
        return $this->get(AdyenApiConstants::AUTHORISE_3D_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getCaptureActionUrl(): string
    {
        return $this->get(AdyenApiConstants::CAPTURE_ACTION_URL);
    }
}
