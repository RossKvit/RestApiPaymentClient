<?php

class CardPaymentCheckout implements PaymentInterface{

    public function __construct(
        public string $invoiceIdentifier = '',
        public array $customer = [],
        public string $checkStatusUrl = '',
        public string $payCurrency = '',
        public int|null $paymentMethod = null,
        public string $cardToken = ''
    ) {}

    /**
     * @var array|string[]
     */
    protected array $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
    ];

    /**
     * @return string
     */
    public function getEndpoint(): string{
        return '/v1/checkout/create';
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return 'POST';
    }

    /**
     * @return array
     */
    public function getCookies(): array
    {
        return [];
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return [
            "invoiceIdentifier" => $this->invoiceIdentifier,
            "customer" => $this->customer,
            "checkStatusUrl" => $this->checkStatusUrl,
            "payCurrency" => $this->payCurrency,
            "paymentMethod" => $this->paymentMethod,
            "cardToken" => $this->cardToken
        ];
    }
}