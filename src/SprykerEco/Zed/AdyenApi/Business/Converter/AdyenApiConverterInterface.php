<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter;

use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use Psr\Http\Message\ResponseInterface;

interface AdyenApiConverterInterface
{
    /**
     * @param \Psr\Http\Message\ResponseInterface|null $response
     * @param bool $isSuccess
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function convertToResponseTransfer(?ResponseInterface $response = null, $isSuccess = true): AdyenApiResponseTransfer;
}
