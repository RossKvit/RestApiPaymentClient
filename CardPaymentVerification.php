<?php

class CardPaymentVerification implements PaymentInterface{

    public function __construct(
        public string $invoiceIdentifier = '',
        public string $pan = '',
        public string $expirationDate = '',
        public string $cvv = '',
        public string $holderName = ''
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
        return '/v1/payment-tools/card-token/create';
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
            "pan" => $this->pan,
            "expirationDate" => $this->expirationDate,
            "cvv" => $this->cvv,
            "holderName" => $this->holderName
        ];
    }
}