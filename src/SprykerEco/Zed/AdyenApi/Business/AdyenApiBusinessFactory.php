<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business;

use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;
use SprykerEco\Zed\AdyenApi\Business\Request\AdyenApiGetPaymentMethodsRequest;

/**
 * @method \SprykerEco\Zed\AdyenApi\AdyenApiConfig getConfig()
 */
class AdyenApiBusinessFactory extends AbstractBusinessFactory
{
    public function createGetPaymentMethodsRequest()
    {
        return new AdyenApiGetPaymentMethodsRequest(

        );
    }

    protected function createGetPaymentMethodsAdapter()
    {

    }

    protected function createGetPaymentMethodsConverter()
    {

    }

    protected function createGetPaymentMethodsMapper()
    {

    }
}
