<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper\Collection;

use SprykerEco\Zed\AdyenApi\Business\Exception\AdyenApiMapperNotFoundException;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;

class AdyenApiMapperCollection implements AdyenApiMapperCollectionInterface
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface[]
     */
    protected $mappers = [];

    /**
     * @param string $method
     * @param \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface $mapper
     *
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollectionInterface
     */
    public function add(string $method, AdyenApiMapperInterface $mapper): AdyenApiMapperCollectionInterface
    {
        $this->mappers[$method] = $mapper;

        return $this;
    }

    /**
     * @param string $method
     *
     * @throws \SprykerEco\Zed\AdyenApi\Business\Exception\AdyenApiMapperNotFoundException
     *
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function get(string $method): AdyenApiMapperInterface
    {
        if (empty($this->mappers[$method])) {
            throw new AdyenApiMapperNotFoundException(
                sprintf('Could not find "%s" mapper.', $method)
            );
        }

        return $this->mappers[$method];
    }

    /**
     * @param string $method
     *
     * @return bool
     */
    public function has(string $method): bool
    {
        return isset($this->mappers[$method]);
    }
}
