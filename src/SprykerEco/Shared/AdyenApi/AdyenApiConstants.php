<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Shared\AdyenApi;

interface AdyenApiConstants
{
    public const MERCHANT_ACCOUNT = 'ADYENAPI:MERCHANT_ACCOUNT';
    public const API_KEY = 'ADYENAPI:API_KEY';
    public const GET_PAYMENT_METHODS_ACTION_URL = 'ADYENAPI:GET_PAYMENT_METHODS_ACTION_URL';
    public const MAKE_PAYMENT_ACTION_URL = 'ADYENAPI:MAKE_PAYMENT_ACTION_URL';
    public const PAYMENTS_DETAILS_ACTION_URL = 'ADYENAPI:PAYMENTS_DETAILS_ACTION_URL';
    public const AUTHORISE_ACTION_URL = 'ADYENAPI:AUTHORISE_ACTION_URL';
    public const AUTHORISE_3D_ACTION_URL = 'ADYENAPI:AUTHORISE_3D_ACTION_URL';
    public const CAPTURE_ACTION_URL = 'ADYENAPI:CAPTURE_ACTION_URL';
}
