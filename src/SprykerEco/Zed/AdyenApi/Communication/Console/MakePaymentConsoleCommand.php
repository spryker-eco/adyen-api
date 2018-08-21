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
                            'encryptedCardNumber' => 'adyenjs_0_1_18$nxW8yMLhAHGgn97ZdY0fS0SLC+nQ2+TOye632tsC8mju/8q/r8DoiQTsu0OeNpMRNhtcaQof5DWlv7zs9iKW6J+NajVNB0us5lwm2B/GsVtyGdXEr7TSaaa6RtJG0NCvJb2YeJuCGgAf2z50R6bKkmuuXyHAtglLY3mWkLATSBcam2tL9UuYYrQa74Gg50hWNXuEoFCgTDNdXN8uHs7RjkIHnh8c32YwGMrZzZI8F243q+o6+fls7C2/x7q7VcXI0C9I1sKrgpr1nNosVwEbnBqXiZZD59OTVqG17A3BrrVFcAfgz2GJ9vW42QMPYcpi/nMb8UOxS7w+Rn685cycxA==$zq6lyDYh6dfa/H58LzamJntBLABHbfTwknnOhMvszW73RtVJftWCJ1a3Th6I7W/MRIU2LE+YrYeTod25WwKwbd0UbcG+C7Snjf+w+o2aYkJjVMyjmb6gMSO3bHzaYjIX7llhV1pyvm39biZu5JUr4Lpf0mXCNvOUjjjWU+ujd47VhCarIj1wjEhVftM0t+mcBoWHU2Fp895eOoIMzueokBqpFTtSyEiAR3T1n/z9Pb7E/mcjYTA6iJ52UReEyQdRnAGT0U050cMmO4lyCgYqISkC+NznLp3Jw9eJcSB1mGEtQImMWv6CvebvzFtU8Gb5eIRbC//958zuYp4zEj3yfd459P2tyW1WG6ZdUvoKe1jiiHoI5DieNn8cF1dr1oIzdgeJO/8SRUsi+nZq3qZ4/iLW2oYX1AIiBtWxec7rEVYXcQPQfq1vS4U=',
                            'encryptedExpiryMonth' => 'adyenjs_0_1_18$VJOUJ+Go+/Ti+ZtI5fchAIlekSaWeehZc8YiCijZihDz0NNEGSfCopXXNwJqmzWfXNxNiiuqSEFJDK6VFILlT6Kr/kij9yREqhyT/zkZNQ3GmAuGQPf4jcs/oPIHRiOuMvfZvxiTff2Q8QliuNHb8INwaq/+AOj8FX6f8L8hxu0qtDulKBUOGHa+9H0ibeH663t5buZtO0F7qZRQ6ChkxnW9ruJAp7I/GejrND1rDpRYg43TpWIm2L3HStEoh6DM6g6UT2AyMNO6mSAhaC2YFLIeaGBTJehAXTHEnCotvftZljk/dPpyS25XZ641PsXQYaWy6UAcqiB8lAlZyJFcGw==$hd+yCd/KTZh9hCtwzqcB+8/BK0Fxloz7T+N2BOkw7Yinaj1GdeTtcdUSgeIixV8zv12oOlXCmuR5gtaiVXEfKkPJrzJzPN40iNSV66c4ndHUsg9GJqiNrshCZc3WLE95u9FgGumNrnIwzbwX31O0E5knKOaD9IAGVK9cTwsCVMqx0WMt6o8CDtpmg/gODF8/Px8Y7qTm3T2n8SmK4or1SVU3XWlnr6i+g1Zk/dT8V2mHDzAr6IZhIS6K9ZLn5nbakUm/03xl4v89JwWYd/QNg1DbLeh82E983IaoPbS5qMoEn6wwiuF7B7r+Bmiegm/okMjQVOBjyjGm9WNxdwnGqwI=',
                            'encryptedExpiryYear' => 'adyenjs_0_1_18$hYhF6P7f8OTotArQFQqcz76x4w43iAE27wD9v8NgWwBgeSe5acDGlj+zkezyOJWTEmd+dnvpuf2Kv8Vr+r//vsdt4SltWvsb9FjgnX/SyoTjAetvgQqh+NIW/bC8wzD8lX2UQ7g6yiziJRzwJlePR/0knoy4C80beFK3OaAhKny2+B0aogff8LGzC73rlCj+4tGRKgSU6rPB4s33dZ1hMqjyWaAXbZo2nhwU58T13oAP7ZXR6dYYqjm8trTEw7kqsW/lfBlb3FZ8fbmvUVn+zrxbmbjbq/OfV2eWejSKNquDdERhbFRl7lLLnJYRSuQBf2d5z5Ub/EEpDzPQJaCALg==$rfL6txq1a/3kTKxyJ/5QULF3pZn4hNnwmYzzVZppWgM5LFA9yz0FAOzrIxSmIBKzIJEcVIMX1O/1EWllzIKS9f9q1I55e1ii89MSMtokEaQgKOz6Yngm8Kze/6MHtEr5BHZRpsYYaDA+jGOv4GSKoldIRwKn9tdYqn/mwDf5bCYvYThJSdhfuRrPMyYqz0p6xmORuOqafgwduscAAiunwinxiRx4O/OyWaAf0h+APAeIO2x626QGLXBr50DC6pFQPeYhg1Io7cFiquIu/p7fQ+udhN7p50gRCXdYB+/rslQSEBXPSN67RD1Gjf7PR0+fMJk0KeP7LALbVFYS3u3NSTgo',
                            'encryptedSecurityCode' => 'adyenjs_0_1_18$BMdaJdtnvvjE97JHES16VGZRGSXDQSA+CTedIFWuw6giikGs8f6E3rwfMHR7p0UZ4aJBtYh3U6TNHs6hrf5bXDQl26eRgLA+5lmYFZHsH+8pFZc18PVeWDL4QNusFTTLe0TOFBhfv+lUS5M5shz/nbuM7XhFG4+A/DZsqjKWKW9gpVe60srtXLTfkvBxCE5FADjR9uJeH035DvCTmBKAhQJErEylcpz+pTd4fWR8CX81NrLaNSwjmefmLhCEwWavWVGYyJCjfoDP0FshtqaLzWoI/WkeTDsr7l5XyQzlBTmHvOLw4sZgqxnS510INUbPwPsK4OnkWqazlM09u65vTA==$5xxMeX894gutDxmPDydZoLhRF8qcQLKEduNftTQziRqIZje9d90uGXWG9ba4eWu7J+bImrYftTdY4kJCIAEtxGxmcDppObiGL4+LXGYNxS4afF5MzyNiQ2utENk+oa+Z6ANbo9hdFjHE2cUfInhyGDbDYBF3ejTAY+DlPU8ZgF5t9rWeeb01rJ2HtbBwSVyRScdYE8QepJv6Qt2cbU5sQG2jrJlUg1Uognreci8hEtGTJ4Up9dzsekisTNNbSQozop/5KqdMOISXZov5fjbFKbYzGMVNzMNgS0FbvSyziG4TZUeyM00OXTaqae/VtpWK7qZQv3+EhqZ6VQ==',
                        ]
                    )
                    ->setAdditionalData(['executeThreeD' => 'true'])
            );
    }
}
