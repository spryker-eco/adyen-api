<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class CancelOrRefundMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return array
     */
    public function buildRequestArray(AdyenApiRequestTransfer $adyenApiRequestTransfer): array
    {
        $this->validateRequestTransfer($adyenApiRequestTransfer);

        $requestDataArray = $adyenApiRequestTransfer->getCancelOrRefundRequest()->toArray(true, true);

        return $this->removeRedundantParams($requestDataArray);
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    protected function validateRequestTransfer(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requireCancelOrRefundRequest();

        $adyenApiRequestTransfer
            ->getCancelOrRefundRequest()
            ->requireMerchantAccount()
            ->requireOriginalReference();
    }
}
