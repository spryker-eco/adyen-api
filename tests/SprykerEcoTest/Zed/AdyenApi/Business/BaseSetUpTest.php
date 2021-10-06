<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\AdyenApi\Business;

use Codeception\TestCase\Test;
use Generated\Shared\Transfer\AdyenApiAmountTransfer;
use Generated\Shared\Transfer\AdyenApiCancelOrRefundRequestTransfer;
use Generated\Shared\Transfer\AdyenApiCancelRequestTransfer;
use Generated\Shared\Transfer\AdyenApiCaptureRequestTransfer;
use Generated\Shared\Transfer\AdyenApiGetPaymentMethodsRequestTransfer;
use Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer;
use Generated\Shared\Transfer\AdyenApiPaymentDetailsRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRefundRequestTransfer;
use Generated\Shared\Transfer\AdyenApiRequestTransfer;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Message\ResponseInterface;
use SprykerEco\Zed\AdyenApi\AdyenApiConfig;
use SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CancelAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CancelOrRefundAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\CaptureAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\GetPaymentMethodsAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\MakePaymentAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\PaymentDetailsAdapter;
use SprykerEco\Zed\AdyenApi\Business\Adapter\RefundAdapter;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiBusinessFactory;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiFacade;
use SprykerEco\Zed\AdyenApi\Business\AdyenApiFacadeInterface;
use SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceBridge;
use SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface;

class BaseSetUpTest extends Test
{
    /**
     * @var string
     */
    public const REQUEST_MERCHANT_ACCOUNT = 'TestMerchantAccount';

    /**
     * @var string
     */
    public const REQUEST_COUNTRY_CODE = 'DE';

    /**
     * @var string
     */
    public const REQUEST_AMOUNT_CURRENCY = 'EUR';

    /**
     * @var int
     */
    public const REQUEST_AMOUNT_VALUE = 1999;

    /**
     * @var string
     */
    public const REQUEST_CHANNEL = 'Web';

    /**
     * @var string
     */
    public const REQUEST_REFERENCE = 'test-request-reference-1234567890';

    /**
     * @var string
     */
    public const REQUEST_PSP_REFERENCE = '1234567890';

    /**
     * @var string
     */
    public const REQUEST_RETURN_URL = 'http://www.de.test.local/adyen/callback/redirect-credit-card-3d';

    /**
     * @var string
     */
    public const REQUEST_DETAILS_PAYMENT_DATA = 'request-details-payment-data-string';

    /**
     * @var array
     */
    public const REQUEST_DETAILS = [
        'MD' => 'md-test-string',
        'PaRes' => 'pa-res-test-string',
    ];

    /**
     * @var array
     */
    public const REQUEST_PAYLOAD_CREDIT_CARD = ['type' => 'scheme'];

    /**
     * @var array
     */
    public const RESPONSE_HEADERS = [
        'Date' => 'Sat, 27 Oct 2018 12:09:29 GMT',
        'Server' => 'Apache',
        'Set-Cookie' => 'JSESSIONID=C53F3EA38EF2D66CCA7394547D111C18.test3e; Path=/checkout; Secure; HttpOnly',
        'pspReference' => '8515406421692238',
        'Transfer-Encoding' => 'chunked',
        'Content-Type' => 'application/json;charset=UTF-8',
    ];

    /**
     * @var string
     */
    public const RESPONSE_BODY_GET_PAYMENT_METHODS = '{"paymentMethods":[{"details":[{"key":"encryptedCardNumber","type":"cardToken"},{"key":"encryptedSecurityCode","type":"cardToken"},{"key":"encryptedExpiryMonth","type":"cardToken"},{"key":"encryptedExpiryYear","type":"cardToken"},{"key":"holderName","optional":true,"type":"text"}],"name":"Credit Card","type":"scheme"},{"name":"AliPay","type":"alipay"},{"name":"WeChat Pay","type":"wechatpay"},{"name":"PayPal","type":"paypal"},{"name":"Paysafecard","type":"paysafecard"}]}';

