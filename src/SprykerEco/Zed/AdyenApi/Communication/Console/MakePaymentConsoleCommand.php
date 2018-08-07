<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Communication\Console;

use Generated\Shared\Transfer\AdyenApiAmountTransfer;
use Generated\Shared\Transfer\AdyenApiCreditCardPaymentMethodTransfer;
use Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiFacade;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MakePaymentConsoleCommand extends Console
{
    const COMMAND_NAME = 'adyen-api:test:make-payment';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(static::COMMAND_NAME);
        $this->setDescription('AdyenApi Test Facade methods makePayment');
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
        $response = $app->performMakePaymentApiCall($this->createRequestTransfer());

        echo json_encode($response->toArray(true, true), JSON_PRETTY_PRINT);
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiRequestTransfer
     */
    protected function createRequestTransfer()
    {
        return (new AdyenApiRequestTransfer())
            ->setMakePaymentRequest(
                (new AdyenApiMakePaymentRequestTransfer())
                    ->setMerchantAccount('SprykerCOM')
                    ->setReference('DE--3')
                    ->setAmount(
                        (new AdyenApiAmountTransfer())
                            ->setCurrency('EUR')
                            ->setValue(1990)
                    )
                    ->setPaymentMethodAdyenCreditCard(
                        (new AdyenApiCreditCardPaymentMethodTransfer())
                            ->setType('scheme')
                            ->setEncryptedCardNumber('adyenjs_0_1_18$CUAltRzsyyFicv3BdY0naUcFbfWaYEEUieC+Me+QPf5b0sY0wKfetZ3oRks/lFA0NNzY9aYNxDY3ixc0Z97k2IvCsldR2Rqdv9y5cjr7B2pcusSd3Ul4+GbgY9oBADHVsM0L/Ch/YZ1kdqI1TCOPs+YcS4vsBKgFENKRyTtZ6B5RHxAAVblYiE/PqubPmYh3W89Ez6eO3dKvoJujtOM/Fxq4sLMcK80vyy4NfjH2h4onv/PwsTz1+kxp6yWiAF5RbHq3aca38Q0ao3BkhiVmdEgaO1S2l9cBb3zqE+KQaCdTgKp8cKhFrht9Ob2JIagaKrIN6RZcrMJyYJHaStkf1w==$i4F8X79AysX48ezopQpcr7G/4xSyzG/suTpF7dy2pxIDbgtzCw6WP5ptsUOz4zcJ9lsZuLmPGDpM4FvCoD16LdyDFwVE+HW6Rt00+VE6aeniT5XkruOEOkURPFEAPxSdq57J0Df5Rda/q+sLHLsYTTRH41oYeEMIDdG2vRC9l9AIXSsQIKrk4Ran4ff2xa0ZpLA8qJA9EIdUcqK8GR+YhDbndpLBIRyB7zs/Cz3iqkchGfeaK0VCXpVD0f/Kti2gpN91CJ2KGwzZ6z0vYTxq2WdKX6z+A2itlQ4rnNYPsJnqh9yOkxQDA5nYc8EQThKRsdUfhX4p4kyK10XE5fjFIXyfowhUKemN8nVx6Zkw+r27ZQUMyRPQoBWy8SZBZCtrs5BIgAAQU1F5sEuSz7jQ0t5DPecPvakwDFG3o9l6T92EhECBECL8ATL1uXZ6ZKRPkxuq8BZwGAzs62n0mCc=')
                            ->setEncryptedExpiryMonth('adyenjs_0_1_18$YXrDSa8LwbDgdd85AFwodcldoTu4PsruGwz/FAgmuPAFKwwutF7IPN32EFSgltj2SsKvNq0K6CQt6wa/8GJ69XAZ2mAl4+jfgBZY46AngN+BGgYKzARwUv1xOpHmCp0NmQHPbjnAbe1JziGRWM5MbLWhWRsjpGSLfEKHbH/V+2mE/BcBLg+w1aZXs9CmTW9jxIzhmXFcJKklFr9SUjv85EsPSxKOMZauIoXZepzgCPO7gD2xzHAoi0/WWZ/z9cCCVFrj9jY1tWJrReuUiTo+cZYQPrPlOdXQJkalao7pin2tKBj992D4VAWJ0zTtI5HPn/nh7NjwWDn5t/TFRBYHrw==$9BG8/FfWSzBh3CyDZ91VOYVOHRcQSuI3ZHczCTOdp6ZBAKe5/Zk2wDWKTn2Enruxy3OqmFABEfplwVRQU41df5X7fe1vTUXdr7VAijds846V6RDmk+OBrNstre29cdE1lzOl3ZuyP66gvFckCKC4KGRRTMNrbEjy1Im2GExhEHAQInTc9rldUuWobRVEN5VthWLMxEwTQ9GSswx/BWz2pYJLDdOfApVOR5Ndq4k8z6A0p+c9iA9FW7eR1BNRn0mKAi9tWFhdwcdxOT8XMGexy4u21aICONQ3r5La6+vg9CtKMmAviRAkiuQsrIOFDeVxKyokEHdtgIvFR+z2ENtkL0U=')
                            ->setEncryptedExpiryYear('adyenjs_0_1_18$VRjSz5I+547fwPFxoEJ2MqAqbQYTXE3RNq2H0zsmSU6CEOijSV0v/0plMnCDWP7dQd41LG9hJ4AhpxBEJnXTXOwLDlY4hBWBAIZKQRgfD3lrHQ6nURJme/F6ohbNjf3Bl2qV2RpKDcSRxwdk6tHKpVfgi3FzUMklDEXmVWW5awKDv2b3Av+PBL061Oesb9dEFMC/2feyV49bWsBENNtUjvUu0MYpFj73Yc2E2djFL30O2xTdGJ9w2Zr+b+UJStQl6ZcQSCBWgzUQ6zxHqKa7i2dGHKZhLf/1Y8W1ZXMv6uroAmawlGd0zZ7mggto7bu7DkhFMJhIalnOl+1kKDmXKA==$2JiU0zuyRDJZwlJJxEliaAJTva5ro3JxKkC+RWbWxLsuQ0gYmpvGibHvG40yOSUaLpQfqTAcaayO0v6/l5TgVIVoT6Fl8DvHnpZQg/pAap9SDYIxO28rz6ziJty8L9bPEQBmPKkB6CPGGEtO3X+d8vr81ncNGRSrsYd1cqt58DetqKecXThMCyegekdU61uMjW0bi08/7mZwX1prQrX9U20xz9mGs2h7SUMeJl5VGHYck6pb+UCkbdTiU204+s/pUzMh2DojcBgVpH52v8Zjk2XWQFCF1EanL5VUztdhl1KxxmNoS2cOkCupcMRwFcnJstIJy2C7KfGYcWn+flMSXCzs')
                            ->setEncryptedSecurityCode('adyenjs_0_1_18$df93m/FtJiMfFVoz9c80xO4nocBj8ZPQ6eG1AzJN+P9YmfC8JNV3+1bXR8+F6wKqhbarfPb7V0+usSLwIMu/A4FsT7oYQfZwwYoSdsfpeHSqNaqhnumB82wsYxW5/Ej598YZbjSg8XzuXU7dEryuGOT2OVK9mj1cm9X7oi7Isyj+3ZdpQEWV3qY0KMk2t4j+WlGTavq+D7KjiK78QGE2L1skldtngxsz8JAfj0MVbKG4lnm+JoM7jctm5EGKCgj44VpY3/KS5xZ3/7Q3XoHpRrwqyyDllXf6gmi+EWxghG4V8ry++LQ0BlFDv7vlXFK9sHq9FTZJkwxpJxyvZ655EA==$kRi6IFVsvQ6bcCn0o0+cYKqnc8ROeF+hO7nsWOhWBoiDd5ZDodCXePlsgzPJi6N6kPEcxi5L1N1c5g365cLlnIcUqLHmEYZBA7LdG1OnVfHZh/Y8nMre38ejgQdIQaDqVoG7I4uXXYrQHhVbAm22vxSQQ+aMaIfNvrFJuSNflM2uo0ePK6amMGr15j+cr2hxY2gYWurDHfanzl5Klku3RMjsP4N3Zw5m6vknNgRL0cCSkEqOZXcHViV/V0beIYq9gakDlqttuouFJTQ2J3rlKe6Sf8/W6rTD8xLD6ipcrmK70cvOF/N26ewJMWyhJFKaMdAqrADC6Ykm7w==')
                    )
                    ->setPaymentSelection('adyenCreditCard')
                    ->setReturnUrl('http://www.de.adyen.local/checkout/payment')
            );
    }
}
