<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter\Collection;

use SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface;

interface AdyenApiConverterCollectionInterface
{
    /**
     * @param string $method
     * @param \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface $converter
     *
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollectionInterface
     */
    public function add(string $method, AdyenApiConverterInterface $converter): self;

    /**
     * @param string $method
     *
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function get(string $method): AdyenApiConverterInterface;

    /**
     * @param string $method
     *
     * @return bool
     */
    public function has(string $method): bool;
}
