<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use SprykerEco\Zed\AdyenApi\AdyenApiConfig;

abstract class AbstractMapper
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected $config;

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    abstract protected function validateRequestTransfer(AdyenApiRequestTransfer $adyenApiRequestTransfer): void;

    /**
     * @param \SprykerEco\Zed\AdyenApi\AdyenApiConfig $config
     */
    public function __construct(AdyenApiConfig $config)
    {
        $this->config = $config;
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function removeRedundantParams(array $data): array
    {
        $data = array_filter($data, function ($value) {
            return !empty($value) ?? null;
        });

        return $data;
    }
}
