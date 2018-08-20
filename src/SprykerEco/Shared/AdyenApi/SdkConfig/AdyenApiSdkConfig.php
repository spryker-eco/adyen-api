<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\AdyenApi\SdkConfig;

interface AdyenApiSdkConfig
{
    public const REQUEST_PROPERTY_MERCHANT_ACCOUNT = 'merchantAccount';
    public const REQUEST_PROPERTY_REFERENCE = 'reference';
    public const REQUEST_PROPERTY_AMOUNT = 'amount';
    public const REQUEST_PROPERTY_PAYMENT_METHOD = 'paymentMethod';
    public const REQUEST_PROPERTY_RETURN_URL = 'returnUrl';
}
