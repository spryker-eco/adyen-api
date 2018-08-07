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
    protected const ADYEN_GET_PAYMENT_METHODS_KEY = 'adyenGetPaymentMethods';
    protected const ADYEN_CREDIT_CARD = 'adyenCreditCard';

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
    public function getPaymentMethodsKey(): string
    {
        return static::ADYEN_GET_PAYMENT_METHODS_KEY;
    }

    /**
     * @return string
     */
    public function getCreditCardPaymentMethod(): string
    {
        return static::ADYEN_CREDIT_CARD;
    }
}
