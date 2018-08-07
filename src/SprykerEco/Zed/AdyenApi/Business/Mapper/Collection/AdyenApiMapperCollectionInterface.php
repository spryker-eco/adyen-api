<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Mapper\Collection;

use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;

interface AdyenApiMapperCollectionInterface
{
    /**
     * @param string $method
     * @param \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface $mapper
     *
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\Collection\AdyenApiMapperCollectionInterface
     */
    public function add(string $method, AdyenApiMapperInterface $mapper): self;

    /**
     * @param string $method
     *
     * @return \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    public function get(string $method): AdyenApiMapperInterface;

    /**
     * @param string $method
     *
     * @return bool
     */
    public function has(string $method): bool;
}
