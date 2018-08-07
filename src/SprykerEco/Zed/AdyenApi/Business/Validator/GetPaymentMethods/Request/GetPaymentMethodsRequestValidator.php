<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Validator\GetPaymentMethods\Request;

use Generated\Shared\Transfer\AdyenApiAmountTransfer;
use Generated\Shared\Transfer\AdyenApiGetPaymentMethodsRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiRequestValidatorInterface;

class GetPaymentMethodsRequestValidator implements AdyenApiRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    public function validateRequest(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requirePaymentMethodsRequest();
        $requestTransfer = $adyenApiRequestTransfer->getPaymentMethodsRequest();
        $this->validateGetPaymentMethodsRequestTransfer($requestTransfer);
        $this->validateAmountTransfer($requestTransfer->getAmount());
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiGetPaymentMethodsRequestTransfer $requestTransfer
     *
     * @return void
     */
    protected function validateGetPaymentMethodsRequestTransfer(AdyenApiGetPaymentMethodsRequestTransfer $requestTransfer): void
    {
        $requestTransfer
            ->requireMerchantAccount()
            ->requireChannel()
            ->requireAmount();
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
}
