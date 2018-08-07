<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Communication\Console;

use Generated\Shared\Transfer\AdyenApiAmountTransfer;
use Generated\Shared\Transfer\AdyenApiGetPaymentMethodsRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiFacade;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetPaymentMethodsConsoleCommand extends Console
{
    const COMMAND_NAME = 'adyen-api:test:get-payment-methods';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription('AdyenApi Test Facade methods getPaymentMethods');
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
        $response = $app->performGetPaymentMethodsApiCall(
            (new AdyenApiRequestTransfer())
                ->setPaymentMethodsRequest(
                    (new AdyenApiGetPaymentMethodsRequestTransfer())
                        ->setMerchantAccount('SprykerCOM')
                        ->setCountryCode('DE')
                        ->setAmount(
                            (new AdyenApiAmountTransfer())
                                ->setCurrency('EUR')
                                ->setValue(1999)
                        )
                        ->setChannel('Web')
                )
        );
        echo json_encode($response->toArray(true, true), JSON_PRETTY_PRINT);
    }
}
