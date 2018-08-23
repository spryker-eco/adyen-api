<?php

/**
 * MIT License
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\AdyenApi\Communication\Console;

use Generated\Shared\Transfer\AdyenApiAmountTransfer;
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
                    ->setReference('1234556778890wqecdas123drrg')
                    ->setAmount(
                        (new AdyenApiAmountTransfer())
                            ->setCurrency('EUR')
                            ->setValue(1990)
                    )
                    ->setReturnUrl('http://www.de.adyen.local/checkout/payment')
                    ->setPaymentMethod(
                        [
                            'type' => 'scheme',
                            'encryptedCardNumber' => 'adyenjs_0_1_18$TpPAxno6iIzmxRevF/1yeDpjioRFCr6PB4w+Fpfys8YpMU55XG1ENpzqn6F3zps+ZTWHzm8l5iNkDKcHWuYYOtYztLbm9KMZFPdU9Y0KDwUlQUCvJasPnB6FvzfABA4iLxplNw8XLg6mxGea37ABmXH4JNZpwCxKvzONaE9aPPNh0NbaWju5jmmAqOZzQbO1lGPfiNRMnOfQTGSFVCLOaDM6vLLS9QTHVzsKb3XbAnE4hE28n/X3ZZzDDCA9fYswsJDle84N+coC8Zf31JsGtDAp2VrrYC0udyFOz/b4YQ9KdaVZYyXnKXw0tIrlgsPlQ6OFsjQuxJtpyw2NSkv2Ew==$eTneW7QMdu0gvZeyH9s69gFmT9jDDBB0rE3KmDpFctF9K7AIUzd2LLbewNsZ067tNtLGRDI/AXMauKExXF++1P3j4lcQEa8nehNCLkhijKkXfBJSmAf+JijAlYtIKvWpnG/QLwldNbfLMHn291Qa5B/KcQMTTLP6q3sMdDohMEyx0JIEt3zlOJz8b5lY1hBGmp4tCOmEiiIoCNjx44/fKrDPd9TALCqDuhpn4cA/c8pmskByxN9VxDHjRYl++EkjhEbSxP7HIjN1khDbUn4OiPxa8QnxX/PtdCdnKoqapPxzr7DGhCxfZTvhoH4X72+dUn6uiT2GZr4o3v3G6j0Jk1ceGKLX0UrwSaBbeYamwTOp/6kJav3IDcOucnOHScRG5EF8nGcn+3ClpBc8uyqNZ1gVq7Am4f8yST+cbuM7Q2EWLiB7noWj7pk+pZorUl+cL53/nm+LoGi1RsX3cfUJdw04AAt29/dQKpHj5DaWnw==',
                            'encryptedExpiryMonth' => 'adyenjs_0_1_18$VBJ9EGp+78on/n3j80R/VTYQ+QXQ/jFKI9GwHGPRTaVLoS9rHr1PkkHneBHjLFLUqQLdnlhY96onVEKCkQQur80wbz+RBVm+MankRLYc1M9CKkISgzh+c1ZQCQ2SDxPOCrKdTy0y1+a3tdP7gKJwbrSgoROV1Mpfpf4C3OtDXE4tr9/KVFNfByM/rQmiKyFuoBzq8RPJ30SqP4ahmsMVdAUgwRdAEpLtZyFl2RSAY6mui9LfMx9s7K6UbB3URugT6XxXGU4xdBlMDlsLbScnCV7tnzIrESm725SKP6mgN9TilouXARxrufpxiUgsfv5jTEULP16LT2XrTYTCMDv5Sg==$ZVAmqLTU8icREIrk+RXc7iNKXArnBGn7WPa/v2c7h+ycsZP+S6EXIZ050RvPXpdQSUhMb9SKLjVDTJYK0iPISXAMcpAZPj9AMBKFoF7EBazubiGe6Gbmfjo8QKx1LeA2SjUG7Wx5aTmWuHnEOybpqQHfRvjlVVrIxXlAJZNeu3jt3GRDK0cenPKEl+m2viZQMb6eRVO3KELZdD/OcdgYqW/ocg5yserI8Kwr7AyO3FshZTCejyToDL751SSoYXkdWe+/1f9vbaeUZU77v9W4KtRM2knVsUz6bj4jAd3ZGNVrKxjgMgg/PWeQdy7OpbLp7LeSHPiy2pQFXrY9htAQUSqWDIGuAQAkLUsw/okr7oN6aw==',
                            'encryptedExpiryYear' => 'adyenjs_0_1_18$jeOAf7L2QZCswtiuzr6bT9XMZ2fqNOgJPYMkqZTj/46kbkG+UPFtRWiMbTHS2rf0gv3ox7ZFZFona2zhqscoFghBOvAoYlpExtzLqOYLRf7Pzf2sZrx6cdQMGIGMv0MmzZWgRZ1dUK+K42FEeekxfEoZABcPn/DXqKVInWNtQ4zS3nqG+JqYd8Tnj43g/jOfzeUVBwv9IYNBc7F/4R8MOB3KyjmvRM5ILlpucarM1uZWeU8Cx1DUEvIUDRAmxgKQA3yhtu+xSGrQDUIkKVcrNOEZbk2Ia0XCTW+nxhCYC2ZbqORWlQsCATW1SC/yOq4DU3VorfUhj6l+JZjT5fvt1A==$wV4zTN4va9+TqTNj0hY+FpzYsAf1OiAOg1t9sp+/9objMZQQrJovnc6zLujndk8zYYPMaAyqgDzlPNiduWoc4LkrkOoHnNLCDI0wfEmvtcpU/poxj3bX4oqHBWLPRXI1wGOGrkjNFfefBDeRYIk7Us1ztprGozgrxfooWj0ntEjIb6+XD2tGHhbLy8cT8Dm6sxC5cJp8ecY/SkaAh++LUHt3BtGgQKrbNfRpf1nVUoYHj2aR0SlN6x6WyBsmkNfWSO1PYwY3900OCRZCJ24DDWX+6wQerDLgpxWh0A1rc37aZGP4F9nghLrCK71mfMwWNz/g0wAXPse6nBU1XbG09NGNouKWAL1R/FjB8oLGNWIfneM=',
                            'encryptedSecurityCode' => 'adyenjs_0_1_18$uViZ2I44hvsRCNz1b9klSu3AoBx0YSDvzj1D0IUFaXZ1NYUpRTDS1gNcJjs2r4ephG11Bf7k811Hn4s3J0TO1k8kVE4eq7ZG7NjlfR8wjH8ZzEEaA1WcKak4WwtbmUZ3uIkzpkaOA2lWxpxze+2rjlgWjXA9mwMtt5EUPq/hqRTBUQjlVrBCvEFyjcPfNNzba4Qz0DZvv+otwm5QBGtUQ9dhsBwkp7K5InqlsTjIObMRRnTcHeap/fr5CyL8Nv06I4/MRlK62YE2ODHoyKcJdrIT2CuWGfm3MTdyzw7oKXhoktm1y4MpWsPaJx1QSxAgU/zVFLW9KvyyXw0tUEYplQ==$KKyKBfPhQsOiIxE7c+ohMqNZu3iNVSSYKLVhY65zVqAwaUIgYKtf8oR98mX6WD9hq5mFRSHb2FePHtTO1gItiLEBmybM7o+HymqzR8HsXkbZGUNz6x6FsXmLMWOsZj361bpBPl/vB6DMd22c2/r8RSuMosgTu+sPW9mv74FNxCJlaSEMOylY1ypkY2YGHpglCwQQHzAjfn7qFNq1QfzgNCdFcOBwobij/0c0Mn+cgQjqaP0nC9qS0ipQMljwqVr5KslSfWPzvRxtYi7HMIaMSWAQaQn4kdPJaOhQ6i6+7vuI3MPIM/mmLUsyMeVHqZghIRrGraTYgAIeqJlbc3XZVf5C5k3LY/S1Rt5i',
                        ]
                    )
                    ->setAdditionalData(['executeThreeD' => 'true'])
            );
    }
}
