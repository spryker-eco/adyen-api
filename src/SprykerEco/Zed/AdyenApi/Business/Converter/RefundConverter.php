<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiCancelResponseTransfer;
use Generated\Shared\Transfer\AdyenApiRefundResponseTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;

class RefundConverter extends AbstractConverter implements AdyenApiConverterInterface
{
    /**
     * @param array $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    protected function getResponseTransfer(array $response): AdyenApiResponseTransfer
    {
        return (new AdyenApiResponseTransfer())
            ->setCaptureResponse((new AdyenApiRefundResponseTransfer())->fromArray($response, true));
    }
}