    /**
     * @var string
     */
    public const RESPONSE_BODY_MAKE_PAYMENT = '{"resultCode":"RedirectShopper","details":[{"key":"MD","type":"text"},{"key":"PaRes","type":"text"}],"paymentData":"Ab02b4c0!BQABAgCZBBzoglHwahqINfTBa3E5IoueiIoh+T1MHgssrqM5wOQg04Sn3ndWygxMXMkUvHOIzBZfzb810lQzXtTHtafea+mfFlPRoPJJhJI6k484Qg\/dL0DMhA6F7uJwlbY9POnQTNZrctHxt5STe+ofBc7gVWBKLuIJMRVX73nOCx+e19krrl9ds09UZMwXhUBTO1nxU0jIf5bGBN664Av2iDuelgm\/8ScTThDSLnfJcDb+MzW03yY\/dR7wu4HaJ\/oAWIL0GY59KPrPELFXhl+7D1D5N6qGvquh+\/HXCO63RaoOfd1NNA+Dj5tXfv73ufXQHK2LdoXbyDhXtt+AsKiT5Tk6cUXxspXXFfF63ZkfADkHBLwv\/jfaJhf2a2rcNy\/ndWHStJEGT+sdNTzCDSEhxOGU466FWDckt74bmf\/X7VvRU8bPwki\/UWy5uFJwu0GE1sxdUHxl9XGdp4RjTjr46ei9qgbc\/Hgz+glo\/aho\/9SLzepx1zudOQecvlAVve9HQAkI3NcVxqcaOF4xc9SsX6OLQjIoxZ7ilC9wKhMLCbDNWnv\/3CIj2K3Ch7KnkpEgtyt5DKi5UAOYbJxGsir9F5s8puMuqy5zlyipemxOxG092BuEVdLeWqo+q1ImGJkVs4BclMLbyUTO5k8756FvuVxqNwafrZIykQ\/WxJLar3rLGhDrcdxJs461EujVIjTKUr36AEp7ImtleSI6IkFGMEFBQTEwM0NBNTM3RUFFRDg3QzI0REQ1MzkwOUI4MEE3OEE5MjNFMzgyM0Q2OERBQ0M5NEI5RkY4MzA1REMifWRLy8K+XNYDwTcuPYECFtkYvjsbfp8gKhRbO9d22K\/ZF\/DALeRxCo4lZLiyIk8rnQ8ujTqi1gO\/7fb3gvZikvNW67Zee903s5Jo+xlTy\/HkMp1Bvi3xfZTUoQZ23rzkTO\/2wddFrJjXkoVUhQ6HEYEHKOSoTG\/ImihvmmB3NxfzVvg+voq8tIonwP1HCqOKrVpg6o\/wrSyH9tNEOxDdGInAtunJ3ha2tXkT\/D8G9OTGYeKJ0eBdqJHRRWXcl5z9s8WuXYWNRbWl0ngvMHpU1mhFWSsJW7wzjNvdR+nGRA9LWELYak2yX903u9UkH74xw9CEuDULHlYoe+mHl3uIl7hUeoPrCag4Jiv\/Wnz\/LiirU\/7I33qqoe586luV1vIEu\/igt3gDd2vMn\/avi4Um2NjDri+00fpDG0XNqztJFVnzbrByhpne6ZecAdP\/VDXUJCjeapksHf2NIG1dTr7lxiK3vWatH7ysGd4rO3Vu3A5ev5SpLszuOxhdllcjrARCe0MF+qKU869NCXYLt6gZpYBMg351XkzFlYKAVZv4Ckz0fHEJ0PHligQDcLvzvOxELqLPNwGVw2nd05PSt6ThlqG0cKlD6u\/6nOmxCOmHmPFUZ1Ee9rk35fEqX8DbNVGlVa10Eaxv9E\/LKfbcn4zgeaU20S+DRx9ViELL727PBPrGagxXdtV3D8znH1LWTDhEqkUVTzK1kNCGjvhd3HJfyovpZuAsgkHkGvdfWT3RVI\/pWLaELNH1EWFxoJ\/ignkZTmUOzK\/OFMqCO9OyYG7e5pBKyEHrSyHX3rYG3ZQrmGL\/BdnqAxBowF\/DNoX0rKBzYT6hZll3ZDr41PMns8GKECElIXdXRSi4J+HjOx5os2FPs0Fhz7qOVmNBth3Yr9B+KO7LG+SReyu2IqdgWqPIjowX\/7qHmoskaJwuDFdqeGEm2zpmEyrGWQVzp0w+l46BNkf7JoMRQM\/tgqAKl+ROiEFNegMi5SxNXr4DmdFkp4RcrYe184Op\/HQbqB0jSvhP0wZT+tcnRDbJaGVwNagf+OV0E+H5Ohbme7UWh\/\/GLgba8xQR39YAEj\/nXgGYM\/+vRI2Nqw3qllYsQnyp3Mz50oAY6K3QF+uke+pn6QLFBWMXcaXxxUon8GT\/s6JHMX9bl0+5AO8s+dEa\/RfZfw4TRxThAFdTIXjw\/zrGe5CtQq85dCGT9QoEJ+WnDzmOw21UQp1G5VfsMpVnPxdWiHLl1DzZ3SAfPyEzZSiNqkX0hXsbNLA35z8\/Fl4ncx7nRca6cnMPBA==","redirect":{"data":{"PaReq":"eNpVUdtuwjAM\/RW2D6jTlF6oTKQOJo2HAuPysKepCtaotl5I2xX4+iWlHVukSD7n2I5zjLujIppvSTaKBMZUVckHjdLD9DEMXMcdM58z37Mdx2OPAtfRhk4Cv0lVaZEL22IWRxigLlfymOS1wESenhZL4drcGSP0CDNSi7nYUVWvsyySpyZVpBBuNOZJRmIfvUezh3BbqssnqdkqRuh4lEWT1+oiuO8hDAAb9SWOdV2GAG3bWtWtzJJFhmA0hPtM68ZEle51Tg9iNd9fl7vXdnld6Pt2jq8xj6PuTBFMBh6SmgRndmAzHozYJHQnIbcROh6TzAwhnveb0dhjlquFnsLSvBTdgNaM9JdCbbaiXF7ExA\/0ZwaEdC6LnHSGNvU3RrgPPnsx1spa2+Vy463r+cGEDS53gumSGqOYzbo2BiCYUuj3B\/2edfRv\/z+FWqxr","TermUrl":"http:\/\/www.de.adyen.local\/adyen\/callback\/redirect-credit-card-3d","MD":"djIhQWJXU3NGMktxWkpSTHhaUXpDWXpCZz09IW3YvPboZxwLavTn+yMWoOA+Y1M08b0RbjZaY0H7zolAOeZxe+7q7nKNFC0HZb69CGo0fWGrYRC0mivs5YuUHRQgM7W0KLFvLVWGQ6w82eaqqcKJsy+O6jo5JinRpFHGd1fZROhlaztsAwz1tR2tjrJV1KmChBcfcGn35s64iyrZ+Aqh776KB9D3IODKh473zmEHUGRDMQnCTqe8DNMMdIpElUuBL\/ExePQzpChk0Nxmv9+rcsDF5tmU0kezzeSoAuxNtFLhzfGgceaOqTOfiV4IipTCtL2Qg9AsBvBswI8ECyA05YAytUcdTyaZJbRfSid\/HkBM75K\/5yZwpaaTiZ\/zvS9arSEOEXMEOFva3eXxRieO1WyEMnuH88Bwgt7fghVoFuYRvQRcm6kXc8ln3agBNCjTIQLjmCJ7VJR4neGVBHSsHakNU4k2GF4vXXUaoUmwvs6RoUA="},"method":"POST","url":"https:\/\/test.adyen.com\/hpp\/3d\/validate.shtml"}}';

