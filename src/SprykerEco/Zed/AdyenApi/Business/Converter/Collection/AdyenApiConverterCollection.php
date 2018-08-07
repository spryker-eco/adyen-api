<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Converter\Collection;

use SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface;
use SprykerEco\Zed\AdyenApi\Business\Exception\AdyenApiConverterNotFoundException;

class AdyenApiConverterCollection implements AdyenApiConverterCollectionInterface
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface[]
     */
    protected $converters = [];

    /**
     * @param string $method
     * @param \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface $converter
     *
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\Collection\AdyenApiConverterCollectionInterface
     */
    public function add(string $method, AdyenApiConverterInterface $converter): AdyenApiConverterCollectionInterface
    {
        $this->converters[$method] = $converter;

        return $this;
    }

    /**
     * @param string $method
     *
     * @throws \SprykerEco\Zed\AdyenApi\Business\Exception\AdyenApiConverterNotFoundException
     *
     * @return \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    public function get(string $method): AdyenApiConverterInterface
    {
        if (empty($this->converters[$method])) {
            throw new AdyenApiConverterNotFoundException(
                sprintf('Could not find "%s" converter.', $method)
            );
        }

        return $this->converters[$method];
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function has(string $method): bool
    {
        return isset($this->converters[$method]);
    }
}
