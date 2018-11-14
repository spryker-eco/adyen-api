<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Adapter;

class GetPaymentMethodsAdapter extends AbstractAdapter
{
    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->config->getPaymentMethodsActionUrl();
    }
}
