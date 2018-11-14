<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\AdyenApi\Business\Request;

use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Generated\Shared\Transfer\AdyenApiResponseTransfer;
use GuzzleHttp\Exception\RequestException;
use SprykerEco\Zed\AdyenApi\AdyenApiConfig;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface;
use SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface;

class AdyenApiRequest implements AdyenApiRequestInterface
{
    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected $adapter;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface
     */
    protected $converter;

    /**
     * @var \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface
     */
    protected $mapper;

    /**
     * @var \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected $config;

    /**
     * @var string
     */
    protected $method;

    /**
     * @param \SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface $adapter
     * @param \SprykerEco\Zed\AdyenApi\Business\Converter\AdyenApiConverterInterface $converter
     * @param \SprykerEco\Zed\AdyenApi\Business\Mapper\AdyenApiMapperInterface $mapper
     * @param \SprykerEco\Zed\AdyenApi\AdyenApiConfig $config
     */
    public function __construct(
        AdyenApiAdapterInterface $adapter,
        AdyenApiConverterInterface $converter,
        AdyenApiMapperInterface $mapper,
        AdyenApiConfig $config
    ) {
        $this->adapter = $adapter;
        $this->converter = $converter;
        $this->mapper = $mapper;
        $this->config = $config;
    }

    /**
     * @param \Generated\Shared\Transfer\AdyenApiRequestTransfer $requestTransfer
     *
     * @return \Generated\Shared\Transfer\AdyenApiResponseTransfer
     */
    public function request(AdyenApiRequestTransfer $requestTransfer): AdyenApiResponseTransfer
    {
        $requestData = $this->mapper->buildRequestArray($requestTransfer);
        $isSuccess = true;

        try {
            $response = $this->adapter->sendRequest($requestData);
        } catch (RequestException $requestException) {
            $response = $requestException->getResponse();
            $isSuccess = false;
        }

        return $this->converter->convertToResponseTransfer($response, $isSuccess);
    }
}
