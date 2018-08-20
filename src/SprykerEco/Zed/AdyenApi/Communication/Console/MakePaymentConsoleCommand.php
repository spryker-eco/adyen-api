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
                            'encryptedCardNumber' => 'adyenjs_0_1_18$R5gG900bR5rLMHP5f4IYH6KpVT4vIXOjKjxWCdxOdo6qyvKSb0xXYdAttWP+S2+nX/pdeFeeBXxNufqja+V5N8FKjlaMYzhp9mTeYyRex8E7WZh/evcjarIfhwYthIIbqfm9GFDILC9DwESSiUNvf3Wyz4QH70xDtrhnTOEzJcDfAQYXGC6mwjdfDHYLupKQ4Pb/HaqViZ5SatC+wqOXFV3dRXW3B6izt9Kq+umQUnJW+aztaM+jjGwwFMhw+wYfy2h4/AY5tEt3pFPesV1mBeAYOKrvUbdsgz1Iufp+jt7ROeSAWZBFexbu0fjLDDugjoVJIjdMI9udSQHEwEBquA==$77LqzVrtL8C7k7ppklCG/o6H3IDyHPJvGjub/GEWDEHxjcLCY4HywZhqCVDRK45ObFhUZgqwiTL5FFP1NLMlE1XRES6scGaz200po25ombelvQYRwM3tzJ/T2gCEbdi6CRkhhDbLHV0ZFCRKk0eXqoUzkYu3kkZpH4q94lNj/E96zoEcJ1JKwquQtjTWfHWDMpD7yQTv564zfjfxVFqT5tFhmJU8aBzB3T6QuzKht+WOA+vMBPcb0kOWTAne0Eur7CyOFk/Q1zOyQ/MoM+FOOWZ85zdW5gldfcRdHCAwKk+//VkyF5+ERuQ+biybvp/Ppfi2PbvWQ+DrOf+aCd7/zT5Qxm6lEumj18MQ1gIlQfkQnEuWUFzJV1o0acqJ43bbBzSWzhIn7T1bDSfgV6MFddP+1NQwewIsvzbYndudhBIkP/8yU6IYRwGEldqg5XYbIUrPigO9rAEPTFhH0Uw=',
                            'encryptedExpiryMonth' => 'adyenjs_0_1_18$gmfDHFDR4IVr28FX+M+NJH9jHPUIQ/G2aHd+ydxXxH+pXld5lBYYJ2ru4yqEuuGMzhrsG83zU7yj0ZUilkbmB0Qwtx6Hl6z1bVqWNtvt9ZdmO2DsPhiE/LsB3oGMMCdKyerH887fY77kJpH6nHhfFSYYxPjFNaCJsHT4OFV7tWc33rbT1jH+3t3t9+NXt2wo4kfs53UoKnl44Ij+gHuoYeR2/4+n4K5t/8c/7J0O02FJD7n+91IiF3Z5wSt6x9rP6PxhwedC92tvTUKaHuAmO8OqvN3rHg0zL9t2AaRRgunuLhnqtLhLqiQu9D6MveT4UQks2UvbNY0e4c5NIsa5TQ==$YdOaE7SPS7TUR07CYD6aMbdrt+xDSfMXosFoQdWTMwSXsruziexsK2otI3OwZ3usQWc9/ovpXOH/fL0aM0+eqr0dNLLgywzVNwaFTlSHq/bjx80dQwN3Bph7Q9d1UfWgjjDGNt0Atb32PnUAW6uu7uNxroZMmT/kq4qnRQx9/+bhalYkRi3qEzp5IpZKOaZVhXol/EFZQ869cR2LvI+/FrUl+0X7/wYULQYwOsAgFT6x3P/16d+rhQIWXSx5Nppe0D1hA/BYPmImx+wXSdtdLAuZdj92b8IaO8QqcZEXNXkx5JSOz5SvOQgyZz/XHcsMfdszxRz1Zt39iOFw1HoHeoM=',
                            'encryptedExpiryYear' => 'adyenjs_0_1_18$Vnhj9MGjs/2T2ajVz98lI63ZVt/IklxIMk6i+ziY9HT4UAONi9RERpBUxfd60ca9EsVr6biSc3XoV4Zm4r0oQaTSck8Irl2/VEa+iPTO3oIkxXfLvREP7JpbcauOIKXu2vwFXpBs9m+OqQuJwaFeN74M8dR+ZKqVdPHaasBHxuNPDcYGJJrJ0LiVVuK/CBPOR+1Xm76c3SfA2MVc1jIUK4Tqez+q81wuM7aDbziuT87DYD/Bl1va0FHwqa5a4lyZprdMYcgUm+XuJPhemh5Bxh8YJkjwWbvb5esNX4yqVNSytbLXOQaGK/oixfuBmOW19PdNOClmcvQRX/zg6LytpA==$ex7Criw3omKSngwrzMdE55xZqi5MAUPucB02EvKkgXX9X2pR4SHP/3N1uo1DWvk5MiXHyyxsgeVMOaSkk4P3EJPoSzQ4hHTzvejJt+f6FmuwAsXHqOvqxhPBHlBZj8POdo7oWy4yKTv7PZwTJhjoTR5QQFxat+fxoD5Do71EVQaktfSAHZNxE2iJG0bHXWzuiOPhV8UCGygPg/UvC7zTdAna0GcQw8BJHofRfxdD7EeZ19gR2tT1a+XKnLJf3a0RjNPNfwUkv7jqDN96GBkLg5F40bU6oUAy7LoVyDiKBKjl2eq0Pf9/tusCUL1+jLfF4cbbB8rEv3SEBiWA+oPqOnXL',
                            'encryptedSecurityCode' => 'adyenjs_0_1_18$cAq5bL+TaCkkqYGTTICNDd8QPqSBwmioljJ9roeu9YDxhAgCDbQj6W31PXTUIHml5Fv20ojZDsDiIDvNdhy7XT5prMwhsm5j6/WVZy30m8snxFqv2fMJ0WD9JkKV0ohyq3qJ5TGvTKig6YWyyfC/MhufluGbao15L0qbdCsRXWid807S+ngv+PGkFcboekk+sBZEJSDIt7s7PU3LLu9Ay9ljmuvaKiTgTX78hn/Csu9mYszfYyUsh+gvMH5Bnnb9o5KgNjhVcrBeWWfxAzHialltKaCfNrUO7wVJVwyJG8lKtuYYY7wWwi/M4+tRg3nSnH88jzlua5+CGacEDLB2Cw==$9QgtUj/ULS90/eTa65BV9BG7UocnGH+m2TD31k2tphApFZOvT6CTxZ/YjxpU9dwzxOTEUG0Rmag+NvV7a32iozmE8DDE7vEGvM1FGhZ83hvkvBobe/01Sd+RO39fepwp2E2SRIiCOWfmVfz5DgCLvGLlyFlEu/GmkfJZBv6sqNidr1M43L+8AZDArzuZoXAPiu5I2c02D4ibHluu8OkzEupWoals06/MjZbPCzdjMhkCriz3pNq9mSBpdlVgA3dOiS6TTy6GOGZqLDu2Vh0sh4cURL8FUywOwZjaQDAQREx105ghpWnK1WnCE5fXMLyiswmQ/kkONN4P8g==',
                        ]
                    )
                    ->setAdditionalData(['executeThreeD' => 'true'])
            );
    }
}
