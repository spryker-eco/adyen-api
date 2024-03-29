<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Shared\AdyenApi;

/**
 * Declares global environment configuration keys. Do not use it for other class constants.
 */
interface AdyenApiConstants
{
    /**
     * @var string
     */
    public const API_KEY = 'ADYENAPI:API_KEY';

    /**
     * @var string
     */
    public const GET_PAYMENT_METHODS_ACTION_URL = 'ADYENAPI:GET_PAYMENT_METHODS_ACTION_URL';

    /**
     * @var string
     */
    public const MAKE_PAYMENT_ACTION_URL = 'ADYENAPI:MAKE_PAYMENT_ACTION_URL';

    /**
     * @var string
     */
    public const PAYMENTS_DETAILS_ACTION_URL = 'ADYENAPI:PAYMENTS_DETAILS_ACTION_URL';

    /**
     * @var string
     */
    public const AUTHORIZE_ACTION_URL = 'ADYENAPI:AUTHORIZE_ACTION_URL';

    /**
     * @var string
     */
    public const AUTHORIZE_3D_ACTION_URL = 'ADYENAPI:AUTHORIZE_3D_ACTION_URL';

    /**
     * @var string
     */
    public const CAPTURE_ACTION_URL = 'ADYENAPI:CAPTURE_ACTION_URL';

    /**
     * @var string
     */
    public const CANCEL_ACTION_URL = 'ADYENAPI:CANCEL_ACTION_URL';

    /**
     * @var string
     */
    public const REFUND_ACTION_URL = 'ADYENAPI:REFUND_ACTION_URL';

    /**
     * @var string
     */
    public const CANCEL_OR_REFUND_ACTION_URL = 'ADYENAPI:CANCEL_OR_REFUND_ACTION_URL';

    /**
     * @var string
     */
    public const TECHNICAL_CANCEL_ACTION_URL = 'ADYENAPI:TECHNICAL_CANCEL_ACTION_URL';

    /**
     * @var string
     */
    public const ADJUST_AUTHORIZATION_ACTION_URL = 'ADYENAPI:ADJUST_AUTHORIZATION_ACTION_URL';
}
