<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiCancelResponseTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;

class CancelConverter extends AbstractConverter
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiResponseTransfer $responseTransfer
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    protected function updateResponseTransfer(AdyenApiResponseTransfer $responseTransfer, array $response): AdyenApiResponseTransfer
    {
        $apiResponseTransfer = (new AdyenApiCancelResponseTransfer())->fromArray($response, true);

        return $responseTransfer->setCancelResponse($apiResponseTransfer);
    }
}
