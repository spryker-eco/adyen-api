<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper\CreditCard;

use Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use SprykerEco\Shared\AdyenApi\SdkConfig\AdyenApiSdkConfig;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AbstractMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;

class MakePaymentCreditCardMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return string[]
     */
    public function buildRequest(AdyenApiRequestTransfer $adyenApiRequestTransfer): array
    {
        $this->validator->validateRequest($adyenApiRequestTransfer);
        $requestTransfer = $adyenApiRequestTransfer->getMakePaymentRequest();

        return [
            AdyenApiSdkConfig::REQUEST_PROPERTY_MERCHANT_ACCOUNT => $requestTransfer->getMerchantAccount(),
            AdyenApiSdkConfig::REQUEST_PROPERTY_REFERENCE => $requestTransfer->getReference(),
            AdyenApiSdkConfig::REQUEST_PROPERTY_AMOUNT => $requestTransfer->getAmount()->toArray(true, true),
            AdyenApiSdkConfig::REQUEST_PROPERTY_PAYMENT_METHOD => $this->getCreditCardPaymentMethodData($requestTransfer),
            AdyenApiSdkConfig::REQUEST_PROPERTY_RETURN_URL => $requestTransfer->getReturnUrl(),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer $requestTransfer
     *
     * @return string[]
     */
    protected function getCreditCardPaymentMethodData(AdyenApiMakePaymentRequestTransfer $requestTransfer): array
    {
        return $requestTransfer->getPaymentMethodAdyenCreditCard()->toArray(true, true);
    }
}
