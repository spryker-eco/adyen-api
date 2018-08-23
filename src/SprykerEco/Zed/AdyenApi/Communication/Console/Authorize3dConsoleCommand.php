<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Communication\Console;

use Generated\Shared\Transfer\AdyenApiAmountTransfer;
use Generated\Shared\Transfer\AdyenApiAuthorize3dRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiFacade;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Authorize3dConsoleCommand extends Console
{
    const COMMAND_NAME = 'adyen-api:test:authorize3d';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription('AdyenApi Test Facade methods authorize 3d');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $app = new AdyenApiFacade();
        $response = $app->performAuthorize3dApiCall($this->createRequestTransfer());

        echo json_encode($response->toArray(true, true), JSON_PRETTY_PRINT);
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiRequestTransfer
     */
    protected function createRequestTransfer()
    {
        return (new AdyenApiRequestTransfer())
            ->setAuthorize3dRequest(
                (new AdyenApiAuthorize3dRequestTransfer())
                    ->setMerchantAccount('SprykerCOM')
                    ->setReference('1234556778890wqecdas123drrg')
                    ->setAmount(
                        (new AdyenApiAmountTransfer())
                            ->setCurrency('EUR')
                            ->setValue(1990)
                    )
                    ->setMd('djIhVTArbHd0bTM1Qmt3eW94L2U3ZkFmUT09IXl8E+PF4ZdZ9QvMr5eBZ4ZtmObUyFaHN1GbTqPw//odzZLNV9Kohn7eTdeygTl56EkjSSjQFDYoyvUF+MdTdEby+XxViqi2nNLLiOFy5oR07q+c1Qd2QRyShw4ZvKt+HHfHdbmui6GQu8F+xrIJPZaEcK7Wykpe3AnyY6TtmLtgJM2JbXvsI2eRBij6FwKrkTYbYgtkdJVeANwxpzeXAYWsrYt35ypymoL9g1T9RtantFrjnEjImM3++5vaK1b5vMBnR/j3JMsQxTdD3uKMLxzbKYmLgiXOQyyxSvBZWrelvn0YljUXh0XPMtM=')
                    ->setPaResponse('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')
            );
    }
}
