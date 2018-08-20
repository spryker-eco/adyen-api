<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Adapter;

use Psr\Http\Message\StreamInterface;

interface AdyenApiAdapterInterface
{
    /**
     * @param array $data
     *
     * @return \Psr\Http\Message\StreamInterface
     */
    public function sendRequest(array $data): StreamInterface;
}
