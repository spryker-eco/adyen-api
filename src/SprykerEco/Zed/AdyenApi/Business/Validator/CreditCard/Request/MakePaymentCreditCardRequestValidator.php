<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Validator\CreditCard\Request;

use Generated\Shared\Transfer\AdyenApiAmountTransfer;
use Generated\Shared\Transfer\AdyenApiCreditCardPaymentMethodTransfer;
use Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiRequestValidatorInterface;

class MakePaymentCreditCardRequestValidator implements AdyenApiRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    public function validateRequest(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requireMakePaymentRequest();

        $requestTransfer = $adyenApiRequestTransfer->getMakePaymentRequest();
        $this->validateMakePaymentRequestTransfer($requestTransfer);
        $this->validateAmountTransfer($requestTransfer->getAmount());
        $this->validateCreditCardTransfer($requestTransfer->getPaymentMethodAdyenCreditCard());
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer $requestTransfer
     *
     * @return void
     */
    protected function validateMakePaymentRequestTransfer(AdyenApiMakePaymentRequestTransfer $requestTransfer): void
    {
        $requestTransfer
            ->requireMerchantAccount()
            ->requireReference()
            ->requireAmount()
            ->requirePaymentMethodAdyenCreditCard()
            ->requireReturnUrl()
            ->requirePaymentSelection();
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiAmountTransfer $amountTransfer
     *
     * @return void
     */
    protected function validateAmountTransfer(AdyenApiAmountTransfer $amountTransfer): void
    {
        $amountTransfer
            ->requireCurrency()
            ->requireValue();
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiCreditCardPaymentMethodTransfer $creditCardTransfer
     *
     * @return void
     */
    protected function validateCreditCardTransfer(AdyenApiCreditCardPaymentMethodTransfer $creditCardTransfer): void
    {
        $creditCardTransfer
            ->requireType()
            ->requireEncryptedCardNumber()
            ->requireEncryptedExpiryMonth()
            ->requireEncryptedExpiryYear()
            ->requireEncryptedSecurityCode();
    }
}
