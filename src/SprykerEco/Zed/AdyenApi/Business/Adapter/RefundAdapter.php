<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Adapter;

class RefundAdapter extends AbstractAdapter implements AdyenApiAdapterInterface
{
    /**
     * @return string
     */
    protected function getUrl(): string
    {
        return $this->config->getRefundActionUrl();
    }
}
