<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class RefundMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return array
     */
    public function buildRequest(AdyenApiRequestTransfer $adyenApiRequestTransfer): array
    {
        $this->validateRequestTransfer($adyenApiRequestTransfer);

        $requestDataArray = $adyenApiRequestTransfer->getRefundRequest()->toArray(true, true);

        return $this->removeRedundantParams($requestDataArray);
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    protected function validateRequestTransfer(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requireRefundRequest();

        $adyenApiRequestTransfer
            ->getRefundRequest()
            ->requireModificationAmount()
            ->requireMerchantAccount()
            ->requireOriginalReference();

        $adyenApiRequestTransfer
            ->getRefundRequest()
            ->getModificationAmount()
            ->requireCurrency()
            ->requireValue();
    }
}
