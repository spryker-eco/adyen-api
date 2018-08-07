<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper;

use SprykerEco\Zed\AdyenApi\AdyenApiConfig;
use SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiRequestValidatorInterface;

abstract class AbstractMapper
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected $config;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiRequestValidatorInterface
     */
    protected $validator;

    /**
     * @param \SprykerEco\Zed\AdyenApi\AdyenApiConfig $config
     * @param \SprykerEco\Zed\AdyenApi\Business\Validator\AdyenApiRequestValidatorInterface $validator
     */
    public function __construct(
        AdyenApiConfig $config,
        AdyenApiRequestValidatorInterface $validator
    ) {
        $this->config = $config;
        $this->validator = $validator;
    }
}
