<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class GetPaymentMethodsMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return array
     */
    public function buildRequestArray(AdyenApiRequestTransfer $adyenApiRequestTransfer): array
    {
        $this->validateRequestTransfer($adyenApiRequestTransfer);

        return $adyenApiRequestTransfer->getPaymentMethodsRequest()->toArray(true, true);
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    protected function validateRequestTransfer(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requirePaymentMethodsRequest();

        $adyenApiRequestTransfer
            ->getPaymentMethodsRequest()
            ->requireMerchantAccount()
            ->requireChannel()
            ->requireAmount();

        $adyenApiRequestTransfer
            ->getPaymentMethodsRequest()
            ->getAmount()
            ->requireCurrency()
            ->requireValue();
    }
}
