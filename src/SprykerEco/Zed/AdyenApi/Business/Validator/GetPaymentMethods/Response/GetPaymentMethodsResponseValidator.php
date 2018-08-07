<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Validator\GetPaymentMethods\Request;

use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiResponseValidatorInterface;

class GetPaymentMethodsResponseValidator implements AdyenApiResponseValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiResponseTransfer $adyenApiResponseTransfer
     *
     * @return void
     */
    public function validateResponse(AdyenApiResponseTransfer $adyenApiResponseTransfer): void
    {
        $adyenApiResponseTransfer->requirePaymentMethods();
    }
}