    /**
     * @var string
     */
    public const RESPONSE_BODY_PAYMENT_DETAILS = '{"pspReference":"8835407984411712","resultCode":"Authorised"}';

    /**
     * @var string
     */
    public const RESPONSE_BODY_CAPTURE = '{"pspReference":"8535408002754771","response":"[capture-received]"}';

    /**
     * @var string
     */
    public const RESPONSE_BODY_CANCEL = '{"pspReference":"8535408002754771","response":"[cancel-received]"}';

    /**
     * @var string
     */
    public const RESPONSE_BODY_REFUND = '{"pspReference":"8535408002754771","response":"[refund-received]"}';

    /**
     * @var string
     */
    public const RESPONSE_BODY_CANCEL_OR_REFUND = '{"pspReference":"8535408002754771","response":"[cancelOrRefund-received]"}';

    /**
     * @var string
     */
    public const RESPONSE_CAPTURE_RECEIVED = '[capture-received]';

    /**
     * @var string
     */
    public const RESPONSE_CANCEL_RECEIVED = '[cancel-received]';

    /**
     * @var string
     */
    public const RESPONSE_REFUND_RECEIVED = '[refund-received]';

    /**
     * @var string
     */
    public const RESPONSE_CANCEL_OR_REFUND_RECEIVED = '[cancelOrRefund-received]';

    /**
     * @var \SprykerEcoTest\Zed\AdyenApi\AdyenApiZedTester
     */
    protected $tester;

