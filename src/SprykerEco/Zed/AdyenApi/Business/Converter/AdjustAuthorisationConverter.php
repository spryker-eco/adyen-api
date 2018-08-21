<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiAdjustAuthorisationResponseTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;

class AdjustAuthorisationConverter extends AbstractConverter implements AdyenApiConverterInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiResponseTransfer $responseTransfer
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    protected function updateResponseTransfer(AdyenApiResponseTransfer $responseTransfer, array $response): AdyenApiResponseTransfer
    {
        $apiResponseTransfer = (new AdyenApiAdjustAuthorisationResponseTransfer())->fromArray($response, true);

        return $responseTransfer->setAdjustAuthorisationResponse($apiResponseTransfer);
    }
}
