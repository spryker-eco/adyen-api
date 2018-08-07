<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Validator;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

interface AdyenApiRequestValidatorInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return void
     */
    public function validateRequest(AdyenApiRequestTransfer $adyenApiRequestTransfer): void;
}
