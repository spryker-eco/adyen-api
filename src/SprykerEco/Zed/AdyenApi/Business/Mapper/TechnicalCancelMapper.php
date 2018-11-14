<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class TechnicalCancelMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return array
     */
    public function buildRequestArray(AdyenApiRequestTransfer $adyenApiRequestTransfer): array
    {
        $this->validateRequestTransfer($adyenApiRequestTransfer);

        $requestDataArray = $adyenApiRequestTransfer->getTechnicalCancelRequest()->toArray(true, true);

        return $this->removeRedundantParams($requestDataArray);
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    protected function validateRequestTransfer(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requireTechnicalCancelRequest();

        $adyenApiRequestTransfer
            ->getTechnicalCancelRequest()
            ->requireMerchantAccount()
            ->requireOriginalReference();
    }
}
