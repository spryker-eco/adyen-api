<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Adapter;

use Psr\Http\Message\ResponseInterface;

interface AdyenApiAdapterInterface
{
    /**
     * @param array $data
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function sendRequest(array $data): ResponseInterface;
}
