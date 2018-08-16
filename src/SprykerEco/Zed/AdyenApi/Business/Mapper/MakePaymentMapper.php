<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class MakePaymentMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return array
     */
    public function buildRequest(AdyenApiRequestTransfer $adyenApiRequestTransfer): array
    {
        $this->validateRequestTransfer($adyenApiRequestTransfer);

        return $this->castRequestTransferToArray($adyenApiRequestTransfer->getMakePaymentRequest());
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer $requestTransfer
     *
     * @return array
     */
    protected function castRequestTransferToArray(AdyenApiMakePaymentRequestTransfer $requestTransfer): array
    {
        $requestDataArray = $requestTransfer->toArray(true, true);

        foreach ($requestDataArray as $key => $value) {
            if ($value === null || (is_array($value) && count($value) === 0)) {
                unset($requestDataArray[$key]);
            }
        }

        return $requestDataArray;
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    protected function validateRequestTransfer(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requireMakePaymentRequest();

        $adyenApiRequestTransfer
            ->getMakePaymentRequest()
            ->requireMerchantAccount()
            ->requireReference()
            ->requireAmount()
            ->requirePaymentMethod()
            ->requireReturnUrl();

        $adyenApiRequestTransfer
            ->getMakePaymentRequest()
            ->getAmount()
            ->requireCurrency()
            ->requireValue();
    }
}
