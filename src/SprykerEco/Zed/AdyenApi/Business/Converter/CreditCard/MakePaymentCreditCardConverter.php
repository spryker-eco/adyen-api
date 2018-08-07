<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter\CreditCard;

use Generated\Shared\Transfer\AdyenApiMakePaymentResponseTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use SprykerEco\Zed\AdyenApi\Business\Converter\AbstractConverter;
use SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface;

class MakePaymentCreditCardConverter extends AbstractConverter implements AdyenApiConverterInterface
{
    /**
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    protected function getResponseTransfer(array $response): AdyenApiResponseTransfer
    {
        $responseTransfer = new AdyenApiResponseTransfer();
        $responseTransfer->setMakePayment(
            (new AdyenApiMakePaymentResponseTransfer())->fromArray($response, true)
        );

        return $responseTransfer;
    }
}
