<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;

class GetPaymentMethodsMapper extends AbstractMapper implements MapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return array
     */
    public function buildRequest(AdyenApiRequestTransfer $adyenApiRequestTransfer): array
    {
        return $adyenApiRequestTransfer->getPaymentMethodsRequest()->toArray(true, true);
    }
}
