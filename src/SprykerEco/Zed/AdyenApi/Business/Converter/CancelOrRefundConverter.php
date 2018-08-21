<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiCancelOrRefundResponseTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;

class CancelOrRefundConverter extends AbstractConverter implements AdyenApiConverterInterface
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
