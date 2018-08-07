<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Validator\CreditCard\Request;

use Generated\Shared\Transfer\AdyenApiMakePaymentResponseTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiResponseValidatorInterface;

class MakePaymentCreditCardResponseValidator implements AdyenApiResponseValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiResponseTransfer $adyenApiResponseTransfer
     *
     * @return void
     */
    public function validateResponse(AdyenApiResponseTransfer $adyenApiResponseTransfer): void
    {
        $adyenApiResponseTransfer->requireMakePayment();
        $this->validateMakePaymentResponseTransfer($adyenApiResponseTransfer->getMakePayment());
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiMakePaymentResponseTransfer $responseTransfer
     *
     * @return void
     */
    protected function validateMakePaymentResponseTransfer(AdyenApiMakePaymentResponseTransfer $responseTransfer): void
    {
        $responseTransfer
            ->requirePspReference()
            ->requireResultCode();
    }
}
