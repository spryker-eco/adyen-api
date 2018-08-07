<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper\GetPaymentMethods;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AbstractMapper;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;

class GetPaymentMethodsMapper extends AbstractMapper implements AdyenApiMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $adyenApiRequestTransfer
     *
     * @return array
     */
    public function buildRequest(AdyenApiRequestTransfer $adyenApiRequestTransfer): array
    {
        $this->validator->validateRequest($adyenApiRequestTransfer);

        return $adyenApiRequestTransfer->getPaymentMethodsRequest()->toArray(true, true);
    }
}
