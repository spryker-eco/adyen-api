<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiCancelOrRefundResponseTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;

class CancelOrRefundConverter extends AbstractConverter
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiResponseTransfer $responseTransfer
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    protected function updateResponseTransfer(AdyenApiResponseTransfer $responseTransfer, array $response): AdyenApiResponseTransfer
    {
        $apiResponseTransfer = (new AdyenApiCancelOrRefundResponseTransfer())->fromArray($response, true);

        return $responseTransfer->setCancelOrRefundResponse($apiResponseTransfer);
    }
}
