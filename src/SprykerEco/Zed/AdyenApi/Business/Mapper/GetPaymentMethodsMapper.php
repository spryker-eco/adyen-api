<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class GetPaymentMethodsMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function buildRequestArray(AdyenApiRequestTransfer $requestTransfer): array
    {
        $this->validateRequestTransfer($requestTransfer);

        return $requestTransfer->getPaymentMethodsRequest()->toArray(true, true);
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
