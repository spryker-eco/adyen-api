<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class CancelMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function buildRequestArray(AdyenApiRequestTransfer $requestTransfer): array
    {
        $this->validateRequestTransfer($requestTransfer);

        $requestDataArray = $requestTransfer->getCancelRequest()->toArray(true, true);

        return $this->removeRedundantParams($requestDataArray);
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    protected function validateRequestTransfer(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requireCancelRequest();

        $adyenApiRequestTransfer
            ->getCancelRequest()
            ->requireMerchantAccount()
            ->requireOriginalReference();
    }
}
