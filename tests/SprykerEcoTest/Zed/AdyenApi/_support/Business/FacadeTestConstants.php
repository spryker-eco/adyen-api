<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEcoTest\Zed\AdyenApi\Business;

interface FacadeTestConstants
{
    public const REQUEST_MERCHANT_ACCOUNT = 'TestMerchantAccount';
    public const REQUEST_COUNTRY_CODE = 'DE';
    public const REQUEST_AMOUNT_CURRENCY = 'EUR';
    public const REQUEST_AMOUNT_VALUE = 1999;
    public const REQUEST_CHANNEL = 'Web';
    public const REQUEST_REFERENCE = 'test-request-reference-1234567890';
    public const REQUEST_PSP_REFERENCE = '1234567890';
    public const REQUEST_RETURN_URL = 'http://www.de.test.local/adyen/callback/redirect-credit-card-3d';
    public const REQUEST_DETAILS_PAYMENT_DATA = 'request-details-payment-data-string';
    public const REQUEST_DETAILS = [
        'MD' => 'md-test-string',
        'PaRes' => 'pa-res-test-string',
    ];
    public const REQUEST_PAYLOAD_CREDIT_CARD = ['type' => 'scheme'];

    public const RESPONSE_HEADERS = [
        'Date' => 'Sat, 27 Oct 2018 12:09:29 GMT',
        'Server' => 'Apache',
        'Set-Cookie' => 'JSESSIONID=C53F3EA38EF2D66CCA7394547D111C18.test3e; Path=/checkout; Secure; HttpOnly',
        'pspReference' => '8515406421692238',
        'Transfer-Encoding' => 'chunked',
        'Content-Type' => 'application/json;charset=UTF-8',
    ];
    public const RESPONSE_BODY_GET_PAYMENT_METHODS = '{"paymentMethods":[{"details":[{"key":"encryptedCardNumber","type":"cardToken"},{"key":"encryptedSecurityCode","type":"cardToken"},{"key":"encryptedExpiryMonth","type":"cardToken"},{"key":"encryptedExpiryYear","type":"cardToken"},{"key":"holderName","optional":true,"type":"text"}],"name":"Credit Card","type":"scheme"},{"name":"AliPay","type":"alipay"},{"name":"WeChat Pay","type":"wechatpay"},{"name":"PayPal","type":"paypal"},{"name":"Paysafecard","type":"paysafecard"}]}';
    public const RESPONSE_BODY_MAKE_PAYMENT = '{"resultCode":"RedirectShopper","details":[{"key":"MD","type":"text"},{"key":"PaRes","type":"text"}],"paymentData":"Ab02b4c0!BQABAgCZBBzoglHwahqINfTBa3E5IoueiIoh+T1MHgssrqM5wOQg04Sn3ndWygxMXMkUvHOIzBZfzb810lQzXtTHtafea+mfFlPRoPJJhJI6k484Qg\/dL0DMhA6F7uJwlbY9POnQTNZrctHxt5STe+ofBc7gVWBKLuIJMRVX73nOCx+e19krrl9ds09UZMwXhUBTO1nxU0jIf5bGBN664Av2iDuelgm\/8ScTThDSLnfJcDb+MzW03yY\/dR7wu4HaJ\/oAWIL0GY59KPrPELFXhl+7D1D5N6qGvquh+\/HXCO63RaoOfd1NNA+Dj5tXfv73ufXQHK2LdoXbyDhXtt+AsKiT5Tk6cUXxspXXFfF63ZkfADkHBLwv\/jfaJhf2a2rcNy\/ndWHStJEGT+sdNTzCDSEhxOGU466FWDckt74bmf\/X7VvRU8bPwki\/UWy5uFJwu0GE1sxdUHxl9XGdp4RjTjr46ei9qgbc\/Hgz+glo\/aho\/9SLzepx1zudOQecvlAVve9HQAkI3NcVxqcaOF4xc9SsX6OLQjIoxZ7ilC9wKhMLCbDNWnv\/3CIj2K3Ch7KnkpEgtyt5DKi5UAOYbJxGsir9F5s8puMuqy5zlyipemxOxG092BuEVdLeWqo+q1ImGJkVs4BclMLbyUTO5k8756FvuVxqNwafrZIykQ\/WxJLar3rLGhDrcdxJs461EujVIjTKUr36AEp7ImtleSI6IkFGMEFBQTEwM0NBNTM3RUFFRDg3QzI0REQ1MzkwOUI4MEE3OEE5MjNFMzgyM0Q2OERBQ0M5NEI5RkY4MzA1REMifWRLy8K+XNYDwTcuPYECFtkYvjsbfp8gKhRbO9d22K\/ZF\/DALeRxCo4lZLiyIk8rnQ8ujTqi1gO\/7fb3gvZikvNW67Zee903s5Jo+xlTy\/HkMp1Bvi3xfZTUoQZ23rzkTO\/2wddFrJjXkoVUhQ6HEYEHKOSoTG\/ImihvmmB3NxfzVvg+voq8tIonwP1HCqOKrVpg6o\/wrSyH9tNEOxDdGInAtunJ3ha2tXkT\/D8G9OTGYeKJ0eBdqJHRRWXcl5z9s8WuXYWNRbWl0ngvMHpU1mhFWSsJW7wzjNvdR+nGRA9LWELYak2yX903u9UkH74xw9CEuDULHlYoe+mHl3uIl7hUeoPrCag4Jiv\/Wnz\/LiirU\/7I33qqoe586luV1vIEu\/igt3gDd2vMn\/avi4Um2NjDri+00fpDG0XNqztJFVnzbrByhpne6ZecAdP\/VDXUJCjeapksHf2NIG1dTr7lxiK3vWatH7ysGd4rO3Vu3A5ev5SpLszuOxhdllcjrARCe0MF+qKU869NCXYLt6gZpYBMg351XkzFlYKAVZv4Ckz0fHEJ0PHligQDcLvzvOxELqLPNwGVw2nd05PSt6ThlqG0cKlD6u\/6nOmxCOmHmPFUZ1Ee9rk35fEqX8DbNVGlVa10Eaxv9E\/LKfbcn4zgeaU20S+DRx9ViELL727PBPrGagxXdtV3D8znH1LWTDhEqkUVTzK1kNCGjvhd3HJfyovpZuAsgkHkGvdfWT3RVI\/pWLaELNH1EWFxoJ\/ignkZTmUOzK\/OFMqCO9OyYG7e5pBKyEHrSyHX3rYG3ZQrmGL\/BdnqAxBowF\/DNoX0rKBzYT6hZll3ZDr41PMns8GKECElIXdXRSi4J+HjOx5os2FPs0Fhz7qOVmNBth3Yr9B+KO7LG+SReyu2IqdgWqPIjowX\/7qHmoskaJwuDFdqeGEm2zpmEyrGWQVzp0w+l46BNkf7JoMRQM\/tgqAKl+ROiEFNegMi5SxNXr4DmdFkp4RcrYe184Op\/HQbqB0jSvhP0wZT+tcnRDbJaGVwNagf+OV0E+H5Ohbme7UWh\/\/GLgba8xQR39YAEj\/nXgGYM\/+vRI2Nqw3qllYsQnyp3Mz50oAY6K3QF+uke+pn6QLFBWMXcaXxxUon8GT\/s6JHMX9bl0+5AO8s+dEa\/RfZfw4TRxThAFdTIXjw\/zrGe5CtQq85dCGT9QoEJ+WnDzmOw21UQp1G5VfsMpVnPxdWiHLl1DzZ3SAfPyEzZSiNqkX0hXsbNLA35z8\/Fl4ncx7nRca6cnMPBA==","redirect":{"data":{"PaReq":"eNpVUdtuwjAM\/RW2D6jTlF6oTKQOJo2HAuPysKepCtaotl5I2xX4+iWlHVukSD7n2I5zjLujIppvSTaKBMZUVckHjdLD9DEMXMcdM58z37Mdx2OPAtfRhk4Cv0lVaZEL22IWRxigLlfymOS1wESenhZL4drcGSP0CDNSi7nYUVWvsyySpyZVpBBuNOZJRmIfvUezh3BbqssnqdkqRuh4lEWT1+oiuO8hDAAb9SWOdV2GAG3bWtWtzJJFhmA0hPtM68ZEle51Tg9iNd9fl7vXdnld6Pt2jq8xj6PuTBFMBh6SmgRndmAzHozYJHQnIbcROh6TzAwhnveb0dhjlquFnsLSvBTdgNaM9JdCbbaiXF7ExA\/0ZwaEdC6LnHSGNvU3RrgPPnsx1spa2+Vy463r+cGEDS53gumSGqOYzbo2BiCYUuj3B\/2edfRv\/z+FWqxr","TermUrl":"http:\/\/www.de.adyen.local\/adyen\/callback\/redirect-credit-card-3d","MD":"djIhQWJXU3NGMktxWkpSTHhaUXpDWXpCZz09IW3YvPboZxwLavTn+yMWoOA+Y1M08b0RbjZaY0H7zolAOeZxe+7q7nKNFC0HZb69CGo0fWGrYRC0mivs5YuUHRQgM7W0KLFvLVWGQ6w82eaqqcKJsy+O6jo5JinRpFHGd1fZROhlaztsAwz1tR2tjrJV1KmChBcfcGn35s64iyrZ+Aqh776KB9D3IODKh473zmEHUGRDMQnCTqe8DNMMdIpElUuBL\/ExePQzpChk0Nxmv9+rcsDF5tmU0kezzeSoAuxNtFLhzfGgceaOqTOfiV4IipTCtL2Qg9AsBvBswI8ECyA05YAytUcdTyaZJbRfSid\/HkBM75K\/5yZwpaaTiZ\/zvS9arSEOEXMEOFva3eXxRieO1WyEMnuH88Bwgt7fghVoFuYRvQRcm6kXc8ln3agBNCjTIQLjmCJ7VJR4neGVBHSsHakNU4k2GF4vXXUaoUmwvs6RoUA="},"method":"POST","url":"https:\/\/test.adyen.com\/hpp\/3d\/validate.shtml"}}';
    public const RESPONSE_BODY_PAYMENT_DETAILS = '{"pspReference":"8835407984411712","resultCode":"Authorised"}';
    public const RESPONSE_BODY_CAPTURE = '{"pspReference":"8535408002754771","response":"[capture-received]"}';
    public const RESPONSE_BODY_CANCEL = '{"pspReference":"8535408002754771","response":"[cancel-received]"}';
    public const RESPONSE_BODY_REFUND = '{"pspReference":"8535408002754771","response":"[refund-received]"}';
    public const RESPONSE_BODY_CANCEL_OR_REFUND = '{"pspReference":"8535408002754771","response":"[cancelOrRefund-received]"}';
}
