<?php

/**
 * MIT License
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
    public function getPaymentMethodsActionUrl(): string
    {
        return $this->get(AdyenApiConstants::GET_PAYMENT_METHODS_ACTION_URL);
    }
}
