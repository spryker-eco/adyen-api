<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class Authorize3dMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function buildRequestArray(AdyenApiRequestTransfer $requestTransfer): array
    {
        $this->validateRequestTransfer($requestTransfer);

        $requestDataArray = $requestTransfer->requireAuthorize3dRequest()->toArray(true, true);

        return $this->removeRedundantParams($requestDataArray);
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    protected function validateRequestTransfer(AdyenApiRequestTransfer $adyenApiRequestTransfer): void
    {
        $adyenApiRequestTransfer->requireAuthorize3dRequest();

        $adyenApiRequestTransfer
            ->getAuthorize3dRequest()
            ->requireAmount()
            ->requireMd()
            ->requireMerchantAccount()
            ->requirePaResponse()
            ->requireReference();

        $adyenApiRequestTransfer
            ->getAuthorize3dRequest()
            ->getAmount()
            ->requireCurrency()
            ->requireValue();
    }
}
