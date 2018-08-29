<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Communication\Console;

use Generated\Shared\Transfer\AdyenApiAmountTransfer;
use Generated\Shared\Transfer\AdyenApiAuthorizeRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiFacade;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class AuthorizeConsoleCommand extends Console
{
    const COMMAND_NAME = 'adyen-api:test:authorize';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription('AdyenApi Test Facade methods authorize');
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
        $response = $app->performAuthorizeApiCall($this->createRequestTransfer());

        echo json_encode($response->toArray(true, true), JSON_PRETTY_PRINT);
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiRequestTransfer
     */
    protected function createRequestTransfer()
    {
        return (new AdyenApiRequestTransfer())
            ->setAuthorizeRequest(
                (new AdyenApiAuthorizeRequestTransfer())
                    ->setAdditionalData(
                        [
                            "sepadirectdebit.sequenceType" => "OneOff",
                            "sepadirectdebit.dateOfSignature" => "2018-08-27",
                            "sepadirectdebit.mandateId" => "8815353542477270"
                        ]
                    )
                    ->setAmount(
                        (new AdyenApiAmountTransfer())
                            ->setCurrency('EUR')
                            ->setValue(1990)
                    )
                    ->setMerchantAccount('SprykerCOM')
                    ->setReference('1234556778890wqecdas123drrg')
            );
    }
}
