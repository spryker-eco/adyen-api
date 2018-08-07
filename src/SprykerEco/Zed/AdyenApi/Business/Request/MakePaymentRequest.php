<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Request;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class MakePaymentRequest extends AbstractRequest
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return void
     */
    protected function setMethod(AdyenApiRequestTransfer $requestTransfer): void
    {
        $this->method = $requestTransfer->getMakePaymentRequest()->getPaymentSelection();
    }
}
