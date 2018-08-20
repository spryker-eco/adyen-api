<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Adapter;

class AdjustAuthorisationAdapter extends AbstractAdapter implements AdyenApiAdapterInterface
{
    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->config->getAdjustAuthorisationActionUrl();
    }
}
