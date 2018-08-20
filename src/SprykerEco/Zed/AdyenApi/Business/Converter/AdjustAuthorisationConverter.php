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
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    protected function getResponseTransfer(array $response): AdyenApiResponseTransfer
    {
        return (new AdyenApiResponseTransfer())
            ->setAdjustAuthorisationResponse((new AdyenApiAdjustAuthorisationResponseTransfer())->fromArray($response, true));
    }
}
