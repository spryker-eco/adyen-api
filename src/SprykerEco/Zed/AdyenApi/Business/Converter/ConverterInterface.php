<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Psr\Http\Message\StreamInterface;
use Spryker\Shared\Kernel\Transfer\TransferInterface;

interface ConverterInterface
{
    /**
     * @param \Psr\Http\Message\StreamInterface $response
     *
     * @return \Spryker\Shared\Kernel\Transfer\TransferInterface
     */
    public function convertToResponseTransfer(StreamInterface $response): TransferInterface;
}