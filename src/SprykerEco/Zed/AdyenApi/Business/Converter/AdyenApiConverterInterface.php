<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use Psr\Http\Message\StreamInterface;

interface AdyenApiConverterInterface
{
    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function convertToResponseTransfer(StreamInterface $response): AdyenApiResponseTransfer;
}