    /**
     * @return \SprykerEco\Zed\AdyenApi\Business\AdyenApiFacadeInterface
     */
    protected function createFacade(): AdyenApiFacadeInterface
    {
        $facade = (new AdyenApiFacade())
            ->setFactory($this->createFactory());

        return $facade;
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|\SprykerEco\Zed\AdyenApi\Business\AdyenApiBusinessFactory
     */
    protected function createFactory(): AdyenApiBusinessFactory
    {
        $builder = $this->getMockBuilder(AdyenApiBusinessFactory::class);
        $builder->setMethods(
            [
                'getConfig',
                'getUtilEncodingService',
                'createGetPaymentMethodsAdapter',
                'createMakePaymentAdapter',
                'createPaymentDetailsAdapter',
                'createCaptureAdapter',
                'createCancelAdapter',
                'createRefundAdapter',
                'createCancelOrRefundAdapter',
            ]
        );

        $stub = $builder->getMock();
        $stub->method('getConfig')
            ->willReturn($this->createConfig());
        $stub->method('getUtilEncodingService')
            ->willReturn($this->createUtilEncodingService());
        $stub->method('createGetPaymentMethodsAdapter')
            ->willReturn($this->createGetPaymentMethodsAdapter());
        $stub->method('createMakePaymentAdapter')
            ->willReturn($this->createMakePaymentAdapter());
        $stub->method('createPaymentDetailsAdapter')
            ->willReturn($this->createPaymentDetailsAdapter());
        $stub->method('createCaptureAdapter')
            ->willReturn($this->createCaptureAdapter());
        $stub->method('createCancelAdapter')
            ->willReturn($this->createCancelAdapter());
        $stub->method('createRefundAdapter')
            ->willReturn($this->createRefundAdapter());
        $stub->method('createCancelOrRefundAdapter')
            ->willReturn($this->createCancelOrRefundAdapter());

        return $stub;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiRequestTransfer
     */
    protected function createAdyenApiRequestTransfer(): AdyenApiRequestTransfer
    {
        $requestTransfer = (new AdyenApiRequestTransfer())
            ->setPaymentMethodsRequest($this->createGetPaymentMethodsRequestTransfer())
            ->setMakePaymentRequest($this->createMakePaymentRequestTransfer())
            ->setPaymentDetailsRequest($this->createPaymentDetailsRequestTransfer())
            ->setCaptureRequest($this->createCaptureRequestTransfer())
            ->setCancelRequest($this->createCancelRequestTransfer())
            ->setRefundRequest($this->createRefundRequestTransfer())
            ->setCancelOrRefundRequest($this->createCancelOrRefundRequestTransfer());

        return $requestTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiGetPaymentMethodsRequestTransfer
     */
    protected function createGetPaymentMethodsRequestTransfer(): AdyenApiGetPaymentMethodsRequestTransfer
    {
        $getPaymentMethodsRequestTransfer = (new AdyenApiGetPaymentMethodsRequestTransfer())
            ->setMerchantAccount(static::REQUEST_MERCHANT_ACCOUNT)
            ->setCountryCode(static::REQUEST_COUNTRY_CODE)
            ->setAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(static::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(static::REQUEST_AMOUNT_VALUE)
            )
            ->setChannel(static::REQUEST_CHANNEL);

        return $getPaymentMethodsRequestTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiMakePaymentRequestTransfer
     */
    protected function createMakePaymentRequestTransfer(): AdyenApiMakePaymentRequestTransfer
    {
        $makePaymentRequestTransfer = (new AdyenApiMakePaymentRequestTransfer())
            ->setMerchantAccount(static::REQUEST_MERCHANT_ACCOUNT)
            ->setReference(static::REQUEST_REFERENCE)
            ->setAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(static::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(static::REQUEST_AMOUNT_VALUE)
            )
            ->setReturnUrl(static::REQUEST_RETURN_URL)
            ->setCountryCode(static::REQUEST_COUNTRY_CODE)
            ->setPaymentMethod(static::REQUEST_PAYLOAD_CREDIT_CARD);

        return $makePaymentRequestTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiPaymentDetailsRequestTransfer
     */
    protected function createPaymentDetailsRequestTransfer(): AdyenApiPaymentDetailsRequestTransfer
    {
        $paymentDetailsRequestTransfer = (new AdyenApiPaymentDetailsRequestTransfer())
            ->setPaymentData(static::REQUEST_DETAILS_PAYMENT_DATA)
            ->setDetails(static::REQUEST_DETAILS);

        return $paymentDetailsRequestTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiCaptureRequestTransfer
     */
    protected function createCaptureRequestTransfer(): AdyenApiCaptureRequestTransfer
    {
        $captureTransfer = (new AdyenApiCaptureRequestTransfer())
            ->setMerchantAccount(static::REQUEST_MERCHANT_ACCOUNT)
            ->setOriginalReference(static::REQUEST_PSP_REFERENCE)
            ->setOriginalMerchantReference(static::REQUEST_REFERENCE)
            ->setModificationAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(static::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(static::REQUEST_AMOUNT_VALUE)
            );

        return $captureTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiCancelRequestTransfer
     */
    protected function createCancelRequestTransfer(): AdyenApiCancelRequestTransfer
    {
        $cancelTransfer = (new AdyenApiCancelRequestTransfer())
            ->setMerchantAccount(static::REQUEST_MERCHANT_ACCOUNT)
            ->setOriginalReference(static::REQUEST_PSP_REFERENCE)
            ->setOriginalMerchantReference(static::REQUEST_REFERENCE);

        return $cancelTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiRefundRequestTransfer
     */
    protected function createRefundRequestTransfer(): AdyenApiRefundRequestTransfer
    {
        $refundTransfer = (new AdyenApiRefundRequestTransfer())
            ->setMerchantAccount(static::REQUEST_MERCHANT_ACCOUNT)
            ->setOriginalReference(static::REQUEST_PSP_REFERENCE)
            ->setOriginalMerchantReference(static::REQUEST_REFERENCE)
            ->setModificationAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(static::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(static::REQUEST_AMOUNT_VALUE)
            );

        return $refundTransfer;
    }

    /**
     * @return \Generated\Shared\Transfer\AdyenApiCancelOrRefundRequestTransfer
     */
    protected function createCancelOrRefundRequestTransfer(): AdyenApiCancelOrRefundRequestTransfer
    {
        $cancelOrRefundTransfer = (new AdyenApiCancelOrRefundRequestTransfer())
            ->setMerchantAccount(static::REQUEST_MERCHANT_ACCOUNT)
            ->setOriginalReference(static::REQUEST_PSP_REFERENCE)
            ->setOriginalMerchantReference(static::REQUEST_REFERENCE)
            ->setModificationAmount(
                (new AdyenApiAmountTransfer())
                    ->setCurrency(static::REQUEST_AMOUNT_CURRENCY)
                    ->setValue(static::REQUEST_AMOUNT_VALUE)
            );

        return $cancelOrRefundTransfer;
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\AdyenApiConfig
     */
    protected function createConfig(): AdyenApiConfig
    {
        return new AdyenApiConfig();
    }

    /**
     * @return \SprykerEco\Zed\AdyenApi\Dependency\Service\AdyenApiToUtilEncodingServiceInterface
     */
    protected function createUtilEncodingService(): AdyenApiToUtilEncodingServiceInterface
    {
        return new AdyenApiToUtilEncodingServiceBridge($this->tester->getLocator()->utilEncoding()->service());
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createGetPaymentMethodsAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(GetPaymentMethodsAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(static::RESPONSE_BODY_GET_PAYMENT_METHODS));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createMakePaymentAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(MakePaymentAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(static::RESPONSE_BODY_MAKE_PAYMENT));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createPaymentDetailsAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(PaymentDetailsAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(static::RESPONSE_BODY_PAYMENT_DETAILS));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createCaptureAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(CaptureAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(static::RESPONSE_BODY_CAPTURE));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createCancelAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(CancelAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(static::RESPONSE_BODY_CANCEL));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createRefundAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(RefundAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(static::RESPONSE_BODY_REFUND));

        return $stub;
    }

    /**
     * @return \PHPUnit\Framework\MockObject\MockObject|\SprykerEco\Zed\AdyenApi\Business\Adapter\AdyenApiAdapterInterface
     */
    protected function createCancelOrRefundAdapter(): AdyenApiAdapterInterface
    {
        $stub = $this->createMock(CancelOrRefundAdapter::class);
        $stub->method('sendRequest')
            ->willReturn($this->createResponse(static::RESPONSE_BODY_CANCEL_OR_REFUND));

        return $stub;
    }

    /**
     * @param string $bodyContent
     * @param int $statusCode
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function createResponse(string $bodyContent, int $statusCode = 200): ResponseInterface
    {
        return new Response($statusCode, static::RESPONSE_HEADERS, $bodyContent);
    }
}
