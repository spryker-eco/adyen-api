<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
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
                            'encryptedCardNumber' => 'adyenjs_0_1_18$nkQObeZkpah5fKBQa3iB0d3SWqYqf6AzhAtWF4v2rpDY+SKdqt9ji2UXioWbA2ZtnzenFdvMe3lW+rdLLrfZnORkhYizcShDQ2ag4nfgrVG066kIVhCWrcxJkLa0xn1EFeWR3P9Dr7VZjWYosD8FotPJ4B2azq1/tmVu3BFA22+dVSxHXT5kh2YiuWbFkd4/PD+qcGZNQ80y41FuYEDAIOtwR+zyDN4G8IjFSg6OWng/hJpTjeMsJlLz7qcFq8G3MxjOce7LpvxMNJu57qfq7rA3WE1lFgIHKFqFLNycpjTEPiMSQpI43xy+h5PGtCp9CUt0VFVM/a3XeUzD2x9Ugw==$U9L8tOA+aGpY4BpowTu2DwTBUFBt4s8LGErZvkPG2AQx8el1rXj2AAvN/YwIH8X9+MVvGFazpF5tPXnB7922GEtt5D8bZpNO6VH8xL/XiwXUXw1MVay8ypY1pshItsaAWARtoDQqRQrP8p5Ss+IuzOaybkg/cZ4UPxgWY+VKPgI7GWfmb9zmyNq+aMYQiFEua6Tps3DtI31HiIMv9jA2fD1uW4iIhIBMLKj7hDEX2tGFlG5aDZ7lc47C3etGySvICVVho2b1H5/uZ0/9zcHlBpWc6SWJQujWLYk4gT/jpz77qlPNOuPZn/n9zrJc4HMENT8S7lcursi1tsrfl0mn+qnv8nSZXxGEeR9fCfUpAS1GsqyjBGX3vnMhzCbrRkhWiVvIwneXe7okxJOy1FYRxi7V7I7Rh9hCz5CVdmh+Mfzzb45UqLtSjdJgdo/kElZnbWZD7elyVDuS+WcdCLIWX45YbkgHDQ9/1PqfqcC9lA==',
                            'encryptedExpiryMonth' => 'adyenjs_0_1_18$lXcsHhPdqBF3VryR8i0Du/HdAEg07rGrcG4BpTBOh+cxBs8Oh7KLBeLdrwbXgYEF5RYg6zSe3b4H5N5two8/cEzgWgnWIBtnNjXIEvoUjigYoi9WU6ZHZVBqDv70o7iDcYwKcW7aRFVsT6g9Iwj47Zc123PJINFK+kd/C+0DFhryTzwvNrD5uRb2qC6qJGHf7SkRfl/Kpt91/Fg7HzbxWFsIGkuajW/MLMnFkN08swvJ+/jBz1YzT2Y4ctUEk08qzOI9GDasxXZyMb78uLtcj6vZ95nBXUAYrg+Y7xSUR+JmeF9N3I/QZP1i07aXWIPSrP7xyWPiuWHY/xvhpqXc3g==$2eTGmksTclRyMqhV5b05nA3n/pB0uU2g8isF4IC3DqEwQbTh8BMPjMwO/JN4JTariZYpBW5DLxLxsvlRi5OEuqsJmbcK972hii7MdpwzvE/W4uh6ytra2KZIC0wJ2gA0o06j/OXMZdBcnptYSgobEgegatPNrfSi5R19nBIlFzwLKj7O1kyDTMRi7K1VgjEHSN3gKWw8Q5EbGNmhDOgRJgGmMOw+n+f7lXBsBKYIdWKbMGB3B8Hj7+2h7hSqsWEMjdgQIjZDY+20pX9hnQjuGfuDK1E3maVCtsvPhpOfjNz7MvvVyXc4HNcwXvYf/7rvaWunfxyQmRDDlxh7xQHzT183EEvVFbRQvHyb8Sspy/rpXw==',
                            'encryptedExpiryYear' => 'adyenjs_0_1_18$NXWIZpyMtp7BzA498adeUj+ycHrcBKUJZC7L/cq2L9UgUFnbsb+fgtI41z/wCrv+eXBs0iGLsFz/oX6s+N8pbttB+3jOL1rGsVWSyypqVxFJ6H+R2wBqLrfeKkANswqR22NEafZn/7NdTcUZcsmByFPmcMyVxk/BgmpyaQOzkW4wQQTBYq7OqNq7GV7+9B3QKyN3yii9Pkzd2D+Ql2Q2lnsdhZ/gjolnlkDFCZmXbnwZr8Wz8zvJdJ7vIgurBPRWMBVNrvGGKE8fdL/U+VbfI4bi6YhNWmB878TURyLyIi1pMN2TqePIObT7cZByUs9wqEGIN+rcOYOsOqTt6HQyDQ==$66ycpdoAH1BvFmNDmuvl4X0tQ5aZN3RKQ4FULMcE4lMx7lUwCqbZQv7DjTL9IPEf8JzzGE/C8GPSaUujLYrc7JQUi1VYeUIymUYL2Mqxvb88a5/VI7ChUwnjhsQqJHvNldiLJ16/deqaEzCPZINXs0seLeNBTu/I/JYOFoox46cEHD+OruCWQCaHWn9A8bI+bdVXbuYMYG04VaZVG71q6HaB4zL1COeSxYBxkyF8niaJ49YnUdfkxVcz/3sImLNjCZjy2hwE7TaPkhoH78iSHHYurlOj1hvmT+IsRlQxv5MYBKLLS40yywSOZz2BPemjQnmyoKsMkRWuYX1cx+xXwCgskZqIECTOeeZ/si26s4P+SQc=',
                            'encryptedSecurityCode' => 'adyenjs_0_1_18$e+/mnLrVvf9cxUXyRFVeE8Y3teD/kvRfQFNdP13nPuT/ciL7ZhnqEkeoDhdV1TgehddSoWnq/hxlS1iDFHaxDtZIFGCGFMQSw3wAUyHrvtzu8F37rGfQkpQdvZ7EcQemjDGjYv9Hk4evEcqhPvSX6iC/xTSyMRnJ50vQ6IhGcGSVEjKb0NFsRRAUiuTnfmj6jQNtrZkjNoxfJcg6Byx0kUC6p7PjV1DP61ZunNu4kXp9uaX1Yof6racaEykLepNtFsRwDyZyr/3B/LePXxqk/nQmnTE0dInb0gH4Dfs3WhWqzVLSNPVcmOcsxwQftd8ba5PJLknd4GZo3hPlkTL08w==$0fzyfTcWwjQhPV8/JkdCHItYi45F1AmTJ06mYxAIwm1rIq9GgqznLq0+0HxtWTtVfer0Rr19NEYULslYDp5baCdt6TP2N2YioC5lG5ZzEtQtQBXyFhT+cee5HCPBvEbeHTsv+kVCo6XhfhklDAj4tXlBTPzOlTKy1wl7qQQ7/DZIlRnDW+c/SkvxwxtvrjNSLVZVq3tAszZsVj6qNuqhM6NLVv2kNcCH70XGwYpTSZxgq0y+vl0COP8DuKYFGhyJwhzEWppVwa3vDT/3sQFLG3Pv3N0Z2r/nMGirJmok4yUYe27cRMAhi1YxupUPPjZfe1SOUx+4of8suIPsdfxDaMr1UEPpQO09X6ZL',
                        ]
                    )
                    ->setAdditionalData(['executeThreeD' => 'true'])
            );
    }
}
